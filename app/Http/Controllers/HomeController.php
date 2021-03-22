<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends MostPopularController
{
    public function home(){
        $this->data['newestPosts'] = Post::with('categories', 'user', 'postImage', 'postImage.image')->orderBy('created_at', 'desc')->limit(4)->get();
        return view('client.main.home', $this->data);
    }

}
