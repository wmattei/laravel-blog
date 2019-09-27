<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    function setUp(): void
    {
        parent::setUp();

        $user = new User([
             'email'    => 'test@email.com',
             'password' => '123456',
             'name' => 'Wagner'
         ]);

        $user->save();

        
    }

    /** @test */
    public function it_will_register_a_user()
    {
        $response = $this->post('api/register', [
            'email'    => 'wagner.mattei@gmail.com',
            'password' => '123456',
            'name' => "Wagner"
        ]);

        $response->assertJsonStructure(['message', 'data' => [
            'access_token',
            'token_type',
            'expires_in'
        ]]);
    }

    /** @test */
    public function it_will_not_register_a_user(){
        $response = $this->json('POST', 'api/register', [
            'email'    => 'wagner.mattei@gmail.com',
            'password' => '123456',
        ]);
        $this->assertEquals(422, $response->status());
        $response->assertJsonStructure(['message', 'errors' => [
            'name'
        ]]);
    }

    /** @test */
    public function it_will_log_a_user_in()
    {
        $response = $this->post('api/login', [
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure(['message', 'data' => [
            'access_token',
            'token_type',
            'expires_in'
        ]]);
    }

    /** @test */
    public function it_will_not_log_an_invalid_user_in()
    {
        $response = $this->post('api/login', [
            'email'    => 'test@email.com',
            'password' => 'notlegitpassword'
        ]);

        $response->assertJsonStructure([
            'error',
        ]);
    }
}
