<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\NotificationTrait;
use App\Models\User;
use App\Models\Task;


class TaskController extends Controller
{

    use NotificationTrait;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('adminuser')->except(['index','taskDone','taskUndone']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Users Full Name And Id For SelectBox Option (Edit  And Add)
        $usersFullNameAndIds  = User::latest()->where('approvement' , 1)->get();

        //Get All Tasks


        return view('app.tasks' , ['usersFullNameAndIds' => $usersFullNameAndIds]);

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
        //Add New Task By Admin
        //Test User Auth
        if (Auth::check()) {
            // The user is logged in...
            $notification =  'You have new task to do ' . $request->input('taskTitle');
            $userid = Auth::id();
            $task = new Task();
            $task->user_id = $userid;
            $task->taskTitle = $request->input('taskTitle');
            $task->task = $request->input('task');
            $task->privacy = $request->input('privacy');
            $task->save();
            $this->AddNotification($request->input('privacy') , $notification);
            return redirect(route('tasks.index'));

        }else{
            return view('login');
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
    }

    public function taskDone($id){

    }

    public function taskUndone($id){

    }

}
