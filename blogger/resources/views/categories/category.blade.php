@extends('layouts.app')
@section('content')

<div class="section search-result-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading">Category: {{$name}}</div>
            </div>
        </div>
        <div class="row posts-entry">
            <div class="col-lg-8">
                @foreach ($posts as $post )
                <div class="blog-entry d-flex blog-entry-search-item">
                    <a href="{{ route('posts.single' , $post->id)}}" class="img-link me-4">
                        <img src="{{ asset('assets/images/'.$post->image.'')}}" alt="Image" class="img-fluid">
                    </a>
                    <div>
                        <span class="date">{{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}} &bullet; <a href="#">{{$post->category}}</a></span>
                        <h2><a href="{{ route('posts.single', $post->id)}}">{{$post->title}}</a></h2>
                        <p>{{ substr($post->description,0,25)}}</p>
                        <p><a href="{{ route('posts.single' , $post->id)}}" class="btn btn-sm btn-outline-primary">Devamı..</a></p>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="col-lg-4 sidebar">


                <!-- END sidebar-box -->
                <div class="sidebar-box">
                    <h3 class="heading">Popüler Gönderiler</h3>
                    <div class="post-entry-sidebar">
                        <ul>
                            @foreach ($popPosts as $posts )
                            <li>
                                <a href="{{ route('posts.single', $post->id)}}">
                                    <img src="{{ asset('assets/images/'.$post->image.'')}}" alt="Image placeholder" class="me-4 rounded">
                                    <div class="text">
                                        <h4>{{$post->title}}</h4>
                                        <div class="post-meta">
                                            <span class="mr-2">{{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}} </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <!-- END sidebar-box -->

                <div class="sidebar-box">
                    <h3 class="heading">Kategoriler</h3>
                    <ul class="categories">
                        @foreach ($categories as $category )
                        <li><a href="{{route('category.single', $category->name)}}">{{ $category->name}} <span>{{ $category->total}}</span></a></li>
                        @endforeach

                    </ul>
                </div>
                <!-- END sidebar-box -->




            </div>
        </div>
    </div>
</div>
@endsection
