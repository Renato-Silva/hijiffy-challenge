<?php

namespace App\Services;

use Exception;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Illuminate\Support\Facades\File;

class DialogFlowService
{
    protected $sessionsClient;

    public function __construct()
    {
        $filePath = storage_path('dialogflow/' . config('services.dialogflow.key_file'));

        // Check if file exists
        if (!File::exists($filePath)) {
            throw new Exception('Dialogflow auth file not found.');
        }

        $this->sessionsClient = new SessionsClient([
            'credentials' => storage_path('dialogflow/' . config('services.dialogflow.key_file')),
        ]);
    }

    public function query(string $question): string {

        $session = $this->sessionsClient->sessionName(config('services.dialogflow.project_id'), uniqid());

        $textInput = new TextInput();
        $textInput->setText($question);
        $textInput->setLanguageCode('en-US');

        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        $response = $this->sessionsClient->detectIntent($session, $queryInput);

        return $response->getQueryResult()->getFulfillmentText();
    }

    public function __destruct() {
        $this->sessionsClient->close();
    }

}
