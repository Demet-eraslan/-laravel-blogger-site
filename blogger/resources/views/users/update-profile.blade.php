@extends('layouts.app')

@section('content')
<div class="container">
<div class="comment-form-wrap pt-5">

    <h3 class="mb-5">Profil Bilgilerini Güncelle</h3>
    <form action="{{ route('users.update', $user->id)}}" method="POST" class="p-5 bg-light" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="title">Email</label>
        <input type="text" placeholder="Başlık" value="{{$user->email}}" name="email"  class="form-control" id="website">
      </div>
      <div class="form-group">
        <label for="title">İsim</label>
        <input type="text" placeholder="İsim" value="{{$user->name}}" name="name"  class="form-control" id="website">
      </div>

      <div class="form-group">
        <label for="message">Biyografi</label>
        <textarea  placeholder="Bio" name="bio" id="message" cols="30" rows="10" class="form-control">{{$user->bio}}</textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="Güncelle" class="btn btn-primary">
      </div>

    </form>
  </div>
@endsection
