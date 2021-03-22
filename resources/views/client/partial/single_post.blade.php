<div class="container-fluid p-0 d-flex flex-column-reverse flex-md-row newestSinglePost">
    <div class="col-md-9  text-start mt-4 mt-md-0">
        <a  href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">{{$post->title}}</a>
        <p class="siva mt-2 mt-md-0">{!!  html_entity_decode(Str::limit($post->text, 110))!!}</p>
        <p class="author mb-1">{{$post->user->first_name . ' ' . $post->user->last_name}}</p>
        <p class="date m-0 siva">{{date('j M \'y', strtotime($post->created_at)) }}</p>
    </div>
    <div class="col-md-3"><a href="{{ route('posts.show', $post->id) }}"><img class="newestPostImage rounded" src="{{asset( 'assets/img/posts/' . $post->postImage->image->path)}}" alt="post"/></a></div>
</div>
