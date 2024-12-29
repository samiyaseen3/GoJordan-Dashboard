<?php

namespace App\Services;

use OpenAI;
use App\Models\Chat;
use App\Models\Tour;

class AIChatService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.api_key'));
    }

    public function generateResponse($message, $userId = null)
    {
        try {
            // Get relevant tour information
            $tours = Tour::select('title', 'description', 'price', 'duration')->get();
            $tourInfo = $tours->map(function($tour) {
                return "Tour: {$tour->title}, Duration: {$tour->duration} days, Price: {$tour->price} JOD";
            })->join("\n");

            $response = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a helpful travel assistant for a Jordanian tourism website. 
                        You help users find tours, provide information about destinations, and offer travel advice. 
                        Here are our current tours:\n{$tourInfo}\n
                        Always be friendly and provide concise, accurate information. 
                        If suggesting a tour, mention its exact name from the list provided."
                    ],
                    [
                        'role' => 'user',
                        'content' => $message
                    ]
                ]
            ]);

            $aiResponse = $response->choices[0]->message->content;

            // Save the conversation
            Chat::create([
                'user_id' => $userId,
                'message' => $message,
                'response' => $aiResponse
            ]);

            return $aiResponse;

        } catch (\Exception $e) {
            return "I apologize, but I'm having trouble processing your request at the moment. Please try again later.";
        }
    }
}