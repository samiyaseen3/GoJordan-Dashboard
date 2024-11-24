<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Hash;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Get only users with the 'User' role, including soft-deleted ones
    $users = User::withTrashed()->where('role', 'user')->get();

    return view('dashboard.user', compact('users'));

    
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */


     
     public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'required|string|min:10|max:15', // Adjust the phone number length as needed
            'city' => 'nullable|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        // Using libphonenumber to parse and validate the phone number
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $phoneNumber = $phoneUtil->parse($request->phone_number, "US"); // Use default country code (e.g., "US" or based on the user's input)
            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid phone number format.',
                ]);
            }

            // Get the formatted phone number with country code
            $formattedPhoneNumber = $phoneUtil->format($phoneNumber, PhoneNumberFormat::E164);

        } catch (NumberParseException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error parsing phone number.',
            ]);
        }

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone_number' => $formattedPhoneNumber, // Store the formatted phone number
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully!',
            'redirect' => route('user.index'),
        ]);
    }

     

     



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'gender' => 'nullable|in:male,female,other',
        'phone_number' => 'required|string|min:10|max:15',
        'city' => 'nullable|string|max:255',
        'password' => 'nullable|min:6|confirmed', // Make password optional during update
    ]);

    // Validate phone number using libphonenumber
    $phoneUtil = PhoneNumberUtil::getInstance();
    try {
        $phoneNumber = $phoneUtil->parse($request->phone_number, "US"); // Adjust the country code dynamically if needed
        if (!$phoneUtil->isValidNumber($phoneNumber)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number format. Please use the correct format with country code.',
            ]);
        }

        // Get the formatted phone number with country code
        $formattedPhoneNumber = $phoneUtil->format($phoneNumber, PhoneNumberFormat::E164);

    } catch (NumberParseException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error parsing phone number. Please ensure it is in the correct format.',
        ]);
    }

    try {
        // Update the user's information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone_number' => $formattedPhoneNumber, // Store the formatted phone number
            'city' => $request->city,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Update password only if provided
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully!',
            'redirect' => route('user.index'),
        ]);
    } catch (\Exception $e) {
        // Handle any general exception that occurs during the update process
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating the user. Please try again later.',
        ]);
    }
}


       
    

    /**
     * Remove the specified resource from storage.
     */
 public function destroy($id)
{
    // Retrieve the user and soft delete it
    $user = User::findOrFail($id);
    $user->delete();

    // Redirect back with a success message
    return redirect()->route('user.index')->with('success', 'User deleted successfully!');
}

public function restore($id)
{
    // Retrieve the soft-deleted user
    $user = User::onlyTrashed()->findOrFail($id);

    // Restore the user
    $user->restore();

    // Redirect back with a success message
    return redirect()->route('user.index')->with('success', 'User restored successfully!');
}
}
