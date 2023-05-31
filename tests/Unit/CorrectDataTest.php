<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;

class CorrectDataTest extends TestCase
{
    public function testAskValidQuestion(): void
    {
        $mockedResponse = 'This is the response from Dialogflow.';
        $dialogFlowService = Mockery::mock(DialogFlowService::class);
        $dialogFlowService->shouldReceive('query')->andReturn($mockedResponse);
        $this->app->instance(DialogFlowService::class, $dialogFlowService);

        $validQuestion = 'What time is it?';

        $response = $this->postJson('/api/ask', [
            'question' => $validQuestion,
        ]);

        $response->assertStatus(200)
            ->assertExactJson([
                'message' => $mockedResponse,
            ]);
    }
}
