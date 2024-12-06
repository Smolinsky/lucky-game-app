<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function register($request)
    {
        return User::create([
            'name' => $request['name'],
            'phone' => $request['phone']
        ]);
    }
}
