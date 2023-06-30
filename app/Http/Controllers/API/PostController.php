<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 0;
        $per_page = 30;
        $post = Post::where('id', '<>', null);
        if (isset($request->keyword)) {
            $post = Post::where('contents', 'like', '%' . $request->keyword . '%')->orWhere('topic', 'like', '%' . $request->keyword . '%');
        }
        if (isset($request->page)) {
            $page = $request->page;
        }
        if (isset($request->per_page)) {
            $per_page = $request->per_page;
        }
        if (isset($request->order)) {
            $per_page = $request->per_page;
        }
        return $post->limit($per_page)->offset($page * $per_page)->with('user.profile')->with('likes.profile')->with('comments.user.profile')->with('type_of_post')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $request->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->contents = $request->contents;
        $post->topic = $request->topic;
        $post->thumbnail_image = $request->thumbnail_image;
        $post->like = 0;
        if (empty(Auth()->user())) return response(['status' => false, 'message' => 'Unauthorized'], 400);
        Auth()->user()->posts()->save($post);
        if (isset($request->type)) {
            foreach ($request->type as $key => $typeItem) {
                $type = Type::where('name', $typeItem)->first();
                if (empty($type)) {
                    $type = new Type;
                    $type->name = $typeItem;
                    $type->save();
                }
                $post->type_of_post()->save($type);
            }
        }
        return Post::where('id', $post->id)->with('user')->with('type_of_post')->first();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->with('user')->with('likes')->with('comments.user.profile')->with('type_of_post')->first();
        if (empty($post)) {
            return response(['message' => 'Not Found'], 400);
        }
        return $post;
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
        $post = Post::find($id);
        if (!empty($post)) {
            if (isset($request->contents)) {
                $post->contents = $request->contents;
            }
            if (isset($request->topic)) {
                $post->topic = $request->topic;
            }
            if (isset($request->like)) {
                $post->like = $request->like;
            }
            if (isset($request->thumbnail_image)) {
                $post->thumbnail_image = $request->thumbnail_image;
            }
            if (isset($request->type)) {
                $post->type_of_post()->detach();
                foreach ($request->type as $key => $typeItem) {
                    $type = Type::where('name', $typeItem)->first();
                    if (empty($type)) {
                        $type = new Type;
                        $type->name = $typeItem;
                        $type->save();
                    }
                    $post->type_of_post()->save($type);
                }
            }
            $post->save();
            return Post::where('id', $post->id)->with('type_of_post')->with('user')->first();
        } else {
            return response(['message' => 'Not Found'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            return response(['status' => false, 'message' => 'Failed'], 400);
        }
        $post->delete();
        return response(['status' => true, 'message' => 'Success'], 200);
    }

    public function comment(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        if (empty($post)) return response(['status' => false, 'message' => 'Failed'], 400);
        $user = null;
        try {
            $user = User::where('id', Auth::id())->first();
        } catch (Exception $exception) {
            echo $exception;
        }
        if (empty($user)) return response(['status' => false, 'message' => 'Unauthorized'], 400);
        $comment = new Comment();
        $comment->content = $request->contents;
        $post->comments()->save($comment);
        $user->comment_of_user()->save($comment);
        return $this->show($request->post_id);
    }

    public function like(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        if (empty($post)) return response(['status' => false, 'message' => 'Failed'], 400);
        $user = null;
        try {
            $user = User::where('id', Auth::id())->first();
        } catch (Exception $exception) {
            echo $exception;
        }
        if (empty($user)) return response(['status' => false, 'message' => 'Unauthorized'], 400);
        foreach ($post->likes as $key => $like) {
            if ($like->id === $user->id) {
                $post->likes()->detach($user);
                return $this->show($request->post_id);
            }
        }
        $post->likes()->save($user);
        return $this->show($request->post_id);
    }
}