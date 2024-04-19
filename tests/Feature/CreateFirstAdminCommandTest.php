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
        $this->artisan('synergi:create_first_admin Joe Black joe@example.com +270000000000 AbC123%$ 1988-01-20 english')->assertSuccessful();
    }

    public function test_can_create_first_admin_only_once(): void
    {
        //User::truncate();
        $this->artisan('synergi:create_first_admin Joe Black joe@example.com +270000000000 AbC123%$ 1988-01-20 english')->assertSuccessful();
        $this->artisan('synergi:create_first_admin Joe Black joe@example.com +270000000000 AbC123%$ 1988-01-20 english')->assertFailed();
    }

}
