<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserController extends Controller
{
    
    public function delete(Request $request)
    {
        User::destroy($request->user);
    }

    public function update(Request $request)
    {
        // $userData = $request->user;

        // $user = User::find($userData["id"]);
        // if ($user) {
        //     $user->update($userData);
        // }
    }
}
