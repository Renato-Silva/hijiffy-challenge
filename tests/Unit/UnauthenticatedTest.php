<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UnauthenticatedTest extends TestCase
{
    public function testUnauthenticated(): void
    {
        $validQuestion = 'What time is it?';
        $response = $this->postJson('/api/ask', [
            'question' => $validQuestion,
        ]);

        $response->assertStatus(401);
    }
}
