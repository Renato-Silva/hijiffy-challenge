<?php

namespace Tests\Unit;

use Tests\TestCase;

class InvalidQuestionTest extends TestCase
{
    public function testAskInvalidQuestion(): void
    {
        $validQuestion = '';
        $response = $this->postJson('/api/ask', [
            'question' => $validQuestion,
        ]);

        $response->assertStatus(422);
    }
}
