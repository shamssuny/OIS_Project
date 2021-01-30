<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function create()
    {
        //validation will run here . .  for time save not included
        Account::create([
            'account_name'=> request('account_name'),
            'bank_id' => request('bank_id'),
            'account_no' => request('account_no'),
            'branch' => request('branch'),
            'account_type' => request('account_type'),
            'swift_code' => request('swift_code'),
            'route_no' => request('route_no')
        ]);

        return response()->json(['status' => 'data'],200);
    }

    public function getData()
    {
        $data = Account::query()->with('bank')->get();
        return response()->json(['data' => $data]);
    }

    public function getOneAccount($id)
    {
        $data = Account::query()->with('bank')
        ->where('id',$id)->get();
        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        Account::find($id)->delete();
        return response()->json(['status' => 'ok']);
    }
}
