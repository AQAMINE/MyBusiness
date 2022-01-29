<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\NotificationTrait;
use App\Models\client;

class ClientController extends Controller
{
    use NotificationTrait;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('invoiceandclientmanager');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == 1 || Auth::user()->role == 2 && Auth::user()->approvement == 1 ){
            $clients = client::latest()->get();
            $notificationCounter = $this->NotificationCounter();
            return view('app.clients', ['clients' => $clients],['notificationCounter' => $notificationCounter]);
        }else{
            return abort(404, 'Page not found.');
        }
        return abort(404, 'Page not found.');
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
        //check
        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|unique:clients',
            'city' => 'required',
            'rating' => 'required'
        ]);
        if(Auth::user()->role == 1 || Auth::user()->role == 2 && Auth::user()->approvement == 1 ){
            $client = new client();
            $client->firstname = $request->input('firstname');
            $client->lastname = $request->input('lastname');
            $client->phone = $request->input('phone');
            $client->city = $request->input('city');
            $client->rating = $request->input('rating');
            $client->user_id = Auth::id();
            $notification = 'You add new client '. $request->input('firstname') . ' ' . $request->input('lastname');
            $client->save();
            $this->AddNotification(Auth::id() , $notification);
            return redirect(route('client.index'));
        }else{
            return abort(404, 'Page not found.');
        }

    }
public function EditClient(Request $request){
    if(Auth::user()->role == 1 || Auth::user()->role == 2 && Auth::user()->approvement == 1){
        $client = client::find($request->input('id'));
        if(!is_null($client)){
            $client->firstname = $request->input('firstname');
            $client->lastname = $request->input('lastname');
            $client->phone = $request->input('phone');
            $client->city = $request->input('city');
            $client->rating = $request->input('rating');
            $notification = 'client Updated Id: '. $request->input('id') ;
            $client->save();
            $this->AddNotification(Auth::id() , $notification);
            return redirect(route('client.index'));
        }else{
            return abort(404, 'Page not found.');
        }
    }else{
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
        $client =  client::find($id);
        if(is_null($client)){
              //404 Error
              return abort(404, 'Page not found.');
        }else{
            $notification = 'You are deleted This Client : ' . $client->firstname . ' '. $client->firlastnamestname ;
            $this->AddNotification(Auth::id() , $notification);
            DB::table('clients')->where('id','=',$id)->delete();
            return redirect(route('client.index'));
        }
        return abort(404, 'Page not found.');
    }

    public function FindClient(Request $request){
        $keyword = $request->input('keywordToFind');

        if(Auth::user()->role == 1 || Auth::user()->role == 2 && Auth::user()->approvement == 1 ){

            //Start The olde block

            $clients = client::where('lastname', $keyword)
                ->orWhere('firstname', 'like', '%' . $keyword . '%')
                ->orWhere('lastname', 'like', '%' . $keyword . '%')
                ->orWhere('city', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')->get();
            // $clients = DB::select("SELECT *  FROM clients  WHERE  firstname LIKE '%$keyword%' OR lastname LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR city LIKE '%$keyword%' ",[$keyword],[$keyword],[$keyword],[$keyword]);
            //End The old block
            $notificationCounter = $this->NotificationCounter();
            return view('app.clients', ['clients' => $clients],['notificationCounter' => $notificationCounter]);
        }else{
            return abort(404, 'Page not found.');
        }
        return abort(404, 'Page not found.');


    }

}
