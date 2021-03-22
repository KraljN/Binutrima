<div class="d-flex mb-3">
    <div class="col-2 col-sm-1 col-lg-2">
        <p class="siva fs-1">{{$loop->iteration}}</p>
    </div>
    <div class="col-lg-10">
        <a href="{{route('posts.show', $post->id)}}" class="tamna text-decoration-none">{{$post->title}}</a>
        <p class="mt-2 mb-1 author">{{$post->user->first_name . ' ' . $post->user->last_name}}</p>
        <p class="siva date">{{date('j M \'y', strtotime($post->created_at))}}</p>
    </div>
</div>
