<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */
    function a_user_can_visit_auth_pages()
    {
        $register = $this->get(route('register'));
        $register->assertSuccessful();

        $login = $this->get('/login');
        $login->assertSuccessful();
    }

    /** @test */
    function a_user_can_not_visit_login_or_register_when_authenticated()
    {
        $user = factory(User::class)->create();
        $responseLogin = $this->actingAs($user)->get('/login');
        $responseRegister = $this->actingAs($user)->get(route('register'));

        $responseLogin->assertRedirect(route('home'));
        $responseRegister->assertRedirect(route('home'));
    }
    
    /** @test */
    function a_user_can_register()
    {
        $this->post('/registracija', $this->getRegisterData(['email' => 'drugi@email.com']));
        $this->assertDatabaseHas('users', ['email' => 'drugi@email.com']);
    }
    
    /** @test */
    function a_user_can_not_register_if_data_invalid()
    {
        $this->post('/registracija', $this->getRegisterData([
                                                        'email' => 'pogresan123',
                                                        'password_confirmation' => 'asdasd']))
            ->assertSessionHasErrors('email')
            ->assertSessionHasErrors('password');
    }
    
    /** @test */
    function a_registered_user_can_login()
    {
        $user = factory(User::class)->create();
        $this->post('/login', [
           'email'      => $user->email,
           'password'   => 'secret'
        ])->assertSessionHasNoErrors();
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    function a_user_can_not_login_with_wrong_password()
    {
        $user = factory(User::class)->create();
        $this->post('/login', [
            'email'     => $user->email,
            'password'  => 'wrong_password'
        ])->assertSessionHasErrors();
    }

    private function getRegisterData($options = [])
    {
        return array_merge([
            'name'                       => 'Ime',
            'email'                      => 'ime@ime.com',
            'password'                   => '$2y$10$pJiwdHUVnKTEoN8RoWB57eN.WVA2gY74zik4CIfLK96xgalnuRvJW',
            'password_confirmation'      => '$2y$10$pJiwdHUVnKTEoN8RoWB57eN.WVA2gY74zik4CIfLK96xgalnuRvJW'
            ], $options
        );
    }
}
