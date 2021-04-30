@extends('layouts.app')
@section('content') 
@section('title' ,'عرض المنشور') 
<div dir="ltr" class="album py-5 bg-light ">
    <div class="container" style="margin-bottom: 20px;">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card mb-8 box-shadow">             
            <div class="card-header" style="background-color:  white;">
              <div class="media text-muted pt-3" style="direction:  rtl;">
                <a href="#">
                  <div class="question_header_picture ml-2 mb-2" style="background-image: url({{asset('images/avatar/'.$post->user->avatar)}});"></div>
                </a>
                <div class="question_header_content">
                <a dir="ltr" href="#" class="question_header_user text-left">{{$post->user->first_name}}{{$post->user->last_name}}
                    <p class="question_header_user_username"><span>@</span>{{$post->user->name}}</p>
                </a>
              </div>
              @can('delete',$post)
                <form action="{{action('PostController@destroy', $post['id'])}}" method="POST" >
                  {{ csrf_field() }}
                  <input name="_method" type="hidden" value="DELETE">
                  <button style="margin-right: 36px;" class=" btn btn-sm btn-outline-secondary " >حذف</button>
                </form>
              @endcan
            </div> 
            {{-- image_path اسم العمود في قاعدة البيانات الخاص بالصورة --}}
            
            <img class="card-img-top" src="{{asset($post->image_path)}}" alt="Card image cap">
            <div class="card-body">
              <p class="card-text" style="text-align: right;direction:  rtl;">{{$post['body']}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="row">
                  <div class="btn-group" style="margin-top:  4px;">
                    <button class="btn btn-sm btn-outline-secondary" type="button" ><i class="fa fa-heart" style="margin-right:  10%;">
                    </i><label id="count_id">{{ $count}}</label></button> 
                    <button class="btn btn-sm btn-outline-secondary" id="btn_value_id" onclick="like_action()"> أعجبني </button>
                  </div>
                  <div style="margin-top:  10%; margin-left:  10%;">
                    <iframe src="https://www.facebook.com/plugins/share_button.php?href={{URL::current()}}&layout=button&size=small&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>       
                  </div>
                </div>
                <?php $post->created_at = strtotime('created_at');?>
                <small class="text-muted">{{date('Y-m-d')}} </small>
              </div>
            </div>
            <div class="card-footer" style="direction:  rtl;text-align:  right;">
              <div class="media text-muted pt-3">
                <div class="question_header_picture ml-2 mb-2" style="background-image: url({{asset('images/avatar/'.$post->user->avatar)}});"></div>
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark"></strong>
                  </div>
                  <form action="{{ url('comment') }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="post_id" value="{{$post['id']}}">
                      <div class="row">
                        <div class="col-md-10">
                          <input type="text" name="comment" class="form-control" placeholder="أضف تعليقاً" style="width:  100%;">
                        </div>
                        <div class="col-md-2" style="margin-top:  4px;">  
                          <input style="background-color: #4966a8;color:#fff" type="submit" class="btn btn-sm " name="send" value="إضافة التعليق">
                        </div>  
                      </div>
                  </form> 
                  @foreach ($post_comments->comments as $comment)
                    <div class="media text-muted pt-3">
                      <div class="question_header_picture ml-2 mb-2" style="background-image: url({{asset('images/avatar/'.$comment->user->avatar)}});"></div>
                      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                          <div class="d-flex justify-content-between align-items-center w-100">
                            <strong class="text-gray-dark">{{$comment->user->name}}</strong><br>
                            @if($comment->user->id==auth()->user()->id)
                              <form class="col-9" action="{{action('CommentController@destroy', $comment->id)}}" method="post">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="submit" class="btn btn-danger" value="حذف التعليق">
                              </form>  
                              @endif
                          </div>
                        <span class="d-block">{{$comment->comment}}</span>
                                          {{--  الاول متغير الذي عرفناة في قوراتش والثاني اسم العمود --}}
                      </div>
                    </div>
                  @endforeach  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src = "{{ asset('assets/js/jquery-3.3.1.min.js') }}"> </script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
var like= "أعجبني";
var unlike= "إلغاء الاعجاب";
var token = '{{csrf_token()}}';
var post_id = "{{$post['id']}}";
var like_id = 0;

@if(sizeof($userLike)==1)
like_id = "{{$userLike[0]->id}}";
$('#btn_value_id').html(unlike);
@endif

function like_action(){
if(like_id == 0){
$.ajax({
    type: "POST",
    url: "{{ url('like') }}",
    data: {post_id: post_id, _token: token},
    success: function( msg ) {
        $('#count_id').html(msg.count);
        $('#btn_value_id').html(unlike);
        like_id = msg.id;
    }
});
}
else{
$.ajax({
    type: "POST",
    url: "{{ url('like') }}/"+post_id,
    data: {post_id: post_id, _token: token, _method:"DELETE"},
    success: function( msg ) {
        $('#count_id').html(msg.count);
        $('#btn_value_id').html(like);
        like_id =0;
    }
});
}
}
</script>
@endsection