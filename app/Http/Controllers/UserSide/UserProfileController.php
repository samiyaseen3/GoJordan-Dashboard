<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
                          ->with(['tour', 'tour_date'])  // Eager load relationships
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('userside.profile', compact('user', 'bookings'));
    }

    public function update(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female',
            'city' => 'required|string|max:255',
        ]);
    
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone; // Ensure the database column matches
        $user->gender = $request->gender;
        $user->city = $request->city;
    
        try {
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }



    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.',
            ], 422); // HTTP 422 Unprocessable Entity
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return a success response
        return response()->json([
            'message' => 'Password updated successfully.',
        ]);
    }
    

}
