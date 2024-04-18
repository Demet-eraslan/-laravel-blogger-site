<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post\PostModel;
use App\Models\post\Category;
use App\Models\post\Comment;
use App\Models\User;
use DB;
use Auth;

class PostsController extends Controller
{
    public function  index(){

        //İLK section
        $posts = PostModel::all()->take(2);
        $postOne = PostModel::take(1)->orderBy('id', 'desc')->get();
        $postTwo = PostModel::take(2)->orderBy('title', 'desc')->get();

        //Business section
        $postBus = PostModel::where('category','Business')->take(2)->get();
        $postBusTwo = PostModel::where('category','Business')->take(3)->orderBy('title','desc')->get();

        //Random posts section
        $randomPosts = PostModel::take(4)->orderBy('category', 'desc')->get();

        //Culture Section
        $postCulture = PostModel::where('category','Culture')->take(2)->orderBy('id','desc')->get();
        $postCultureTwo = PostModel::where('category','Culture')->take(3)->orderBy('category','desc')->get();

        //Technology Section
        $postTech = PostModel::where('category','Technology')->take(9)->orderBy('created_at','desc')->get();

         //Travel Section
         $postTravel = PostModel::where('category','Travel')->take(1)->orderBy('title','desc')->get();
         $postTravelOne = PostModel::where('category','Travel')->take(1)->orderBy('id','desc')->get();
         $postTravelTwo = PostModel::where('category','Travel')->take(2)->orderBy('id','desc')->get();




        return view('posts.index',
        compact('posts', 'postOne', 'postTwo','postBus', 'postBusTwo', 'randomPosts', 'postCulture','postCultureTwo','postTech','postTravel','postTravelOne', 'postTravelTwo'));
    }

    public function single($id){

        $single = PostModel::find($id);
        $user = User::find($single->user_id);

        $popPost = PostModel::take(3)->orderBy('id','desc')->get();

        $categories = DB::table('categories')
        ->join('posts', 'posts.category', '=', 'categories.name')
        ->select('categories.name AS name', 'categories.id AS id', DB::raw('COUNT(posts.user_id) AS total'))
        ->groupBy('posts.category')
        ->get();

        $comments = Comment::where('post_id', $id)->get();
        $commentNum = $comments->count();

        $moreBlogs = PostModel::where('category', $single->category)
        ->where('id', '!=', $id)
        ->take(4)
        ->get();



        return view('posts.single', compact('single', 'user','popPost', 'categories', 'comments', 'moreBlogs', 'commentNum'));

    }

    public function storeComment(Request $request){

        $insertComment = Comment::create([
            "comment" => $request->comment,
            "user_id" => Auth::user()->id,
            "user_name" => Auth::user()->name,
            "post_id" => $request->post_id,
        ]);

        return redirect('/posts/single/'.$request->post_id.'')->with('success', 'Yorumunuz Başarılı bir şekilde oluşturuldu');
    }

    public function CreatePost(){

        $categories = Category::all();
        if(auth()->user()){
            return view("posts.create-post", compact('categories'));
        } else {
            return abort('404');
        }

    }

    public function storePost(Request $request){

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $insertPost = PostModel::create([
            "title" => $request->title,
            "category" => $request->title,
            "user_id" => Auth::user()->id,
            "user_name" => Auth::user()->name,
            "description" => $request->description,
            "image" => $myimage

        ]);

        return redirect('/posts/create-post/')->with('success', 'Gönderi Başarılı bir şekilde oluşturuldu');
    }

    public function deletePost($id){

        $deletePost = PostModel::find($id);
        $deletePost->delete();

        return redirect('/posts/index')->with('delete', 'Gönderi Silindi');
    }

    public function editPost($id){

        $single = PostModel::find($id);
        $categories = Category::all();

        if(auth()->user()){
            if(Auth::user()->id == $single->user_id){
                return view("posts.edit-post", compact('single','categories'));
            } else {
                return abort('404');
            }
        }

    }

    public function updatePost(Request $request, $id){

        $updatePost = PostModel::find($id);
        $updatePost->update($request->all());

        if($updatePost){
           return redirect('/posts/single/'.$updatePost->id.'')->with('update', 'Gönderi Güncellendi');
        }
    }
}
