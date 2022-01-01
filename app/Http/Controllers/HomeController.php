<?php

namespace App\Http\Controllers;
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
        $notificationCounter = $this->NotificationCounter();
        return view('home',['notificationCounter' => $notificationCounter]);
    }
}
