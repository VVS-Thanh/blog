<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.jwt:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        if (count(User::where('email', 'like', $request->email)->get()) != 1) {
            return response(['status' => 'error', 'message' => 'The email is incorrect.'], 401);
        }
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'The password is incorrect.',
            ], 401);
        }
        $user = User::where('id', Auth::id())->with('profile')->first();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        if (count(User::where('email', 'like', $request->email)->get()) > 0) {
            return response(['status' => 'Failed', 'message' => 'Email already exists'], 400);
        }
        if (count(User::where('phone', 'like', $request->phone)->get()) > 0) {
            return response(['status' => 'Failed', 'message' => 'Phone already exists'], 400);
        }
        if ($request->password !== $request->confirmPassword) {
            return response(['status' => 'Failed', 'message' => 'confirm password dosen\'t match passowrd'], 400);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => 1,
            'password' => Hash::make($request->password)
        ]);
        $user->profile()->save(new Profile());
        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function me()
    {
        $user = null;
        try {
            $user = User::where('id', Auth::id())->with('profile')->with('role')->with('posts.comments')->first();
        } catch (Exception $exception) {
        }
        if (empty($user)) return response(['Messsage' => '`Unauthorized`'], 403);
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function getAllPostByUser()
    {
        return Post::where('user_id', Auth()->id())->with('user.profile')->with('likes')->with('type_of_post')->with('comments.user.profile')->get();
    }

    public function updateUser(Request $request)
    {
        $user = User::where('id', Auth::id())->with('profile')->first();
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
            'user' => $user,
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}