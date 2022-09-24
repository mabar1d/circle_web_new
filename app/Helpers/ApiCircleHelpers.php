<?php

namespace App\Helpers;

use GuzzleHttp\Client as GuzzleHttpClient;

class ApiCircleHelpers
{
    public static function sendApi($url, $method = 'POST', $requestBody = [])
    {
        $response = array();
        $token = session()->get('token');
        $auth = "Bearer " . $token;
        try {
            $client = new GuzzleHttpClient(['defaults' => [
                'verify' => false
            ]]);
            $response = $client->request($method, $url, ['Authorization' => $auth, 'form_params' => $requestBody]);
            $response = json_decode((string) $response->getBody(), true);
        } catch (\Throwable $th) {
            dd($th);
        }
        return $response;
    }
}
