<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index() {
        $plans = Plans::get();

        return view('subscriptions.plans', compact('plans'));
    }
}
