<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2',
            'password_repeat' => 'required|string|min:2|same:password',

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $newUser = User::create($request->all());
        $token = $newUser->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token, 'currentUser' => $newUser];

        return response($response, 200);
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $response = ['error' => 'Пользователь с таким email не найден'];
            return response($response, 422);
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = ['token' => $token, 'currentUser' => $user];

            return response($response, 200);
        } else {
            $response = ['error' => "Неверный пароль"];

            return response($response, 422);
        }

    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['success' => 'Успешный выход из системы!'];
        return response($response, 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
//            'password' => 'required|string|min:2',
//            'password_repeat' => 'required|string|min:2|same:password',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = $request->user();
        $user->name = $request->get('name');
        $user->save();
        $response = [ 'currentUser' => $user];

        return response($response, 200);
    }

}
