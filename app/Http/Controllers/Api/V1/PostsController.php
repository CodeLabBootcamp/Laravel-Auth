<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PostsController extends Controller
{
    public function getPosts(Request $request)
    {
        $posts = Post::all();
//        return $user = JWTAuth::toUser($request->header('Authorization'));
        return response()->json(['posts' => $posts]);
    }


    public function getPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id'
        ]);

        if ($validator->fails())
            return response()->json([
                    'errors' => $validator->errors()->all()]
                , 422);

        $post = Post::find($request->post_id);

        return response()->json(['post'=>$post]);

    }

    public function getUsers()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'users' => $users,
            'errors' => []
        ]);
    }
}
