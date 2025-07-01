<?php

namespace App\Services\Midtrans;

class Notification
{
    private $response;

    public function __construct($input_source = "php://input")
    {
        $raw_notification = json_decode(file_get_contents($input_source), true);
        $this->response = $raw_notification;
    }

    public function __get($name)
    {
        if (isset($this->response[$name])) {
            return $this->response[$name];
        }
    }

    public function getResponse()
    {
        return $this->response;
    }
}
