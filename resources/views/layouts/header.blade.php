<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="PhotoApp - From BeeMedia">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <!-- CSS -->
    <meta name="theme-color"  content="#4966a8">
    <link href="images/icon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href=" {{ asset('dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/Fonts.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/styles_profile.css') }}" />
    <script src="{{ asset('assets/js/vendor/jquery-slim.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/holder.min.js') }}"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <title>PhotoApp - @yield('title')</title>
    <!-- Optional JavaScript -->
  </head>

<header>


  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <p style="font-size:25px">PHOTO</p>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse"  id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <form class="form-inline my-2 my-lg-0 ml-2">
          <input dir="rtl" class="form-control mr-sm-2" id="search" type="search" placeholder="البحث عن مستخدمين"  autocomplete="off" aria-label="Search">
        </form>
        <div class="navbar-nav">
          <a style="background-color:#4966a8 ; color:#fff" class=" btn " href="{{ route('logout') }}"
            onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
              تسجيل الخروج
              <svg width="2em" height="23px" viewBox="0 0 16 16" class="bi bi-box-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M11.646 11.354a.5.5 0 0 1 0-.708L14.293 8l-2.647-2.646a.5.5 0 0 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"/>
                <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                <path fill-rule="evenodd" d="M2 13.5A1.5 1.5 0 0 1 .5 12V4A1.5 1.5 0 0 1 2 2.5h7A1.5 1.5 0 0 1 10.5 4v1.5a.5.5 0 0 1-1 0V4a.5.5 0 0 0-.5-.5H2a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-1.5a.5.5 0 0 1 1 0V12A1.5 1.5 0 0 1 9 13.5H2z"/>
              </svg>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </ul>
    </div>
  </nav>






















  <nav class="fixed-bottom d-flex justify-content-center py-2 border-top" style="margin-top: 61px; background-color:#fff ; ">
    <a href="{{url('home')}}">
      <button class=" btn btn-home mx-1 {{ isset($border_active_home) ?  $border_active_home : '' }}">
        <svg style="fill: {{ isset($active_home) ? $active_home : '#161616' }}" width="2em" height="23px"  viewBox="0 0 121 121" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <g transform="scale(0.2363)">
          <path transform="rotate(180) scale(-1,1) translate(0,-512)" d="M213 85h-106v171h-64l213 192l213 -192h-64v-171h-106v128h-86v-128z"/>
          </g>
      </svg>
      </button>
    </a>
    <a href="{{url('user/followers')}}">
      <button class=" btn btn-home mx-1 {{ isset($border_active_follow) ?  $border_active_follow : '' }}" href="#">
        <svg style="fill: {{ isset($active_follow) ? $active_follow : '#161616' }}" width="2em" height="23px" style="position:absolute;height:100%;width:100%;left:0;top:0" viewBox="0 0 121 121" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <g transform="scale(0.2363)">
          <path transform="rotate(180) scale(-1,1) translate(0,-512)" d="M341 235c50 0 150 -25 150 -75v-53h-128v53c0 32 -17 56 -42 74c7 1 14 1 20 1zM171 235c50 0 149 -25 149 -75v-53h-299v53c0 50 100 75 150 75zM171 277c-35 0 -64 29 -64 64s29 64 64 64s63 -29 63 -64s-28 -64 -63 -64zM341 277c-35 0 -64 29 -64 64s29 64 64 64s64 -29 64 -64s-29 -64 -64 -64z"/>
          </g>
        </svg>
      </button>
    </a>
    <a href="{{url('users')}}">
      <button class=" btn btn-home mx-1 {{ isset($border_active_user) ?  $border_active_user : '' }}" href="#">
        <svg style="fill:{{ isset($active_user) ? $active_user : '#161616' }}" width="2em" height="23px" style="position:absolute;height:100%;width:100%;left:0;top:0" viewBox="0 0 121 121" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <g transform="scale(0.2363)">
          <path transform="rotate(180) scale(-1,1) translate(0,-512)" d="M256 57l-31 28c-110 100 -182 165 -182 246c0 66 51 117 117 117c37 0 73 -18 96 -45c23 27 59 45 96 45c66 0 117 -51 117 -117c0 -81 -72 -147 -182 -247z"/>
          </g>
      </svg>
      </button>
    </a>
    <?php
    // $id=auth()->user()->id;
    // $name= auth()->user()->name;
    // <a href="{{url("/$id/$name")}}">
    ?>
    <a href="{{url("user/posts")}}">
      <button class=" btn btn-home mx-1  {{ isset($border_active_profile) ?  $border_active_profile : '' }} " href="#">
        <svg style="fill:{{ isset($active_profile) ? $active_profile : '#161616' }}" width="2em" height="23px" style="position:absolute;height:100%;width:100%;left:0;top:0" viewBox="0 0 121 121" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <g transform="scale(0.2363)">
          <path transform="rotate(180) scale(-1,1) translate(0,-512)" d="M256 213c57 0 171 -28 171 -85v-43h-342v43c0 57 114 85 171 85zM256 256c-47 0 -85 38 -85 85s38 86 85 86s85 -39 85 -86s-38 -85 -85 -85z"/>
          </g>
      </svg>
      </button>
    </a>
  </nav>
</header>



























<body>
 {{--  <header style="position:  fixed;z-index:  10000;width:  100%;">
    <div class="navbar navbar-dark bga box-shadow">
      <div class="container d-flex justify-content-between" style="direction:  rtl;">
        <div class="row" style="width: 100%">
          <div class="col-md-2">
            <a href="#" class="">
              <img src="{{ asset('assets/img/logo_black.svg') }}" style="width: 73%;float:  right;">
            </a>
          </div>
          <div class="col-md-8">
            autocomplete="off" تمنع متصفح من حفظ الكلمات الذي تم البحث عليها سابقاً وتقديمها كامقترح
            <input class="form-control" id="search" style="direction: rtl;width: 100%" type="text" placeholder="البحث" aria-label="Search" autocomplete="off" >
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary col-3" type="button" onclick="location.href='{{url('user/profile')}}';" >
              <i class="fa fa-user"></i>
            </button>
    <!--         <button class="navbar-toggler" type="button" >
              <i class="fa fa-heart"></i>
            </button> -->
            <button class="btn btn-primary col-3 " type="button" onclick="location.href='';" >
              <i  class="fa fa-plus"></i>
            </button>

          </div>  
        </div>  
      </div>
    </div>
  </header> --}}
  </html>