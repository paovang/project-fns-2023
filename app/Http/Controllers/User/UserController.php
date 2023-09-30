<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    

    public function listUsers(Request $request)
    {
        return $this->getData();
    }

    private function getData()
    {
        $user = Auth::user('api');

        if($user->hasPermission(['create-store', 'update-store'], true)) {
            return 'edit';
        }
        return 'pass 2023';
    }
}