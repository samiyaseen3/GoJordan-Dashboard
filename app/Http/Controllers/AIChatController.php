<?php

namespace App\Http\Controllers;

use App\Services\AIChatService;
use Illuminate\Http\Request;

class AIChatController extends Controller
{
    protected $aiService;

    public function __construct(AIChatService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function chat(Request $request)
    {
        $message = $request->input('message');
        $userId = auth()->id();

        $response = $this->aiService->generateResponse($message, $userId);

        return response()->json(['response' => $response]);
    }

    public function showChat()
    {
        return view('userside.chat');
    }
}