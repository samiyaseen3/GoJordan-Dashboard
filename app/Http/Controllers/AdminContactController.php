<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        
        return view('admin.messages.index', compact('messages', 'unreadMessages', 'recentMessages'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        
        return view('admin.messages.show', compact('message', 'unreadMessages', 'recentMessages'));
    }

    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return response()->json([
            'success' => true,
            'unreadCount' => ContactMessage::where('is_read', false)->count()
        ]);
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully');
    }

    public function getUnreadCount()
    {
        $count = ContactMessage::where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}
