<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.header')
    <main>   
        @yield('content')
        <style>
            .border-bottom-acctive {
  border-bottom: 2px solid #4966a8 !important;
}
.btn-home {
  color: #fff;
  background-color: #f3f3f3;
  border-color: #f3f3f3;
}
.btn-home:focus {
  color: #ffe319;
  background-color: #e2dddd;

  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.5);
}

        </style>
    </main>
    @include('layouts.footer')
</html>
