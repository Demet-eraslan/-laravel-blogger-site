@extends('layouts.app')

@section('content')
<div class="container">
<div class="comment-form-wrap pt-5">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{ !! \Session::get('success') !!}</p>
    </div>
 @endif

    <h3 class="mb-5">Yeni Gönderi Oluştur</h3>
    <form action="{{ route('posts.store')}}" method="POST" class="p-5 bg-light" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="title">Başlık</label>
        <input type="text" placeholder="Başlık" name="title"  class="form-control" id="website">
      </div>
      <div class="form-group">

      <select name="category" class="form-select" aria-label="Default select example">
        <option selected>Categori Seçiniz</option>
        @foreach ($categories as $category )
        <option value="{{ $category->name}}">{{ $category->name}}</option>
        @endforeach
      </select>
      </div>

      <div class="form-group">
        <label for="title">Resim</label>
        <input type="file" name="image"  class="form-control" id="website">
      </div>


      <div class="form-group">
        <label for="message">Açıklama</label>
        <textarea placeholder="Açıklama" name="description" id="message" cols="30" rows="10" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="Paylaş" class="btn btn-primary">
      </div>

    </form>
  </div>
@endsection
