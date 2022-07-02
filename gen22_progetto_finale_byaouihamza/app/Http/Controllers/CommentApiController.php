<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class CommentApiController extends Controller
{
    public function index()
    {  	
        $comments = Comment::all()->toArray();
        return array_reverse($comments);    
    }

    public function store(Request $request)
    {    	
        $comment = Comment::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            // 'user_id' => Auth::user()->id, non funziona
        ]);
        $comment->save();  
    }

    public function create()
    {
        //
    }

    public function update($id,Request $request)
    {
        $comment = Comment::find($id);
        $comment->update($request->all());

        return response()->json('Comment updated!');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json('Comment deleted!');  
    }

}
