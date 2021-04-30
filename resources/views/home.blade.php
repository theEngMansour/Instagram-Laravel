@extends('layouts.app')

@section('content')
@section('title' ,'الرئيسية') 
<?php use Illuminate\Support\Str; ?>
@isset($posts)
@foreach ($posts as $post)
<div dir="ltr" id="profile_content"  class="content_panel">
    <div id="content_questions">
        <div id="content_questions" style="direction:  rtl;text-align:  right;">
            <div  class="question">
                    <div class="question_header">
                    <a href="{{url('user/'.$post->user->id.'/posts')}}">
                      <div class="question_header_picture float-right ml-2" style="background-image: url({{asset('images/avatar/'.$post->user->avatar)}});"></div>
                    </a>
                    <div class="question_header_content">
                    <a dir="ltr" href="{{url('user/'.$post->user->id.'/posts')}}" class="question_header_user text-left">
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
                    <div  class="badge">
                        <img  src="{{asset('images/like/facebook-reaction-like.png')}}" width="25" >
                        <span class="badge badge-light">{{$post['likes_count']}}</span>
                        <span class="badge badge-primary"> التعليقات {{$post['comments_count']}} </span>
                    </div>

                    <a class="btn btn-sm btn-light" href="{{action('PostController@show', ['id'=>$post->id ,'name'=>$post->user->name])}}">عرض</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@isset($posts)
<div>
{{$posts->links("pagination::simple-bootstrap-4")}}
</div>
@endisset
@endisset
@endsection
