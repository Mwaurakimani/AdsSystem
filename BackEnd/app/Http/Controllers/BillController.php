<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function createBill(){
    }

    public function updateBill($campaign,$action){
        $owner = $campaign->owner;

        $beginningOfMonth = date('Y-m-01');
        $endOfMonth = date('Y-m-t');

        $currentBill = $owner->currentBill()
            ->where('start_date',$beginningOfMonth)
            ->where('end_date',$endOfMonth)->first();

        DB::beginTransaction();

        if(!$currentBill){
            try {
                $currentBill = Bill::create([
                    'user_id' =>  $owner->id,
                    'start_date' =>  $beginningOfMonth,
                    'end_date' =>  $endOfMonth,
                    'amount' => 0,
                ]);

                DB::commit();
            }catch (\Exception $err){
                DB::rollBack();
                Helpers\ddh($err->getMessage());
            }
        }

        if($action == 'click'){
            $currentBill->amount = $currentBill->amount + 100;
        }else{
            $currentBill->amount = $currentBill->amount + 0.02;
        }

        $currentBill->save();
    }

    public function deleteBill(){

    }
}
