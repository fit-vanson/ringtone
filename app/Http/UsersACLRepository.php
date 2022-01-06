<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Illuminate\Support\Facades\Auth;

class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
//        return Auth::id();
        return Auth::user()->getRoleNames()->first();
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {
        if (Auth::user()->getRoleNames()->first() === 'admin') {
            return [
                ['disk' => 'public', 'path' => '*', 'access' => 2],
                ['disk' => 'logs', 'path' => '*', 'access' => 2],
            ];
        }

        return [
            ['disk' => 'public', 'path' => '*', 'access' => 1],                                  // main folder - read
            ['disk' => 'logs', 'path' => '*', 'access' => 0],                                  // main folder - read
//            ['disk' => 'disk-name', 'path' => 'users', 'access' => 1],                              // only read
//            ['disk' => 'disk-name', 'path' => 'users/'. Auth::user()->name, 'access' => 1],        // only read
//            ['disk' => 'disk-name', 'path' => 'users/'. Auth::user()->name .'/*', 'access' => 2],  // read and write
        ];
    }
}
