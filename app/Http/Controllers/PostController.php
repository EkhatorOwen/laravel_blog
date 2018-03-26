<?php

namespace App\Http\Controllers;

use App\Category;
use Faker\Provider\Image as img;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Session;
use App\tag;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Purifier;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //create a variable and store all the blog posts in it form the database
        $posts = Post::orderBy('id','desc')->paginate(5);
       // $posts = DB::table('posts')->pa
        //return a view and pass in the above variable
        return view('posts.index')->with('posts',$posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with('categories',$categories)->with('tags',$tags);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate data
       // $this->validate($request, array(['title'=>'required|max:255','body'=>'required']));
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required',
            'featured_image'=>'sometimes|image'
        ]);
        //store in database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = clean($request->body);
        $post->category_id = $request->input('category_id');

        //save image
        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $post->image =$filename;
        }


        $post->save();

        $post->tags()->sync($request->tags,false);

        //Session::flash('Success','The blog post was successfully saved!');
         $request->session()->flash('success','The blog post was successfully saved!');

         //redirect to another page
        return redirect()->route('posts.show',$post->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
         $request->session()->get('success');
        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Post is the name of the model
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category)
        {
            $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag)
        {
            $tags2[$tag->id] = $tag->name;
        }
      //  $tagsForThisPost = json_encode($post->tags->pluck('id'));

        return view('posts.edit')->with('post',$post)->with('categories',$cats)->with('tags',$tags2);
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
            $this->validate($request,array(
                'title'=>'required|max:255',
                'slug'=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
                'category_id'=>'required|integer',
                'body'=>'required',
                'featured_image'=>'image'
            ));

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = clean($request->input('body'));
        $post->category_id = $request->input('category_id');

        if($request->featured_image)
        {
            //add the new photo

                $image = $request->file('featured_image');
                $filename = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('images/'.$filename);
                Image::make($image)->resize(800,400)->save($location);
                $oldFilename = $post->image;
            //update the database
            $post->image =$filename;
            //Delete the old photo
           Storage::delete($oldFilename);
        }

       $post->save();


        if(isset($request->tags))
        {
            $post->tags()->sync($request->tags);
        } else
        {
            $post->tags()->sync(array());
        }

        $request->session()->flash('success','The blog post was successfully updated!');
       // return view('posts.show')->with('status',$value)->with('post',$post);
       return redirect()->route('posts.show',$post->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        Storage::delete($post->image);
        $post->delete();
        session()->flash('success','The post was successfully deleted!');
        return redirect()->route('posts.index');
    }
}
