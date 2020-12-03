<?php

namespace App\Http\Controllers\Api\v2;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function buy(Request $request, Course $course)
    {
        $MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be'; //Required
        $Amount = 1000; //Amount will be based on Toman - Required
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = auth()->user()->email; // Optional
        $Mobile = '09123456789'; // Optional
        $CallbackURL = 'http://localhost:8000/api/v2/courses/buy/callback'; // Required


        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );


        if ($result->Status == 100) {
            return redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
        } else {
            echo'ERR: '.$result->Status;
        }
    }

    public function callback()
    {
        $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
        $Amount = 1000; //Amount will be based on Toman
        $Authority = $_GET['Authority'];

        if ($_GET['Status'] == 'OK') {

            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                echo 'Transaction success. RefID:'.$result->RefID;
            } else {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }
}
