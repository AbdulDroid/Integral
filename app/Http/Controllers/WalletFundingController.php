<?php

namespace App\Http\Controllers;

class WalletFundingController extends Controller
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

    public function fundFromCard(){
        $token = $this->getToken();

        $headers = array('content-type' => 'application/json','Authorization'=>$token);

        $query = array(
           'firstname'=> "John",
           'lastname'=> "Doe",
           'email'=>"google@gmail.com",
           'phonenumber'=>"+2348020099002",
           'recipient'=>"wallet",
           'card_no'=> "5289899898983388",
           'cvv'=> "788",
           'pin'=>"8989", //optional required when using VERVE card
           'expiry_year'=>"2022",
           'expiry_month'=>"09",
           'charge_auth'=>"PIN", //optional required where card is a local Mastercard
           'apiKey' =>"tk90iifjkjddjkjkjfnf",
           'amount' =>5000,
           'narration' => "Please add this to your wallet",
           'fee'=>45,
           'medium'=> "web",
           'redirecturl'=> "https://google.com");

        $body = \Unirest\Request\Body::json($query);

        $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/transfer', $headers, $body);

        $response = json_decode($response->raw_body, TRUE);
        $status = $response['status'];
        $data = $response['data'];
        $cardToWallet = var_dump($data);   
    }

    public function fundingAccountValidation() {
        $token = $this->getToken();

        $headers = array('content-type' => 'application/json','Authorization'=> $token);

        $query = array(
            'transactionRef'=> "TeAmInTeGrAl",//obtained from a previous API transfer call
            'authType' => "OTP/ACCOUNT_CREDIT", 
            'authValue' =>"908278"//could be the  OTP value,  this is applicable based on the response from charge request
            );

        $body = \Unirest\Request\Body::json($query);

        $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/transfer/charge/auth/account', $headers, $body);
        $response = json_decode($response->raw_body, TRUE);
        $status = $response['status'];
        $data = $response['data'];
        var_dump($status);
        var_dump($data);

    }

    public function fundingAccountToWallet(){
        echo "WORKS ONLY WITH ACCESS BANK!!\n\n";
        echo "GET OTP BY DIALING *901*4*1#\n\n";
        $token = $this->getToken();

        $headers = array('content-type' => 'application/json','Authorization'=> $token);

        $query = array(
            'firstname'=> "John",
            'lastname'=>"Doe",
            'email'=>"google@gmail.com",
            'phonenumber'=>"+2348200990020",
            'charge_with'=>"account",
            'recipient'=>"wallet",
            'sender_account_number'=>"0690000022",
            'sender_bank'=>"044",
            'apiKey'=>"tk90iifjkjddjkjkjfnf",
            'amount' =>5000,
            'fee'=>45,
            'medium'=> "web",
            'redirecturl'=> "https://google.com");

        $body = \Unirest\Request\Body::json($query);

        $response = \Unirest\Request::post('https://moneywave.herokuapp.com/v1/transfer', $headers, $body);
        $response = json_decode($response->raw_body, TRUE);
        $status = $response['status'];
        $data = $response['data'];
        var_dump($data);
 

    }

}