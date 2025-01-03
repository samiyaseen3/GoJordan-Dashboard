<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('userside.register');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|string|min:10|max:15',
                'gender' => 'required|in:male,female,other',
                'city' => 'required|string|max:255',
                'password' => 'required|min:6|confirmed',
            ]);

            

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }

            if (User::where('email', $request->email)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'The email address is already registered.',
                ], 422);
            }

            if (User::where('phone_number', $request->phone_number)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'The phone number already exists.',
                ], 422);
            }

            $phoneUtil = PhoneNumberUtil::getInstance();
            try {
                $phoneNumber = $phoneUtil->parse($request->phone_number, "JO");
                if (!$phoneUtil->isValidNumber($phoneNumber)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid phone number format.',
                    ], 422);
                }
                $formattedPhoneNumber = $phoneUtil->format($phoneNumber, PhoneNumberFormat::E164);
            } catch (NumberParseException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error parsing phone number.',
                ], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'phone_number' => $formattedPhoneNumber,
                'city' => $request->city,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful!',
                'redirect' => route('userside.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}