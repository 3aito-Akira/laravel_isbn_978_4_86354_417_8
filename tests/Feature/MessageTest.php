<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Message;

class MessageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_showMessagesList(): void
    {
        Message::create(['body' => 'Hello World']);
        Message::create(['body' => 'Hello Laravel']);
        $this->get('messages')->assertOk()->assertSeeInOrder(['Hello World','Hello Laravel',]);
    }
}
