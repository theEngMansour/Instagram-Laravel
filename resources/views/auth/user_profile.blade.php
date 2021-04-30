@extends('layouts.app')
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/gijgo.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('assets/css/gijgo.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/demo.css') }}">
<style>
  .c-upload__image{width:100%;min-height:200px;display:flex;align-items:center;justify-content:center;
  background:url('{{asset('dist/img/upload.svg')}}') no-repeat center;background-size:150px;margin-bottom:20px}
</style>
@section('title','تعديل على الملف الشخصي') 
@section('content') 
<div class="bg-white "  >
  <form style="margin-bottom: 66px;" class="c-form" method="POST" action="{{action('UserController@update')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">
    <div class="c-form__contorls">
        <div class="c-upload c-upload--small js-upload mr-4">
            <header class="c-upload__header mt-4 ">
              <h4 class="c-upload__title mb-4">تغيير الصورة الشخصية</h4>
            </header>
            @if (session('success'))
              <div class="alert alert-success text-right mb-3">
                <p>{{ session('success') }}</p> 
              </div>
            @endif
{{-- session دالة تختبر لك إذا كان في قيمة لمتغير او لا --}}
            <div class="c-upload__body">
              <label for="upload-image" class="c-upload__label">ارفع صورة</label>
              <img class="js-upload-placeholder">
              <input type="file" id="upload-image" accept="image/*" name="filename" class="c-upload__field js-upload-value">
              <span class="c-upload__label c-upload__label--remove js-upload-remove">احذف الصورة</span>
            </div>
        </div>
        <div class="c-form__row">
          <div class="c-textfield">
            <label for="email" class="c-textfield__label mb-4">الاســم الأول</label>
            <input type="text" class="c-textfield__input" placeholder="" id="email" name="first_name" value="{{$user->first_name}}" required="required">
            <span class="c-textfield__hint"></span>
          </div>
          <div class="c-textfield">
            <label for="email-2" class="c-textfield__label mb-4">الاسم الأخير</label>
            <input type="text" class="c-textfield__input" placeholder="" id="email-2"  value="{{$user->last_name}}" name="last_name"required="required">
            <span class="c-textfield__hint"></span>
          </div>
          
        </div>
        <div class="c-form__row"><div class="c-textfield">
          <label for="password" class="c-textfield__label mb-4">تاريخ الميلاد</label>
          <input id="datepicker" class="c-textfield__input" name="birth_date" value="{{$user->birth_date}}" />
          <span class="c-textfield__hint"></span>
        </div>
        <script>
          $('#datepicker').datepicker({
              uiLibrary: 'bootstrap4',
              format: 'yyyy-mm-dd'
          });
        </script>
        </div>
        <button class="btn btn-primary btn-lg btn-block col-6 mb-4 mt-4  mr-4 col-md-4 mb-4" type="submit">حفظ التعديلات</button>
    </div>
  </form>
</div>
<script src="{{ asset('dist/js/upload.js') }}">  </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>window.jQuery || document.write('<script src="{{ asset('assets/js/vendor/jquery-slim.min.js') }}"><\/script>')</script>
    <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/holder.min.js') }}"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
@endsection