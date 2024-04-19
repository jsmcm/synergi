<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\UserService;

// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;


class create_first_admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synergi:create_first_admin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the first ADMIN user to the system.';

    /**
     * Execute the console command.
     */
    public function handle(UserService $userService)
    {
        if ($userService->adminCount() != 0) {
            $this->error("There are already admin users in this system. This command can only be used on a new system with no admin users.");
            return Command::FAILURE;
        }


        $data = $this->argument();

        $rules = [
            'name'       => 'required|string',
            "email"         => "required|email",
            'password'      => "required|string|min:8|max:64|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,64}$/",
        ];

        $messages = [
            'password.regex'    => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];

        $validator = Validator::make($data, $rules, $messages);


        // Check if the validation fails
        if ($validator->fails()) {
            $this->error("Your input validation failed:");

            foreach ($validator->errors()->messages() as $key => $messages) {
                $this->warn($key.": ");

                foreach ($messages as $message) {
                    $this->warn("\t".$message);
                }
            }

            return Command::FAILURE;
        }

        $userService->store(
            "admin",
            $validator->validated()["name"],
            $validator->validated()["email"],
            $validator->validated()["password"], 
        );

        Cache::forget("admin.user.count");

    }
}
