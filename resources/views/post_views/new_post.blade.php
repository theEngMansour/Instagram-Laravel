@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/demo.css') }}">
@section('title' ,'منشور جديد') 
<style>
    .c-upload__image{width:100%;min-height:200px;display:flex;align-items:center;justify-content:center;
    background:url('{{asset('dist/img/upload.svg')}}') no-repeat center;background-size:150px;margin-bottom:20px}
</style>
@section('content') 
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="direction:  rtl;text-align: right;">
        <form method="POST" action="{{url('post')}}" enctype="multipart/form-data">
            <!-- @csrf -->
            {{ csrf_field() }}
            @if (count($errors))  {{-- علشان يفحص لي اذا كان في إخطاء ظهر تحذير علشان مايكون دائم ظاهر --}}
                <div class="alert alert-danger" style="margin-top: 20px">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                </div>
            @endif
            <div class="row" style="margin-top: 20px " >
                <div class="component-container"  style="margin-top: 20px">
                    <div class="c-upload js-upload">
                        <header class="c-upload__header mb-4">
                          <h4 class="c-upload__title">الصـورة</h4>
                          <label class="c-upload__label" id="button-image">ارفع الصورة</label>
                          <span class="c-upload__label c-upload__label--remove js-upload-remove">احذف الصورة</span>
                        </header>
                        <div class="c-upload__body">
                          <div class="c-upload__image"><img class="js-upload-placeholder"></div>
                          <input type="text" id="image1" class="form-control" name="filename"
                          aria-label="Image" aria-describedby="button-image" required> 
                          <span class="c-upload__subtitle mt-2">مســـار الصورة</span>
                        </div>
                    </div>
                <div class="col-md-12 mb-6">
                <div class="c-form__row mb-4">
                    <div class="c-textfield">
                        <label style="font-size: 20px" for="product-desc" class="c-textfield__label mb-4">حول الصورة</label>
                        <textarea name="body" class="c-textfield__textarea mb-4" placeholder="ادخل الوصف" id="product-desc"></textarea>
                        <span class="c-textfield__hint"></span>
                        <button type="submit" style="margin-bottom: 50px;"class=" col-10 mr-4 ml-4 col-md-12 c-btn c-btn--primary">نشر الصورة</button> 
                    </div>
                </div>
            </div>









































          
        </form>
        </div>
        </div>
       
    </div>

    <!-- JS -->
<script>
document.addEventListener("DOMContentLoaded", function() {

  document.getElementById('button-image').addEventListener('click', (event) => {
    event.preventDefault();

    inputId = 'image1';

    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
  });

  // second button
  document.getElementById('button-image2').addEventListener('click', (event) => {
    event.preventDefault();

    inputId = 'image2';

    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
  });
});

// input
let inputId = '';

// set file link
function fmSetLink($url) {
  document.getElementById(inputId).value = $url;
}
</script>
    <script src="{{ asset('dist/js/upload.js') }}">  </script>
</div>
@endsection