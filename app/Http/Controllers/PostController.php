<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function vote($postId, Request $request){
        $oppositeIndex = $request->ratingIndex == 1? 0 : 1;
        $vote = PostRating::where('post_id', $postId)->where('user_id', $request->userId)->first();
        $povratniNiz = [];
        $post = Post::find($postId);
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
            $postRating = new PostRating();
            $postRating->updated_at = now();
            $postRating->user()->associate($user);
            $postRating->post()->associate($post);

            $postRating->rating_index = $request->ratingIndex;
            $postRating->created_at = now();
            $postRating->save();
        }
        $povratniNiz['redirect'] = true;
        return response()->json($povratniNiz, 200);


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::channel('access')->info("Nov pristup postu", ["post_id"=>$id, 'time'=>now(), 'ip'=>request()->ip()]);
        $this->data["post"] = Post::find($id);
        $this->data['hasComments'] = Comment::where('post_id', $id)->count();
        $this->data['postLike'] = PostRating::where('post_id', $id)->where('rating_index', 1)->count();
        $this->data['postDislike'] = PostRating::where('post_id', $id)->where('rating_index', 0)->count();
        return view('client.main.post', $this->data);
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
}
