<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class PostController extends Controller
{
    public function index(){

        // $posts = Post::all()->paginate(2);
        $posts = auth()->user()->posts()->paginate(1);
        return view('admin.posts.index', compact('posts'));
    }
    
    public function show(Post $post)
    {
        return view('blog-post', compact('post'));
    }
    public function create()
    {
        $this->authorize('create',Post::class);

        return view('admin.posts.create');
    }
    public function store(){

        $this->authorize('create',Post::class);

        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            //storage:link add FILESYSTEM_DRIVER from 'config/filesystems.php'
            //to .env file, and add public (FILESYSTEM_DRIVER=public)
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message','Post was Created');

        return redirect()->route('post.index');
    }

    public function destroy(Post $post){

        $this->authorize('delete',$post);

        
        $path = parse_url($post->post_image);//remove http://localhost

        File::delete(public_path($path['path']));//delete from public folder
    
        $post->delete();  

        session()->flash('post-deleted-message','Post was Deleted');

        return redirect()->route('post.index');
    
    }
    public function edit(Post $post){

        $this->authorize('view',$post);
    
        return view('admin.posts.edit',compact('post'));
    
    }
    public function update(Post $post){
    
        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image')){
            $post->post_image = request('post_image')->store('images');   
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        // auth()->user()->posts()->save($post);

        $this->authorize('update',$post);

        $post->save();// another way without updating owner name

        //$post->update([]); with array
    
        session()->flash('post-updated-message','Post was Updated');

        return redirect()->route('post.index');
 
    }

    
}
