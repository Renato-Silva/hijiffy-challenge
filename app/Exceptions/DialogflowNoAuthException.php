<?php

namespace App\Exceptions;

use Exception;

class DialogflowAuthFileNotFoundException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct("Dialogflow auth file not found.");
    }
}
