<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function save(Request $request)
    {
       
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^[6-9]\d{9}$/|unique:users,phone',
            'role' => 'required|string',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];

        // Define custom validation messages
        $messages = [
            'name.required' => 'Please enter your name.',
            'name.max' => 'Name cannot be longer than 255 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid indian phone number',
            'phone.unique' => 'This phone number is already taken.',
            'role.required' => 'Please specify your role.',
            'description.max' => 'Description cannot be longer than 1000 characters.',
            'image.required' => 'Please upload an image.',
            'image.mimes' => 'Only PNG, JPG, and JPEG files are allowed.',
            'image.max' => 'File size must be less than 2 MB.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        }

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make(uniqid());
            $user->phone = $request->phone;
            $user->role_id = $request->role;
            $user->description = $request->description;
            $user->image = $filename;
            $user->save();
        } catch (\Throwable $th) {
              
            return response()->json(['error' =>"Something went wrong, Please try again"], 500);
        }

        $users = User::with('role')->get()->toArray();
        
        // Return the user data as a table row
        return response()->json([
            'html' => view('user', compact('users'))->render()
        ]);
    }
}
