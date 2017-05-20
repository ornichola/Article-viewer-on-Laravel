<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    // Создано через консоль, используя команду php artisan make:controller PostController
    // Однако методы почему-то не создались автоматически. Будут созданы вручную
    
    public function index(Post $postModel)
    {
        //$posts = Post::all();
        ////dd($posts);
        //$posts = Post::latest('id')->get();
        //$posts = Post::latest('published_at')->get();
//        $posts = Post::latest('published_at')
//                ->where('published_at', '<=', Carbon::now())
//                ->get();
        
        $posts = $postModel->getPublishedPosts();
        
        return view('post.index', ['posts' => $posts]);
        //echo 'index';
    }
    
    public function unpublished(Post $postModel)
    {
        $posts = $postModel->getUnPublishedPosts();
        return view('post.index', ['posts' => $posts]);
    }
    
    public function create()
    {
        //
        return view('post.create');
        
    }
    
    public function store(Post $postModel, Request $request)
    {
        ////dd($request->all());
        //$postModel->create($request->all());
        //return redirect()->route('posts');
        
         $post= new Post; 
         $post = $postModel->create($request->all()); 
         
         if($post->published == "on"){
             $post->published = 1;
         } 
         else { 
             $post->published = 0; 
         } 
         
         $post->save();
         
         return redirect()->route('posts');
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update($id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}