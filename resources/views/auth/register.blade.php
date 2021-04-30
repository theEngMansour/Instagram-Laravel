<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/img/favicons/favicon.ico">

    <title>إنشاء حساب جديد</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/fonts/fonts.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">


    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/gijgo.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('assets/css/gijgo.min.css') }}" rel="stylesheet" type="text/css" />

  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('assets/img/logo_black.svg') }}" height="90">
        <h2>إملئ البيانات التالية</h2>
        <p >أدخل بياناتك في الاستمارة لإنشاء حساب جديد</p>
      </div>
      <div class="row" style="direction:  rtl;text-align:  right;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <h4 class="mb-3">المعلومات الشخصية</h4>
          <form class="needs-validation bg-white px-4 py-2" novalidate method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div dir="rtl" class="mb-3" dir="ltr">
              @if (count($errors))  {{-- علشان يفحص لي اذا كان في إخطاء ظهر تحذير علشان مايكون دائم ظاهر --}}
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                </ul>
              </div>
            @endif
            <div class="row">
              <!-- <div class="col-md-6 mb-3">
                <label for="firstName">الاسم الأول</label>
                <input type="text" class="form-control" id="الاسم الأول" placeholder="" value="" required>
                <div class="invalid-feedback">
                  أدخل اسمك الحقيقي
                </div>
              </div> -->
              	<div class="col-md-8 mb-3">
	                <label for="name" class="col-md-4 control-label">الاسم الأول</label>
	                <div class="form-group">
	                    <input id="name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }} " required autofocus>
	                </div>
	            </div>
              <div class="col-md-8 mb-3">
                <label for="lastName">الاسم الأخير</label>
                <input type="text" class="form-control" id="الاسم الأخير" placeholder="" value="{{ old('last_name') }} " name="last_name">
              </div>
            </div>


              <label for="username">اسم المستخدم <span style="color:#4966a8 ; font-weight: bold;font-size: 16px">(user_info@)</span></label>{{--  الذي داخل مصفوفة الاخطاء هو اسم الحقل name="name" --}}
              <div class="input-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" id="username" name="name" placeholder="اسم المستخدم" dir="rtl" required value="">

                <div class="invalid-feedback" style="width: 100%;">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                </div>
              </div>
            </div>

    	    <div class="mb-3">
            	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	              <label for="email">البريد الالكتروني </label>
	              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
	              <div class="invalid-feedback">
	                رجاءً أدخل عنوان بريد الكتروني صحيح
	              </div>
	                @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="mb-3">
            	<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                <label for="password" class="col-md-4 control-label">كلمة المرور</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}"  required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
	            </div>
	        </div>

	        <div class="mb-3">
	            <div class="form-group">
	                <label for="password-confirm" class="col-md-4 control-label">تأكيد كلمة المرور</label>
	                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"  required>
	            </div>
	        </div>    

            <div class="row" dir="ltr">
              <div class="col-md-12 mb-3">
                <label for="country">تاريخ الميلاد</label>
                <input id="datepicker" width="100%" name="birth_date"/>
                <div class="invalid-feedback">
                  أدخل قيمة صحيحة ليوم ميلادك
                </div>
              </div>
            </div>

            <hr class="mb-4">
            <button style="background-color: #4966a8;color:#fff" class="btn  btn-lg btn-block mb-3" type="submit">إنشاء حساب</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; From BeeMedia</p>
      </footer>
    </div>
<!-- Begin Hsoub Ads Ad Place code -->

<!-- End Hsoub Ads Ad Place code -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
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
  </body>
</html>
