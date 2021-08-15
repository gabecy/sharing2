<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function calculateTaxes($userId)
    {
        $user = User::find($userId);
        if($user){
            if($user->is_taxed){
                $income = Income::where('user_id',$userId)
                    ->whereBetween('transcation_date',[
                        now()->subYear()->startOfYear(),
                        now()->subYear()->endOfYear()])
                    ->sum('transaction_amount');

                if($income >50000){
                    $taxes = $income * 0.2; // 20%
                }else{
                    $taxes = $income * 0.15; // 15%
                }

            }else {
                $taxes = 0;
            }
        }else{
            $taxes = 0;
        }

        return $taxes;
    }
}
