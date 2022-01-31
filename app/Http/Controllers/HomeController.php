<?php

namespace App\Http\Controllers;
use App\Models\LocalAds;
use Carbon\Carbon;


use App\Http\Traits\NotificationTrait;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    use NotificationTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Get Today Date
        $timezone = Carbon::now();
        $ads = LocalAds::latest()->where('status', 1)->whereDate('created_at','<=', $timezone)->whereDate('end_date','>=', $timezone)->get();
        $notificationCounter = $this->NotificationCounter();
        return view('home', compact(['ads', 'notificationCounter']));
    }
}
