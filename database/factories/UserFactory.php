<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use \App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 * 
 * Usage:
 * 
 * Create 3 client users:
 * User::factory()->count(3)->create();
 * 
 * Create 2 admin users:
 * User::factory(2)->admin()->create();
 * 
 */

  
  
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role'              => 'client',
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];

    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            
            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->comment = fake()->paragraph();
            $comment->save();

        });
    }


    public function admin()
    {
        return $this->state(function (Array $attributes) {
            return [
                "role" => 'admin'
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
