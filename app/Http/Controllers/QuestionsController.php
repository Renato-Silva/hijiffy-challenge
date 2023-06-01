<?php

namespace App\Http\Controllers;

use App\Services\DialogFlowService;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    protected DialogFlowService $service;

    public function __construct(DialogFlowService $service)
    {
        $this->service = $service;
    }

    public function ask(Request $request) {
        $validated = $request->validate([
            'question' => 'string|required',
            'chat' => 'string|nullable'
        ]);

        $response = $this->service->query($request->user(), $validated['question'], $validated['chat']);

        return [
            'message' => $response['text'],
            'chat' => $response['session']
        ];
    }
}
