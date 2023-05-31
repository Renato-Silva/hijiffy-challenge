<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class InvalidQuestionTest extends TestCase
{
    public function testAskInvalidQuestion(): void
    {
        $user = User::first();

        $validQuestion = '';
        $response = $this->actingAs($user)->postJson('/api/ask', [
            'question' => $validQuestion,
        ]);

        $response->assertStatus(422);
    }
}
