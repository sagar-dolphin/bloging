@extends('user.app')

@section('bg-img',Storage::disk('local')->url($post->image))
{{-- @section('head')
    <link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
@endsection --}}
@section('title', '')
@section('sub-heading','')

@section('main-content')
    <h1>helo i am post</h1>

@endsection

{{-- @section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection --}}