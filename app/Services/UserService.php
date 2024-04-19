<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserService
{
    public function adminCount()
    {
        // This cache key will be cleared after we add our
        // first admin user with the artisan command.
        return Cache()->remember("admin.user.count", now()->addSeconds(config("synergi.users.countCacheTtl")), function () {
            return User::where(["role" => "admin"])->count();
        });
    }



    public function store($role, $name, $email, $password)
    {

        $user = new User();

        $user->role     = $role;
        $user->name     = $name;
        $user->email    = $email;
        $user->password = Hash::make($password);
        
        $user->save();

        return $user;
    }

}


