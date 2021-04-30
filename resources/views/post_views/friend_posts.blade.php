<?php use Illuminate\Support\Str; ?>
@extends('layouts.app')
@section('title' ,'البروفيل') 
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
        @isset($posts)
            <style>
                #profile_header {
                    background-image:url('{{asset('images/avatar/'.$posts[0]->user->avatar)}}') !important;
                }
            </style>
            <img id="profile_header_picture" src="{{asset('images/avatar/'.$posts[0]->user->avatar)}}" />
            <div id="profile_header_container_titles">
                <span id="profile_header_name">{{$posts[0]->user->first_name}} {{$posts[0]->user->last_name}}</span>
                <span id="profile_header_description mb-2"> {{$posts[0]->user->name}}@</span>
            </div>
        @endisset
    </div>
</div>
<nav class="bg-white   d-flex justify-content-center py-2 border-top border-bottom py-4"> الملف الشخصي : {{$posts[0]->user->first_name}} {{$posts[0]->user->last_name}} </nav>
@foreach ($posts as $post)
<div dir="ltr" id="profile_content"  class="content_panel">
    <div id="content_questions" style="direction:  rtl;text-align:  right;">
        <div id="content_questions mb-4">
            <div  class="question">
                    <div class="question_header">
                    <a href="#">
                      <div class="question_header_picture float-right ml-2" style="background-image: url({{asset('images/avatar/'.$post->user->avatar)}});"></div>
                    </a>
                    <div class="question_header_content">
                    <a dir="ltr" href="#" class="question_header_user text-left">{{$post->user->first_name}} {{$post->user->last_name}}
                        <span class="question_header_user_username"><span>@</span>{{$post->user->name}}</span>
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
                    <a class="btn btn-sm btn-outline-secondary mt-2" href="{{action('PostController@show', ['id'=>$post->id ,'name'=>$post->user->name])}}">عرض</a>            
            </div>
        </div>
    </div>
</div>
@endforeach
@isset($posts)
{{$posts->links("pagination::simple-bootstrap-4")}}
@endisset
@endsection