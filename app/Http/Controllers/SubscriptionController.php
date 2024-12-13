<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripeSubscriptionRequest;
use App\Models\Plan;
use App\Models\StripeUser;
use App\Models\User;
use App\Models\UserSubscription;
use App\Utils\StripeHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class  SubscriptionController extends Controller
{


public  function index(){

}

public function store(){

}

public function show(){
return view('document.');
}



}
