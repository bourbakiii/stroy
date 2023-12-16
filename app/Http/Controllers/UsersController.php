<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class UsersController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email:max:255|unique:users',
            'password' => 'required|string|min:6',
            'user_type_id'=>'required|exists:type_of_users,id'
        ]);

        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());

        try {
            $user = User::create([
                ...$request->all(),
                'password' => Hash::make($request->get('password')),
            ]);
            return ResponsesHelper::success("User created", 200, $user);
        } catch (\Exception $e) {
            return ResponsesHelper::error("Something wrong", 400, $e);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());
        if (!$token = auth('api')->attempt(['email' => $request['email'], 'password' => $request['password']]))
            return ResponsesHelper::error("Invalid credentials", 400);
        $user_by_phone = User::where('email', $request->get('email'))->first();
        return ResponsesHelper::success("Success", 200, ["user" => $user_by_phone, "token" => $token]);
    }

    function refresh()
    {
        return ResponsesHelper::success("Success", 200, auth('api')->refresh());
    }
}
