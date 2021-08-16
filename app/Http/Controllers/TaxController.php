<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function calculateTaxes($userId)
    {

        $user = User::find($userId);
        if(!$user){
           return new \Exception('User not found',403);
        }

        if(!$user->is_taxed){
            return 0;
        }

        $income = Income::where('user_id',$userId)
            ->whereBetween('transcation_date',[
                now()->subYear()->startOfYear(),
                now()->subYear()->endOfYear()])
            ->sum('transaction_amount');

        return ($income >50000) ? $income * 0.2 : $income * 0.15;
    }

    //unclean code example
    public function case0($isExpired,$expirationDateString)
    {
        $isExpired = true;
        $expirationDateString = "2021-08-11T22:37:17.726825Z";
    }


    public function case1(){

        $isBlocked = true;

        if($isBlocked){
            //Do something
        }

        if(!$isBlocked){

        }
    }

    public function case2($data){

        $canFetchData = $data['status'] == 'idle' && (!$data['error'] || $data['error']['code'] !== 3 );
        if($canFetchData){
            //do something
            //fetchdata();
            //resetState();
        }
    }


    public function case3($meeting,$userId){

        $meetingHasStarted = now() > $meeting['startTime'];
        $hasCreatedMeeting = $userId === $meeting['creatorId'];
        $hasCancelPermission = $hasCreatedMeeting || ($meeting['permissions'] && $meeting['permission']['canCancel']);
        $showResult = $meetingHasStarted && $hasCancelPermission;

        if($showResult){
            //doSomething
            //return $result
        }
    }
}

//early return



