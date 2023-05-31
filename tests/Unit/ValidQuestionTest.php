<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ValidQuestionTest extends TestCase
{
    public function testAskValidQuestion(): void
    {
        $user = User::first();

        $validQuestion = 'What time is it?';
        $response = $this->actingAs($user)->postJson('/api/ask', [
            'question' => $validQuestion,
        ]);

        $response->assertStatus(200);
    }
}
