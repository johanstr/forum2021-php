<?php


namespace App\Http\Controllers;


use App\Models\UserModel;

class LoginController
{
    private function generateRandomString(int $length = 20) : string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function login(array $data) : array
    {
        if(array_key_exists('email', $data) && array_key_exists('password', $data)) {
            $user = UserModel::findByColumn('email', $data['email']);

            if(password_verify($data['password'], $user['password'])) {
                // Login successful
                $token = $this->generateRandomString();

                $result = UserModel::update([ 'auth_token' => $token ], $user['id']);

                return [ 'msg' => 'Login successful', 'auth_token' => $token, 'user_id' => $user['id'] ];
            }
        }

        return [ 'msg' => 'No or faulty credentials given' ];
    }

    public function logout(string $auth_token)
    {

    }
}