<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function getData()
    {
        $banks = Bank::all();
        return response()->json(['banks' => $banks]);
    }
}
