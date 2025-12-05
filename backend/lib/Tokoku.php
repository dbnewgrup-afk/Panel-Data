<?php
require_once __DIR__ . '/Curl.php';
require_once __DIR__ . '/../models/SettingModel.php';

class Tokoku
{
    private $client_id;
    private $client_secret;
    private $api_url;

    public function __construct($db)
    {
        $setting = new SettingModel($db);

        $this->client_id     = $setting->get('tokoku_client_id');
        $this->client_secret = $setting->get('tokoku_client_secret');
        $this->api_url       = rtrim($setting->get('tokoku_api_url'), '/');
    }

    public function sendOrder($payload)
    {
        $headers = [
            "Content-Type: application/json",
            "X-CLIENT-ID: {$this->client_id}",
            "X-CLIENT-SECRET: {$this->client_secret}"
        ];

        $response = Curl::request(
            $this->api_url,
            'POST',
            $headers,
            json_encode($payload)
        );

        // Convert to array (jangan balikin raw string)
        if (is_string($response)) {
            $response = json_decode($response, true);
        }

        // jika decode gagal
        if (!is_array($response)) {
            return [
                'status' => 0,
                'error' => true,
                'message' => 'Invalid response from provider'
            ];
        }

        return $response;
    }

    public function retryOrder($payload)
    {
        return $this->sendOrder($payload);
    }
}
