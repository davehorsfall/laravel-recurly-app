<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \Recurly\Client(env('RECURLY_PRIVATE_API_KEY'));
        $plans = $client->listPlans();

        return view('plans.index')->with('plans', $plans);
    }
}
