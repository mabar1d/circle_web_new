<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;

class NewsController extends Controller
{
    public function newsList()
    {
        $token = session()->get('token');
        $user = session()->get('user');
        $auth = "Bearer " . $token;
        $client = new GuzzleHttpClient(['defaults' => [
            'verify' => false
        ]]);
        $url = env('API_CIRCLE') . 'getListNews';
        $requestBody['user_id'] = $user->id;
        $requestBody['search'] = "";
        $requestBody['page'] = 1;

        try {
            $response = $client->request('POST', $url, ['Authorization' => $auth, 'form_params' => $requestBody]);
        } catch (\Throwable $th) {
            dd($th);
        }
        $responseBody = json_decode((string) $response->getBody());
        return view('news/listNews', ["artikels" => $responseBody->data]);
    }

    public function addNews()
    {
        return view('news/addNews');
    }
}
