@extends('main')

@section('title','| Create New Post')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fqjjaeqcxklqn5cz60stx1dax4zera2d55t55bihi8cranui"></script>
    <script>
        tinymce.init({
           selector: 'textarea',
            plugins: 'link',
            menubar: false
        });

    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Create New Post</h1>
            <hr>
            {!! Form::open(['route' => 'posts.store','data-parsley-validate' =>'','files'=>true]) !!}
                {{form::label('title','Title:')}}
                {{form::text('title',null,array('class'=>'form-control','required'=>'', 'maxlength'=>'255'))}}

                {{Form::label('slug','Slug:')}}
                {{Form::text('slug',null,['class'=>'form-control','required'=>'','minlength'=>'5','maxlength'=>'255'])}}

            {{Form::label('category_id','Category:')}}
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value='{{$category->id}}'>{{$category->name}}</option>
                @endforeach
            </select>

            <br>

            {{Form::label('tags','Tags:')}}
            <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                @foreach($tags as $tag)
                    <option value='{{$tag->id}}'>{{$tag->name}}</option>
                @endforeach
            </select>

            <br>
            <br>
            {{Form::label('featured_image','Upload Featured Image:')}}
            {{Form::file('featured_image')}}

                 {{form::label('body','Post')}}
                 {{form::textarea('body',null, array('class'=>'form-control'))}}
                 {{form::submit('Create Post',array('class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top: 20px;'))}}
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">
        $(".select2-multi").select2();
    </script>

@endsection