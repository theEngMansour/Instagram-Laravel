<?php use Illuminate\Support\Str; ?>
@extends('layouts.app')
@section('title' ,'الملف الشخصي') 
<style>
    #profile_header {
        background-image:url(0.jpg) !important;
    }

    #profile_content #content_add {
        border-color: #464646 !important;
    }

    #content_add_bottombar_send {
        background-color: #464646 !important;
    }
</style>
@section('content') 
<div id="profile_header" class="translucent">
    <div id="profile_header_content">
        @foreach($Profiles as $Profile)
            <style>
                #profile_header {
                    background-image:url('{{asset('images/avatar/cover.jpg')}}') !important;
                }
            </style>
            <img id="profile_header_picture" src="{{asset('images/avatar/'.$Profile->avatar)}}" />
            <div id="profile_header_container_titles">
                <span id="profile_header_name">{{$Profile->first_name}} {{$Profile->last_name}}</span>
                <span id="profile_header_description mb-2"> {{$Profile->name}}@</span>
            </div>
        @endforeach
    </div>
</div>
<nav style="margin-bottom: 57px;" class="bg-white   d-flex justify-content-center py-2 border-top border-bottom" >
  <a href="{{url('post/create')}}">
    <button class=" btn btn-home mx-1">
      <svg style="fill: #161616" width="2em" height="23px" style="position:absolute;height:100%;width:100%;left:0;top:0" viewBox="0 0 149 149" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <g transform="scale(0.291)">
        <path transform="rotate(180) scale(-1,1) translate(0,-512)" d="M442 362l-39 -39l-80 80l39 39c8 8 22 8 30 0l50 -50c8 -8 8 -22 0 -30zM64 144l236 236l80 -80l-236 -236h-80v80z"/>
        </g>
    </svg>
    </button>
  </a>
  <a href="{{url('user/profile')}}">
    <button class=" btn btn-home mx-1">
      <svg style="fill: #161616" width="2em" height="23px" style="position:absolute;height:100%;width:100%;left:0;top:0" viewBox="0 0 149 149" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <g transform="scale(0.291)">
        <path transform="rotate(180) scale(-1,1) translate(0,-512)" d="M256 181c41 0 75 34 75 75s-34 75 -75 75s-75 -34 -75 -75s34 -75 75 -75zM415 235l45 -35c4 -3 5 -9 2 -14l-43 -74c-3 -5 -8 -6 -13 -4l-53 21c-11 -8 -23 -16 -36 -21l-8 -56c-1 -5 -5 -9 -10 -9h-86c-5 0 -9 4 -10 9l-8 56c-13 5 -25 12 -36 21l-53 -21c-5 -2 -10 -1 -13 4l-43 74c-3 5 -2 11 2 14l45 35c-1 7 -1 14 -1 21s0 14 1 21l-45 35c-4 3 -5 9 -2 14l43 74c3 5 8 6 13 4l53 -21c11 8 23 16 36 21l8 56c1 5 5 9 10 9h86c5 0 9 -4 10 -9l8 -56c13 -5 25 -12 36 -21l53 21c5 2 10 1 13 -4l43 -74c3 -5 2 -11 -2 -14l-45 -35c1 -7 1 -14 1 -21s0 -14 -1 -21z"/>
        </g>
      </svg>
    </button>
  </a>
</nav>
@foreach ($posts as $post)
<div dir="ltr" id="profile_content"  class="content_panel" style="direction:  rtl;text-align:  right;">
    <div id="content_questions">
        <div id="content_questions mb-4">
            <div  class="question">
                    <div class="question_header">
                    <a href="#">
                      <div class="question_header_picture float-right ml-2" style="background-image: url({{asset('images/avatar/'.$post->user->avatar)}});"></div>
                    </a>
                    <div class="question_header_content">
                    <a dir="ltr" href="#" class="question_header_user text-left">
                      <span class="question_header_user_username"><span>@</span>{{$post->user->name}}</span>
                      {{$post->user->first_name}} {{$post->user->last_name}}
                    </a>
                    <span class="question_header_content">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                    </div>
                    </div>
                    <div class="question_middle">
                    <img class="card-img-top" src="{{asset($post->image_path)}}" alt="Card image cap" style="height: 250px">
                    <p class="mt-2 question_middle_content mb-4">{{str::limit($post['body'], 80 ,"  ...")}}</p>
                    </div>
                    <div class="question_bottom mb-1">
                        <?php $post->created_at = strtotime('created_at');?>
                        <span class="question_bottom_time">{{date('Y-m-d')}}</span>
                    </div>
                    <form action="{{action('PostController@destroy', $post['id'])}}" method="post">
                        <div dir="ltr" class="btn-group mb-4 mt-2">
                        <a class="btn btn-sm btn-outline-secondary" href="{{action('PostController@show',['id'=>$post->id ,'name'=>$post->user->name])}}">عرض</a>
                        <a class="btn btn-sm btn-outline-secondary" href="{{action('PostController@edit', $post['id'])}}">تعديل</a>
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-outline-secondary" >حذف</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@isset($posts)

{{$posts->links("pagination::simple-bootstrap-4")}}
@endisset

@endsection