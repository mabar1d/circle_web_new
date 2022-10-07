<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        if (!empty(session()->get('user'))) {
           return redirect()->action([DashboardController::class,'index']);
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => ['required', 'email:dns'],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $client = new GuzzleHttpClient(['defaults' => [
            'verify' => false
        ]]);
        $url = env('API_CIRCLE') . 'login';
        $requestBody['username'] = $request->username;
        $requestBody['email'] = $request->email;
        $requestBody['password'] = $request->password;
        try {
            $response = $client->request('POST', $url, ['form_params' => $requestBody]);
        } catch (\Throwable $th) {
            dd($th);
        }
        $responseBody = json_decode((string) $response->getBody());
        if ($responseBody->code == "00") {
            session()->put('user', $responseBody->data->user);
            session()->put('token', $responseBody->data->access_token);
            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('error', $responseBody->desc);
        }
    }
}
