<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OAuthController extends Controller
{
    public function authorizeClientView()
    {
        return view('authorize');
    }

    public function authorizeClient(Request $request)
    {
        $params = $request->only('client_id', 'redirect_uri');
        $this->validate($request, [
            'client_id' => 'required',
            'redirect_uri' => 'required',
        ]);
        $client = Client::where('client_id', $params['client_id'])
            ->where('redirect_uri',$params['redirect_uri'])
            ->first();

        if (empty($client)) {
            return redirect()->back()->withErrors("This client doesn't exist in the database");
        }

        $now = new \DateTime();
        $savedDateTime = new \DateTime($client->expires_at);
        $ipAddress = $this->getIpAddress();
        if (empty($client->auth_code) || empty($savedDateTime) || $now > $savedDateTime) {
            $expires = new \DateTime('+ 10 minutes');
            $authCode= base64_encode(auth()->user()->username . ":" . auth()->user()->password);
            $client->auth_code = $authCode;
            $client->expires_at = $expires->format('Y-m-d H:i:s');
            try{
                $client->save();
                return redirect($params['redirect_uri']. "?auth_code=$authCode&ip=$ipAddress");
            }
            catch (\Exception $e) {
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        $authCode = $client->auth_code;
        return redirect($params['redirect_uri'] . "?auth_code=$authCode&ip=$ipAddress");
    }

    private function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_address;
    }

    public function attemptForToken(Request $request) {

        if ($request->hasHeader('Authorization')) {
            $code = $request->header('Authorization');
            $params = $request->only('client_id',
                                     'client_secret',
                                     'grant_type',
                                     'username',
                                     'password');
            $secret = $params['client_secret'] ?? '';
            $client = Client::where('auth_code',$code)->where('client_secret',$secret)->first();
            if (!empty($client)) {
                $expires = new \DateTime($client->expires_at);
                $now = new \DateTime();
                if($expires > $now) {
                    $response = Http::post('http://technical_test.client.cosmicdevelopment.com/api/token/', $params);

                    return $response->json();
                }

            }

            return [
                'status' => 'error',
                'data' => '',
                'msg' => 'Invalid Request Credentials'
            ];

        }
    }
}
