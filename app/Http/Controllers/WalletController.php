<?php

namespace App\Http\Controllers;

class WalletController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getToken(){
        $api_key = 'ts_VZJ5K36HYKSVE4VRS5VC';
        $secret_key = 'ts_09443SHY1WRF56TZBYRK0Z55OOO68C';

        \Unirest\Request::verifyPeer(false);

        $headers = array('content-type' => 'application/json'); 
        $query =  array('apiKey' => $api_key, 'secret' => $secret_key);

        $body = \Unirest\Request\Body::json($query);

        $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/merchant/verify', $headers, $body);

        $response = json_decode($response->raw_body, TRUE);

        $status = $response['status'];

            if (! $status == 'success') {
                echo 'INVALID TOKEN';
            } else {

                $token = $response['token'];

                return $token;
            }
        }

    public function createWallet(){
                $token = $this->getToken();
                $headers = array('content-type' => 'application/json', 'Authorization' => $token);
                $query = array(
                'name' => "Ayoola Abdulrahman",
                'lock_code' => "0lanrewaJU",
                'user_ref' => "024",
                'currency' => "NGN");

                $body = \Unirest\Request\Body::json($query);

                $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/wallet', $headers, $body);

                $response = json_decode($response->raw_body,TRUE);
                $status = $response['status'];
                $data = $response['data'];
                $createWallet = var_dump($data);
    }

    public function transfer(){ 
                $token = $this->getToken();
                $headers = array('content-type' => 'application/json', 'Authorization' => $token);
                $query = array(
                'sourceWallet' => "Abdulrahman Abdulkarim",
                'recipientWallet' => "Abdulrahman Ayoola",
                'amount' => "20000",
                'currency' => "NGN",
                'lock' => "0lanrewaJU");

                $body = \Unirest\Request\Body::json($query);

                $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/wallet', $headers, $body);

                $response = json_decode($response->raw_body,TRUE);
                $status = $response['status'];
                if ($status == 'success') {
                    $data = $response['data'];
                } else {
                    if (array_key_exists('code', $response)) {

                        $data = $response['message'];
                    }
                }
                $transfer = var_dump($response);
            }

                public function transferAccount(){
                $token = $this->getToken();
                $headers = array('content-type' => 'application/json', 'Authorization' => $token);
                $query = array(
                'lock' => "0lanrewaJU",
                'amount' => "20000",
                'bankcode' => "063",
                'accountNumber' => "0053357462",
                'currency' => "NGN",
                'senderName' => "Abdulrahman Abdulkarim",
                'narration' => "Please manage it",
                'ref' => "KFKJ90099");

                $body = \Unirest\Request\Body::json($query);

                $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/wallet', $headers, $body);

                $response = json_decode($response->raw_body,TRUE);
                $status = $response['status'];
                if ($status == 'success') {
                    $data = $response['data'];
                } else {
                    if (array_key_exists('code', $response)) {
                        $data = $response['message'];
                    }
                    
                }
                $transferAccount = var_dump($data);
            }

            public function walletBalance() {
                $token = $this->getToken();
                $headers = array('content-type' => 'application/json','Authorization'=> $token);

                $response = \Unirest\Request::get('https://moneywave.herokuapp.com/v1/wallet', $headers);

                $data = json_decode($response->raw_body, true);
                $walletBalance = $data['data'];
                return view('walletBalance', compact('walletBalance'));

    }

    public function walletCharge() {
        $token = $this->getToken();
        $headers = array('content-type' => 'application/json','Authorization'=> $token);
        $query = array('amount'=> 10000,'fee' => 45);

        $body = \Unirest\Request\Body::json($query);

        $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/get-charge', $headers, $body);
        $data = json_decode($response->raw_body, TRUE);
        $walletCharge = var_dump($data['data']);
    }
}
