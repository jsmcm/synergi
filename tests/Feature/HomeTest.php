<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class HomeTest extends TestCase
{

    use RefreshDatabase;


    private static function makeUser(): array
    {
        return [
            "name"      => fake()->name(),
            "email"     => fake()->unique()->safeEmail(),
            "comment"   => fake()->paragraph(),
        ];
    }

    /**
     * A basic feature test example.
     */
    public function test_home_page_loads_correctly(): void
    {
        $this->get('/')
        ->assertStatus(200);
    }

    public function test_should_return_error_when_validation_fails(): void
    {
        $this->post(route("user.post"))
            ->assertRedirect()
            ->assertSessionHas("errors");
    }


    public function test_can_add_a_user(): void
    {

        $userData = self::makeUser();

        $this->post(route("user.post"), [
                "name"      => $userData["name"],
                "email"     => $userData["email"],
                "comment"   => $userData["comment"],
            ])
            ->assertRedirect(route("user.thanks")."?name=".rawurlencode($userData["name"]));
    }

    public function test_cannot_add_the_same_user_more_than_once(): void
    {

        $userData = self::makeUser();

        $this->post(route("user.post"), [
                "name"      => $userData["name"],
                "email"     => $userData["email"],
                "comment"   => $userData["comment"],
            ])
            ->assertRedirect(route("user.thanks")."?name=".rawurlencode($userData["name"]));

        $this->post(route("user.post"), [
                "name"      => $userData["name"],
                "email"     => $userData["email"],
                "comment"   => $userData["comment"],
            ])
            ->assertRedirect()
            ->assertSessionHas([
                "error" => "Failed: this email is already registered. Please log in instead."
            ]);


    }


    public function test_add_a_user_creates_model(): void
    {

        $userData = self::makeUser();

        $this->post(route("user.post"), [
                "name"      => $userData["name"],
                "email"     => $userData["email"],
                "comment"   => $userData["comment"],
            ])
            ->assertRedirect(route("user.thanks")."?name=".rawurlencode($userData["name"]));

        $user = User::where(["email" => $userData["email"]])->first();

        $this->assertDatabaseHas('users', ['email' => $userData["email"]]);
    
    }



}
