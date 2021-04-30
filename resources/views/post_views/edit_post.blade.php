@extends('layouts.app')
@section('content') 
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card mb-8 box-shadow">             
          <img class="card-img-top" src="{{asset($post->image_path)}}" alt="Card image cap">
          <div class="card-body" style="direction: rtl;">
            <form method="POST" action="{{action('PostController@update', $post['id'])}}">
            {{ csrf_field() }}
              <input type="hidden" name="image_path" value="{{$post['image_path']}}">
              <textarea class="form-control" id="post_body" placeholder="" name="body" required>{{$post['body']}}</textarea>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group" style="margin-top: 5px;">
                  <button type="submit" class="btn btn-sm btn-outline-secondary mt-4">حفظ التعديلات</button>
                </div>
                <?php $post->created_at = strtotime('created_at');?>
                <small class="text-muted mt-4">{{date('Y-m-d')}}</small>
              </div>
              <input name="_method" type="hidden" value="PATCH">
            </form>  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection