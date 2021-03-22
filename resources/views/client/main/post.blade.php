@extends ('layouts.layout')
@section('title')
    {{$post->title}}
@endsection

@section('keywords')
    {{$post->title}},binutrima,Binutrima
@endsection

@section('description')
    {{$post->title}}
@endsection

@section('content')
    <div class="container d-flex flex-column align-items-center">
        <div class="col-lg-9 mb-4" id="post">
            <h1>{{$post->title}}</h1>
            <img class="postImage mt-4 mb-5" src="{{ asset('assets/img/posts/' . $post->postImage->image->path) }}" alt="$post->postImage()->image()->alt"/>
            <div class="row d-flex flex-column flex-sm-row justify-content-around m-0">
                <div class="col-8 col-sm-6 col-md-4 col-lg-4">
                    <div class="row">
                        <div class="col-3 mt-1">
                            <img class="authorImage zaobljeno" src="{{ asset('assets/img/users/' . $post->user->userImage->image->path) }}" alt="{{$post->user->userImage->image->alt}}"/>
                        </div>
                        <div class="col-9">
                            <p class="mb-1">{{$post->user->first_name . ' ' . $post->user->last_name}}</p>
                            <p class="siva">{{date('j M \'y', strtotime($post->created_at))}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-11 col-sm-6 d-flex justify-content-start justify-content-sm-end mb-3 mb-sm-0">
                    <div class=" rounded d-flex justify-content-center align-items-center pe-1" id="postLike">
                        <button data-rating-index="1" class="btn" @guest  disabled="disabled" @endguest><i class="fas fa-chevron-up zelena"></i></button><span class="ms-2">{{$postLike}}</span>
                    </div>
                    <div class=" rounded ms-2 d-flex justify-content-center align-items-center pe-1" id="postDislike">
                        <button data-rating-index="0" class="btn" @guest  disabled="disabled" @endguest><i class="fas fa-chevron-down text-danger"></i></button><span class="ms-2">{{$postDislike}}</span>
                    </div>
                </div>
            </div>
            <div class="mb-5 mt-3" id="postText">
                {!! $post->text!!}
            </div>
            <p>Kategorije:
            @foreach($post->categories as $category)
                    <a class="zelena" href="{{route('categories.show', $category->id)}}">{{strtolower($category->name)}}</a>@if(!$loop->last), @endif
            @endforeach
            </p>
        </div>
        <div class="col-12 col-lg-9" id="comments">
            <h3>Komentari</h3>
            @if(!$hasComments ||  !Auth::user())<hr/>@endif
            @if(!$hasComments)<p>Budite prvi koji će komentarisati</p>@endif
            @guest <p class="fw-bold mb-2">Da bi ste glasali i  komentarisali morate biti prijavljeni! <a href="{{route("login.index")}}" class="zelena text-decoration-none">Prijavi se</a></p> @endguest
            <div id="comment-section"></div>
            @auth
                <div class="col-12">
                    <form action="{{route('posts.comments.store', $post->id)}}" method="post">
                        <div class="form-group">
                            <label for="commentInput" class="mb-2 ms-2">Unesite vaš komentar:</label>
                            <textarea class="form-control zaobljeno" name="commentInput" id="commentInput" rows="3"></textarea>
                            <div class="row mt-2"><span class="text-danger"></span></div>
                            <button type="submit" id="commentSubmit" class="btn bg-dark zaobljeno text-white zelelnaPrevlaka mt-2 ms-2">Pošalji</button>
                            <div class="alert alert-danger m-0 info mt-3" id="errorCom">
                                Došlo je do problema prilikom objavljivanja komentara, molimo pokušajte kasnije.
                            </div>
                            <div class="alert alert-success m-0 info mt-3" id="successCom">
                                Uspešno objavljen komentar!
                            </div>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
        <input type="hidden" name="postId" id="postId" value="{{$post->id}}"/>
    </div>
@endsection
