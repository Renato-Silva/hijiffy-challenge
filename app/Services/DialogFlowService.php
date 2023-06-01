<?php

namespace App\Services;

use App\Models\Session;
use App\Models\User;
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

    public function query(User $user, string $question, ?string $sessionId = null): array {

        $sessionModel = Session::where('session', $sessionId)->first();

        if (!$sessionModel) {
            $sessionModel = Session::create([
                'session' => uniqid(),
                'user_id' => $user->id
            ]);
        }

        $session = $this->sessionsClient->sessionName(config('services.dialogflow.project_id'), $sessionModel->session);

        $textInput = new TextInput();
        $textInput->setText($question);
        $textInput->setLanguageCode('en-US');

        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        $response = $this->sessionsClient->detectIntent($session, $queryInput);

        return [
            'text' => $response->getQueryResult()->getFulfillmentText(),
            'session' => $sessionModel->session
        ];
    }

    public function __destruct() {
        $this->sessionsClient->close();
    }

}
