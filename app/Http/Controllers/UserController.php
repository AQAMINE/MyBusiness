<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;
use CreateTasksTable;
use GuzzleHttp\Handler\Proxy;
use GuzzleHttp\Promise\Create;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    use NotificationTrait;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminuser')->except(['ChangeProfilePic', 'show', 'edit', 'RemoveAccount', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role == 1 && Auth::user()->approvement == 1) {
            $users = User::latest()->get();
            $notificationCounter = $this->NotificationCounter();
            return view('app.users', ['users' => $users], ['notificationCounter' => $notificationCounter]);
        } else {
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

        if (Auth::user()->role == 1 && Auth::user()->approvement == 1) {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users',
                'phone' => 'required|unique:users',
                'email' => 'required|unique:users',
                'role' => 'required',
                'password' => 'required',
            ]);


            $approvement = 0;
            if ($request->input('approvement') == 'on') {
                $approvement = 1;
            }

            $user = new User();
            $user->firstname  = $request->input('firstname');
            $user->name       = $request->input('lastname');
            $user->username   = $request->input('username');
            $user->phone      = $request->input('phone');
            $user->email      = $request->input('email');
            $user->role       = $request->input('role');
            $user->cin        = $request->input('cin');
            $user->password   = Hash::make($request['password']);
            $user->approvement = $approvement;
            $user->save();
            $this->AddNotification(Auth::id(), 'User' . '`' . $request->input('username') . '`' . 'Added successfully!');
            return redirect(route('user.index'));
        } else {
            return abort(404, 'Page not found.');
        }
    }

    // Update User Using Modal
    // Using Custum method for more security
    public function UpdateUser(Request $request)
    {
        if (Auth::user()->role == 1 && Auth::user()->approvement == 1) {

            // Wee need to check for email|username|phone brfore update
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'role' => 'required',
            ]);


            // End Check For Duplacated Record


            $user = User::find($request->input('id'));

            if (!is_null($user)) {
                $approvement = 0;
                if ($request->input('approvement') == 'on') {
                    $approvement = 1;
                }
                $user->firstname  = $request->input('firstname');
                $user->name       = $request->input('lastname');
                $user->username   = $request->input('username');
                $user->phone      = $request->input('phone');
                $user->email      = $request->input('email');
                $user->role       = $request->input('role');
                $user->cin        = $request->input('cin');
                $user->approvement = $approvement;
                $user->save();
                $this->AddNotification(Auth::id(), 'User' . '`' . $request->input('username') . '`' . 'successfully!');
                return redirect(route('user.index'));
            }
            return abort(404, 'Page not found.');
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
        $datas = User::latest()->where('id', $id)->get();
        // $datas = User::find($id)->get();
        if ($id == Auth::id()) {
            $tasksdone = Task::where('privacy', Auth::id())->where('done', 1)->count();
            $undoneTasks = Task::where('privacy', Auth::id())->where('done', 0)->count();

            $notificationCounter = $this->NotificationCounter();
            return view('app.profile', compact(['datas', 'tasksdone', 'undoneTasks', 'notificationCounter']));
        } else {
            return abort(404, 'Page not found.');
        }
        return abort(404, 'Page not found.');
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
        $datas = User::where('id', $id)->first();
        if ($id == Auth::id()) {
            $notificationCounter = $this->NotificationCounter();
            return view('app.profileUpdate', compact(['datas', 'notificationCounter']));
        } else {
            return abort(404, 'Page not found.');
        }
        return abort(404, 'Page not found.');
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

        $request->validate([
            'id_card' => 'mimes:png,jpg,jpeg|max:5048'
        ]);

        $user = User::find($id);
        if (Auth::id() != $id) {

            return abort(404, 'Page not found.');
        }


        if($request->id_card != null) {
            $id_cardName =  'MyBusiness_IdCard' .  time() . '-' . Auth::user()->id . Auth::user()->username . '.' . $request->id_card->extension();
            $request->id_card->move(public_path('UsersProfilesPictures'), $id_cardName);
            $user->id_card = $id_cardName;
        }


        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->name = $request->input('lastname');
        $user->phone = $request->input('phone');
        $user->cin = $request->input('cin');
        $user->role_incompany = $request->input('role_in_company');

        $user->save();
        return redirect(route('showProfile', Auth::id()));
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
        $user = User::find($id);
        if (!is_null($user)) {
            DB::table('users')->where('id', '=', $id)->delete();
            $this->AddNotification(Auth::id(), 'User Id: ' . $id . '  Deleted!');
            return redirect(route('user.index'));
        } else {
            return abort(404, 'Page not found.');
        }
    }

    public function ChangeProfilePic(Request $request)
    {
        # code...
        $request->validate([
            'profile_pic' => 'required|mimes:png,jpg,jpeg|max:5048'
        ]);

        $user = User::find(Auth::user()->id);
        if (!is_null($user)) {
            $ProfilePictureName =  'MyBusiness' .  time() . '-' . Auth::user()->id . Auth::user()->username . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('UsersProfilesPictures'), $ProfilePictureName);
            $user->profile_pic = $ProfilePictureName;
            $user->save();

            $this->AddNotification(Auth::id(), 'Your profile picture updated successfully!');
            return redirect()->back();
        } else {
            return abort(404, 'Page not found.');
        }
    }

    public function findUser(request $request)
    {

        $keyword = $request->input('keyword');

        if (Auth::user()->role == 1 || Auth::user()->role == 2 && Auth::user()->approvement == 1) {

            //Start The olde block

            $users = User::where('name', $keyword)
                ->orWhere('firstname', 'like', '%' . $keyword . '%')
                ->orWhere('username', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('id_card', 'like', '%' . $keyword . '%')->get();

            $notificationCounter = $this->NotificationCounter();
            return view('app.users', ['users' => $users], ['notificationCounter' => $notificationCounter]);
        } else {
            return abort(404, 'Page not found.');
        }
        return abort(404, 'Page not found.');
    }

    public function RemoveAccount($id)
    {
        if (Auth::id() == $id) {
            $user = User::find($id);
            if (!is_null($user)) {
                DB::table('users')->where('id', '=', $id)->delete();
                return redirect(route('logout'));
            } else {
                return abort(404, 'Page not found.');
            }
        }
        return abort(404, 'Page not found');
    }
}
