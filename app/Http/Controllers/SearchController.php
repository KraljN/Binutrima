<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends MostPopularController
{
    public function search(Request $request){
        $search = $request->input('search');
        if(empty(request()->session()->get('searchValue')) || !empty(request()->session()->get('searchValue')) && $search != null){
            request()->session()->put('searchValue', $search);
        }
        $this->data["searchResult"] = Post::whereHas('user', function ($q) use ($search) {
            $q->where('full_name', 'like', '%' . $search . '%');
        }) ->orWhereHas('categories', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('text', 'like', '%' . $search . '%')
            ->paginate(4)->withQueryString();
        return view('client.main.search', $this->data);
    }
}
