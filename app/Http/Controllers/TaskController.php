<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        //Get Users Full Name And Id For SelectBox Option (Edit  And Add Task)
        $usersFullNameAndIds  = User::latest()->where('approvement' , 1)->get();

        //Get All Tasks
        if(Auth::user()->role == 1){
            $tasks = Task::latest()->get();
        }else{
            $tasks = Task::latest()->where('privacy',Auth::id())->orWhere('privacy',0)->get();
        }

        $notificationCounter = $this->NotificationCounter();
        return view('app.tasks' , compact(['usersFullNameAndIds', 'tasks','notificationCounter']));


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
        if (Auth::check() && Auth::user()->role == 1 ) {
            // The user is logged in...
            $notification =  'You have new task to do "' . $request->input('taskTitle') . '"';
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
            //This user not have permession to add task(Just Admins cant add tasks)
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

        //get task info to check if exist and send notification
        $task = Task::find($id);
        if(is_null($task)){
            //404 Error
            return abort(404, 'Page not found.');
        }else{
            $notification = 'Task name: ' . $task->taskTitle . ' Deleted!';
            $this->AddNotification($task->privacy , $notification);
             //Remove Task Just For Admin Users
             DB::table('tasks')->where('id','=',$id)->delete();
            return redirect(route('tasks.index'));
        }
        //404 Error
        return abort(404, 'Page not found.');

    }

     /*
    *Move Task State To Task Done
    */

    public function taskDone($id){
        $task = Task::find($id);
        if(!is_null($task)){
            $notification = 'Task Name: ' . $task->taskTitle . ' Done!';
            //Admin Users can Done Any Task From Any User
           if(Auth::user()->role == 1 ){
                $task = Task::find($id);
                $task->done = true;
                $task->save();
                $this->AddNotification($task->privacy , $notification);
                return redirect(route('tasks.index'));
            }
            //if this task public anyone can move it to done state And Check If this Task For The Auth User
            if($task->privacy == Auth::id() or $task->privacy == 0){
                    $task->done = 1;
                    $task->save();
                    $this->AddNotification($task->privacy , $notification);
                    return redirect(route('tasks.index'));
            }
        }else{
           return abort(404, 'Page not found.');
        }

            return abort(404, 'Page not found.');
    }

    public function taskUndone($id){
        $task = Task::find($id);
        if(!is_null($task)){
            $notification = 'Task Name: '. $task->taskTitle . ' UnDone!';
             //Admin Users can UnDone Any Task From Any User
            if(Auth::user()->role == 1 ){
                $task = Task::find($id);
                $task->done = false;
                $task->save();
                $this->AddNotification($task->privacy , $notification);
                return redirect(route('tasks.index'));
            }
            //if this task public anyone can move it to Undone state And Check If this Task For The Auth User
            if($task->privacy == Auth::id() or $task->privacy == 0){
                    $task->done = false;
                    $task->save();
                    $this->AddNotification($task->privacy , $notification);
                    return redirect(route('tasks.index'));
             }
        }else{
            return abort(404, 'Page not found.');
        }

            return abort(404, 'Page not found.');
    }

    public function EditTask(Request $request){

        //just admins can edit task
        if(Auth::user()->role == 1){
                //check if task exist or not
                $id =  Task::find($request->input('id'));
                if(is_null($id)){
                    //tasknot fund
                    return abort(404, 'Page not found.');
                }else{
                    $notification = 'Task name: ' . $id->taskTitle . ' Updated!';
                    //update task
                    $task = Task::find($request->input('id'));
                    $task->privacy = $request->input('foruser');
                    $task->taskTitle = $request->input('tasktitle');
                    $task->task = $request->input('taskcontent');
                    $task->save();
                    $this->AddNotification($id->privacy , $notification);
                    return redirect(route('tasks.index'));
                }

        }else{
            return abort(404, 'Page not found.');
        }

    }


}
