<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return User::with('profile','posts.type_of_post')->get();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('profile')->with('posts.comments')->with('posts.type_of_post')->first();
        if (empty($user)) {
            return response(['Messsage' => 'Not Found'], 400);
        }
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updateUserById(Request $request)
    {
        $user = User::where('id', $request->userId)->with('profile')->first();
        if(empty($user)) return response()->json([
            'status' => 'failed',
            'message' => 'User does not exist'
        ]);
        if (isset($request->lastname)) {
            $user->profile->lastname = $request->lastname;
        }
        if (isset($request->firstname)) {
            $user->profile->firstname = $request->firstname;
        }
        if (isset($request->email)) {
            if (count(User::where('email', 'like', $request->email)->where('id', 'not like', Auth::id())->get()) == 0) {
                $user->email = $request->email;
            } else {
                return response(['Messsage' => 'Email already exists'], 400);
            }
        }
        if (isset($request->phone)) {
            if (count(User::where('phone', 'like', $request->phone)->where('id', 'not like', Auth::id())->get()) == 0) {
                $user->phone = $request->phone;
            } else {
                return response(['Messsage' => 'Phone already exists'], 400);
            }
        }
        if (isset($request->image)) {
            $user->profile->image = $request->image;
        }
        if (isset($request->birthday)) {
            $user->profile->birthday = $request->birthday;
        }
        if (isset($request->avatar)) {
            $user->profile->avatar = $request->avatar;
        }
        if (isset($request->address)) {
            $user->profile->address = $request->address;
        }
        if (isset($request->note)) {
            $user->profile->note = $request->note;
        }
        if (isset($request->name)) {
            $user->name = $request->name;
        }
        $user->profile()->save($user->profile);
        $user->save();
        $user = User::find(Auth::id())->with('profile')->with('role')->first();
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }
}
