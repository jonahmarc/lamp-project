<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Hamcrest\Type\IsObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{
    public function form(){
        if(View::exists('form')){
            return view('form');
        }
        else {
            return abort(404);
        }
    }

    public function review(){
        if(View::exists('review')){
            return view('review', ['customer' => []]);
        }
        else {
            return abort(404);
        }
    }

    public function info(Request $request){

        $customer = DB::table('customer')
                    ->select('firstname', 'lastname', 'email', 'city', 'country', 'filepath')
                    ->where('email', '=', $request->email)
                    ->first();
        if ($customer) {
            return view('review', ['customer' => $customer]);
        }
        else {
            return view('review', ['customer' => ['error' => 'No customer information found!']]);
        }
    }


    public function save(Request $request){

        $result = DB::table('customer')
                    ->where('email', '=', $request->email)
                    ->first();
        if ($result) {
            $customer = Customer::find($result->id);
            $customer->firstname = $request->firstname;
            $customer->lastname = $request->lastname;
            $customer->city = $request->city;
            $customer->country = $request->country;
            $customer->save();
        }
        else {
            $validated = $request->validate([
                "firstname" => "required",
                "lastname" => "required",
                "email" => "required|email:rfc,strict,dns,filter",
                "city" => "required",
                "country" => "required",
                "filepath" => "required"
            ]);

            $customer = Customer::create($validated);
        }
        return view('form');
    }
}
