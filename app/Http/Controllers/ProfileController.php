<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'profile_photo' => 'nullable|mimes:jpg,jpeg,png|max:4096',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['success' => false, 'errors' => $errors]);
        }

        try {
            $user_model = User::find($user->id);

            $user_model->name = $request->name;
            $user_model->email = $request->email;

            if ($request->hasFile('profile_photo')) {
                $user_model->profile_photo = $request->file('profile_photo')->store('profile-photos', 'public');
            }

            $password_msg = null;
            if ($request->has('password') && !empty($request->password)) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password',
                ]);

                if ($validator->fails()) {
                    $errors = $validator->errors()->all();
                    return response()->json(['success' => false, 'errors' => $errors]);
                }
                
                $user_model->password = Hash::make($request->password);
                $password_msg = 'Password and ';
            }

            $user_model->save();

            return response()->json(['success' => true, 'message' => $password_msg . 'Profile updated successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }

    }
}
