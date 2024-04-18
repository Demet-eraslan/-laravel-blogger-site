<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post\Category;
use App\Models\post\PostModel;
use DB;

class CategoriesController extends Controller
{

    public function category($name){

        $posts = PostModel::where('category', $name)
        ->take(5)
        ->orderBy('created_at','desc')
        ->get();

        $popPosts = PostModel::take(3)->orderBy('id','desc')->get();

        $categories = DB::table('categories')
        ->join('posts', 'posts.category', '=', 'categories.name')
        ->select('categories.name AS name', 'categories.id AS id', 'posts.user_id AS user.id',DB::raw('COUNT(posts.user_id) AS total'))
        ->groupBy('posts.category')
        ->get();

        return view('categories.category', compact('posts', 'popPosts','categories', 'name'));

    }

}
