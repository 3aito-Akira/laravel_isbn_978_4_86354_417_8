<?php

namespace Tests\Feature\Auth\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    private $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create([
            'login_id' => 'hoge',
            'password' =>  Hash::make('hogehoge'),
        ]);
    }

    public function test_showLoginPhase(): void
    {
        $this->get(route('admin.create'))->assertOk();
    }

    public function test_LoginSuccessfully(): void
    {
        
        /* from(route('admin.store'))が有っても無くてもtestは成功する
        $this->from(route('admin.store'))->post(route('admin.store'),[
            'login_id' => 'hoge',
            'password' => 'hogehoge',
        ])->assertRedirect(route('book.index'));
        */

        $this->post(route('admin.store'),[
            'login_id' => 'hoge',
            'password' => 'hogehoge',
        ])->assertRedirect(route('book.index'));

        $this->assertAuthenticatedAs($this->admin,'admin');
    }

    public function test_LoginUnsuccessfully(): void
    {
        $this->from(route('admin.store'))->post(route('admin.store'),[
            'login_id' => 'hoge',
            'password' => 'fugafuga',
        ])->assertRedirect(route('admin.create'))
        ->assertInvalid(['login_id' => 'These credentials do not']);

        $this->assertGuest('admin');
    }

    public function test_validation(): void 
    {
        $url = route('admin.store');

        $this->from(route('admin.create'))->post($url,['login_id' => ''])->assertRedirect(route('admin.create'));

        $this->post($url,['login_id' => ''])->assertInvalid(['login_id' => 'login idは必ず']);

        $this->post($url,['login_id' => 'a'])->assertValid('login_id');

        $this->post($url,['password' => ''])->assertInvalid(['password' => 'passwordは必ず']);

        $this->post($url,['password' => 'a'])->assertValid('password');
    }
}
