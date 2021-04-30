@extends('layouts.app')
@section('content')
@section('title' ,'معلومات المستخدم') 
<?php use Illuminate\Support\Str; ?>
<div class="album py-5 bg-light">
  <div class="container"> 
    <div class="row" style="direction:  rtl;text-align:  right;" >
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <h4 class="mb-3 center">المعلومات الشخصية</h4>
        <div class="row">
          <div class="col-md-3 mb-3">
            <img src="{{asset('images/avatar/'.$user->avatar)}}" style="width: 70%;height: 100%;">
          </div>  
          <div class="col-md-6 mb-6">
              <h1 id="name mb-2">{{$user->first_name}} {{$user->last_name}}</h1>
              <h3 id="birth_date mt-2">{{$user->birth_date}}</h3>
              <button class="btn btn-sm btn-outline-secondary" type="button" style="width:  60%;"><i class="fa fa-bullhorn"></i> قام بنشر {{$posts_counts}} منشور!</button> 
              <br>
              <button class="btn btn-sm btn-outline-secondary mt-2" type="button" style="width:  60%;"><i class="fa fa-heart"></i> حصد {{$likes_counts}} إعجاب</button> 
          </div>
          <div class="col-md-3 mb-3">
            @if(isset($is_follower[0]) && $is_follower[0]->accepted==1)
              <button class="btn btn-sm btn-outline-info mt-2" type="button" style="width:  100%;" onclick="location.href='{{url('user/'.$user->id.'/posts')}}';"><i class="fa fa-eye"></i> عرض الصفحة الشخصية</button>
            @elseif(isset($is_follower[0]) && $is_follower[0]->accepted==0)
              <button class="btn btn-sm btn-outline-warning mt-2" type="button" style="width:  100%;"><i class="fa fa-paper-plane"></i>تم ارسال الطلب من قبل</button>
            @else
              <form method="POST" action="{{url('follow')}}">
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                {{ csrf_field() }}
                  <button class="btn btn-sm btn-outline-success mt-2" style="width:  100%;"><i class="fa fa-paper-plane"></i> إرسال طلب متابعة</button>
              </form>  
            @endif  
          </div>
        </div>
        <div class="row">
          @foreach ($posts as $post)
          <div id="profile_content"  class="content_panel">
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
                              <a class="btn btn-sm btn-outline-secondary mt-2" href="{{action('PostController@show', ['id'=>$post->id ,'name'=>$post->user->name])}}">عرض</a>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>  
</div>
@endsection