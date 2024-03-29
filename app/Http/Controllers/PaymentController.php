<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\Contestantdetail;
use App\Models\Payment;
use App\Models\Votepayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway($id)
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();

            $data = DB::table('contestantdetails')
            ->where('id', $id)
            ->get();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $id)
    {
        $validateVoter = auth()->guard('voter')->user();

        // var_dump($validateVoter);

        // $payment = Votepayment::where()
        $paymentDetails = Paystack::getPaymentData();
        // dd($paymentDetails);   
        $status = $paymentDetails['data']['status'];
        $contestant= Contestant::get();
        // $details = $paymentDetails['data']['metadata']['contestantId'];
        // for ($i=0; $i <$show ; $i++) { 
        //     # code...
        // }
        // for ($f=0; $f < $details; $f++) { 
        //     // $details[$f]['id'];
        //     sleep(3);
        // }
        
        
        try {
            //code...
            if($status=='success'){
                DB::beginTransaction();
                $a= $paymentDetails['data']['amount']/100;
                
                $payment= DB::table('voterpayments')->insert([
                    'contestantName'=> 'dear',
                    'user_id'=>$paymentDetails['data']['metadata']['user_id'],
                    'contestant_id'=>0,
                    'paidAt'=> $paymentDetails['data']['paid_at'],
                    'invoiceId'=> 'hi',
                    'amount'=>$a,
                    'voterName'=>$paymentDetails['data']['metadata']['voter_name'],
                    'customerId'=>$paymentDetails['data']['customer']['id'],
                    'modeOfPayment'=>'Paystack',
                    'created_at' =>now(),
                ]);
                DB::commit();
            }    
                return redirect('voter/dashboard')->with('success', 'Successfully vote payment for contestant!');
        } catch (\Throwable $th) {
            //throw $th;
            echo "error";
            DB::rollBack();
        }
        
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}