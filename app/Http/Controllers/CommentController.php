<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentRating;
use App\Models\PostRating;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $komentari = Comment::with('user', 'user.userImage', 'user.userImage.image', 'ratings')->where('post_id', $id)->get()->toJson();
        return response($komentari, 200);
    }


    public function vote($postId, $commentId, Request $request){
        $oppositeIndex = $request->ratingIndex == 1? 0 : 1;
        $vote = CommentRating::where('comment_id', $commentId)->where('user_id', $request->userId)->first();
        $comment = Comment::find($commentId);
        $user = User::find(intval($request->userId));
        if(!empty($vote) && $vote->rating_index == $request->ratingIndex){
            $povratniNiz["disenchant"] = true;
            $vote->rating_index = null;
            $vote->save();
        }
        else if(!empty($vote) && ($vote->rating_index == $oppositeIndex || $vote->rating_index == null) ){
            $vote->rating_index = $request->ratingIndex;
            $vote->updated_at == now();
            $vote->save();
        }
        else{
            $commentRating = new CommentRating();
            $commentRating->updated_at = now();
            $commentRating->user()->associate($user);
            $commentRating->comment()->associate($comment);

            $commentRating->rating_index = $request->ratingIndex;
            $commentRating->created_at = now();
            $commentRating->save();
        }

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
    public function store($postId, CommentRequest $request)
    {
        try{
            \DB::transaction(function() use ($request, $postId){
                $comment = new Comment();
                $comment->user_id = $request->userId;
                $comment->post_id = $postId;
                $comment->text = $request->text;
                $comment->created_at = now();
                $comment->updated_at = now();
                $comment->save();
                Log::channel('activity')->info("Postavljen nov komentar", ['ip'=>$request->ip(), 'user_id'=>$request->userId, 'time'=>now(), 'post'=>$postId]);
            });
            return response()->json(['message'=>'success'], 201);
        }
        catch (\Exception $e){
            Log::channel('errors')->error($e->getMessage(), ['ip'=>$request->ip(), 'path'=>$request->path(), 'method'=>$request->method(), 'time'=>now()]);
            return response()->json(['message'=>'error'], 500);
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
    public function destroy($postId, $commentId)
    {
       $comment = Comment::find($commentId);
       $comment->delete();
    }
}
