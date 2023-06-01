<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\DialogFlowService;
use Tests\TestCase;

class CorrectDataTest extends TestCase
{
    public function testAskValidQuestion(): void
    {
        $user = User::first();

        $mockSessionClient = $this->getMockBuilder(DialogFlowService::class)
            ->getMock();

        $mockSessionClient->method('query')->willReturn([
            'text' => 'It is raining.',
            'session' => '123456'
        ]);

        // Inject the mocked session client into the service container
        $this->app->instance(DialogFlowService::class, $mockSessionClient);

        // Make a request to the API endpoint
        $response = $this->actingAs($user)->postJson('/api/ask', [
            'question' => 'What is the weather like?'
        ]);

        // Assert the response status code
        $response->assertStatus(200);

        // Assert the response contains the expected data
        $response->assertJson([
            'message' => 'It is raining.',
            'chat' => '123456'
        ]);
    }
}
