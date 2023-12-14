<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email:max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());

        try {
            $id = User::create([
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            return ResponsesHelper::success("Approve code sent", 200);
        } catch (\Exception $e) {
            return ResponsesHelper::error("Something wrong", 400, $e);
        }
    }

}
