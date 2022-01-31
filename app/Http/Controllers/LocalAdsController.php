<?php

namespace App\Http\Controllers;

use App\Http\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LocalAds;
use App\Models\User;


use Illuminate\Http\Request;

class LocalAdsController extends Controller
{
    use NotificationTrait;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminuser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $ads = LocalAds::latest()->get();


        $notificationCounter = $this->NotificationCounter();
        return view('app.localAdsManager', compact(['ads', 'notificationCounter']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if (Auth::user()->role == 1 && Auth::user()->approvement == 1) {
            $this->validate($request, [
                'content' => 'required',
                'end_date' => 'required',
            ]);


            $status = 0;
            if ($request->input('status') == 'on') {
                $status = 1;
            }

            $localAd = new LocalAds();
            $localAd->content  = $request->input('content');
            $localAd->created_at       = $request->input('created_at');
            $localAd->end_date   = $request->input('end_date');
            $localAd->status = $status;
            $localAd->user_id = Auth::id();
            $localAd->save();
            $this->AddNotification(Auth::id(), 'Local Ad created successfully!');
            return redirect(route('LocalAds.index'));
        } else {
            return abort(404, 'Page not found.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ad =  LocalAds::find($id);
        if (is_null($ad)) {
            //404 Error
            return abort(404, 'Page not found.');
        } else {
            $notification = 'You are deleted This Ad : ' . $ad->content;
            $this->AddNotification(Auth::id(), $notification);
            DB::table('local_ads')->where('id', '=', $id)->delete();
            return redirect(route('LocalAds.index'));
        }
        return abort(404, 'Page not found.');
    }

    public function hideShowLocalAd($id)
    {
        $ad =  LocalAds::find($id);
        if (is_null($ad)) {
            //404 Error
            return abort(404, 'Page not found.');
        } else {
            $status = $ad->status;
            switch ($status) {
                case 0:
                    $ad->status = 1;
                    $notification = 'Ad ' . $ad->content . ' Is Active!';
                    break;
                case 1:
                    $ad->status = 0;
                    $notification = 'Ad ' . $ad->content . ' Hidden!';
                    break;
            }
            $ad->save();
            $this->AddNotification(Auth::id(), $notification);
            return redirect(route('LocalAds.index'));
        }
        return abort(404, 'Page not found.');
    }
}
