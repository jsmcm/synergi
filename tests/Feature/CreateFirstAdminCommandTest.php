<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateFirstAdminCommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_create_first_admin(): void
    {
        //User::truncate();
        $this->artisan('synergi:create_first_admin Joe joe@example.com AbC123%$')->assertSuccessful();
    }

    public function test_can_create_first_admin_only_once(): void
    {
        //User::truncate();
        $this->artisan('synergi:create_first_admin Joe joe@example.com AbC123%$')->assertSuccessful();
        $this->artisan('synergi:create_first_admin Joe joe@example.com AbC123%$')->assertFailed();
    }

}
