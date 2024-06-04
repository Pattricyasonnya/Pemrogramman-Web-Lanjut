<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Serba Store | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugin/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ asset(' adminlte/index2.html') }}"><b>SERBA</b> STORE</a>
  </div>
  
  <!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p>

   {{-- pesan error --}}
   @if ($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif

@if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif

    <form action="{{ route('autentifikasi') }}" method="POST">
      @csrf
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Username" name='username'>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input id="password" type="password" class="form-control" placeholder="Password" name="password">
        <div class="input-group-append">
          <div class="input-group-text">
            {{-- menghubungkan icon mata pada event onclick --}}
            <span id="password-icon" class="fas fa-eye" onclick="passwordMata()"></span>
          </div>
        </div>
      </div>
        

        <!-- MENUJU KE WELCOME.BLADE.PHP ATAU DASHBOARD -->
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button> 
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- MENUJU KE REGISTER.BLADE.PHP ATAU MEMBUAT AKUN BARU -->
    <p class="mb-0">
      <a href="{{route('signup')}}" class="text-center">Register a new membership</a>
    </p>
  </div>
  <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>


<!-- untuk mengubah terlihat dan tidaknya password -->
<script>
  // mengubah tipe inputan dari password -> text
  function passwordMata(){
    var passwordField = document.getElementById('password');
    var passwordIcon = document.getElementById('password-icon');
    // mengganti icon mata menjadi  mata silang 
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
      // mengganti icon mata silang menjadi mata 
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
</script>
</body>
</html> 












{{-- @extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url): '')
    @php( $register_url = $register_url ? route($register_url): '')
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url): '')
@else 
    @php( $login_url = $login_url ? url($login_url): '')
    @php( $register_url = $register_url ? url($register_url): '')
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url): '')
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
@error('login_gagal')
<div class="alert alert-warning alert-dismissible dafe show" role="alert">
  <span class="alert-inner--text"><strong>Warning</strong> {{ $message }}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror  
<form action="{{url('proses_login')}}" method="POST">
  @csrf

  {{-- email field --}}
  {{-- <div class="input-group mb-3">
    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
      value="{{old('username')}}" placeholder="Username" autofocus>

  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-envelope {{config('adminlte.classes_auth_icon', '')}}"></span>
    </div>
  </div>

  @error('username')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div> --}}


  {{-- password field --}}
  {{-- <div class="input-group mb-3">
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
      value="{{old('password')}}" placeholder="{{__('adminlte::adminlte.password')}}" autofocus>

  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-lock {{config('adminlte.classes_auth_icon', '')}}"></span>
    </div>
  </div>

  @error('password')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div> --}}

  {{-- login field --}}
{{-- <div class="row">
  <div class="col-7">
    <div class="icheck-primary" title="{{__('adminlte::adminlte.remember_me_hint')}}">
    <input type="checkbox" name="remember" id="remember" {{old('remember') ? 'checked' : ''}}>
  <label for="remember">
    {{__('adminlte::adminlte.remember_me')}}
  </label>
  </div>
  </div>
  <div class="col-5">
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary')}}">
    <span class="fas fa-sign-in-alt"></span>
    {{__('adminlte::adminlte.sign_in')}}
    </button>
  </div>
</div>
</form>  
{{-- @stop --}}

{{-- @section('auth_footer')
@if ($register_url)
<p class="my-0">
  <a href="{{ route('register')}}">
  {{__('adminlte::adminlte.register_a_new_membership')}}
</a>
</p>
@endif
@stop  --}}


