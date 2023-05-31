<?php

namespace Tests\Unit;

use Tests\TestCase;

class ValidQuestionTest extends TestCase
{
    public function testAskValidQuestion(): void
    {
        $validQuestion = 'What time is it?';
        $response = $this->postJson('/api/ask', [
            'question' => $validQuestion,
        ]);

        $response->assertStatus(200);
    }
}
