@extends('main')
@section('content')

@section('title','| Welcome')

    <div class="row">
          <div class="jumbotron ">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
          </div>
    </div> <!-- end of row -->
    <div class="row">
        <div class="col-md-6" >

            @foreach($posts as $post)
                <div class="post">
                    <h2> {{$post->title}}</h2>
                    <p>{{substr($post->body,0,300)}}{{strlen($post->body)>300?'...':''}}</p>
                    <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read more</a>
                </div>
                   <hr>
            @endforeach
        </div>
        <div class="col-md-4 offset-md-2 ">
            <h1>Side bar</h1>
        </div>
    </div>

@endsection