<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Photo from BeeMedia">
    <meta name="author" content="">
    <meta name="theme-color" content="#4966a8">
    <link href="./dist/fonts/fonts.css" rel="stylesheet">

    <title>تسجيل الدخول</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/m.css') }}" rel="stylesheet">
  </head>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
    
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

  </style>
  <body class="text-center">
    <div class="d-flex justify-content-md-center mt-4">
      <div class="col-md-6">
        <form class="form-signin bg-white"  style="direction:  rtl;" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
            <img class="d-block mx-auto mb-4" src="{{ asset('assets/img/logo_black.svg') }}" height="90">
            <h2>مرحباً بك في فوتو</h2>
            <h6>فوتو ليسى إنستغرام أو سناب شات , فوتو هو المكان لتحفظ فية صورك بجودتها الاصلية ولا تختفي بعد 24 ساعة !</h6>
            <br>
          <label for="inputEmail" class="sr-only">البريد الالكتروني</label>
          @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
          <input dir="ltr" type="email" name="email" id="email" class="form-control text-right {{ $errors->has('email') ? ' has-error' : '' }}" placeholder="البريد الالكتروني" value="{{ old('email') }}" required autofocus>
          <label for="inputPassword" class="sr-only">كلمة المرور</label>
          @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
          <input dir="ltr" type="password" name="password" required autocomplete="current-password" id="password" class="form-control text-right {{ $errors->has('password') ? ' has-error' : '' }}" placeholder="كلمة المرور" required>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
            </label>
            <style>
              a{
                color: #4966a8;
                text-decoration-line: none
              }
              a:hover{
                color: #4966a8;
                text-decoration-line: none
              }
            </style>
          </div>
          <button style="background-color: #4966a8;color:#fff" class="btn btn-lg btn-block" type="submit">تسجيل الدخول</button>
          <div><a href="{{ route('register') }}" >إنشــاء حساب</a></div>
          <p class="mt-5 mb-3 text-muted"> From BeeMedia &copy;</p>
        </form>
      </div>  
    </div>  
  </body>

</html>
