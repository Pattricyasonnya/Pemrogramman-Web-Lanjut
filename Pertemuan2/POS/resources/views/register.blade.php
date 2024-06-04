<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Serba Store | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ asset('adminlte/index2.html') }}"><b>SERBA</b> STORE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

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

{{-- enctype : menyimpan semua bentuk data --}}
      <form method="POST" action="{{ route('proses_register') }}" enctype="multipart/form-data">
      @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama" name="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="confirm_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="file" class="form-control" name="profil_img">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-image"></span>
            </div>
          </div>
        </div>
        <p class="text-muted" style="font-size: 0.800rem;">* Type File Upload: jpg, jpeg, png</p>       

          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ route('login.index') }}" class="text-right">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>




{{-- @extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url): '')
    @php( $register_url = $register_url ? route($register_url): '')
@else 
    @php( $login_url = $login_url ? url($login_url): '')
    @php( $register_url = $register_url ? url($register_url): '')
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')  

<form action="{{url('proses_register')}}" method="POST">
  @csrf

  {{-- nama field --}}
  {{-- <div class="input-group mb-3"> --}}
    {{-- <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
      value="{{old('name')}}" placeholder="Nama" autofocus>

  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-user {{config('adminlte.classes_auth_icon', '')}}"></span>
    </div>
  </div>

  @error('nama')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div> --}}


  {{-- username field --}}
  {{-- <div class="input-group mb-3">
    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
      value="{{old('name')}}" placeholder="Username" autofocus>

  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-user {{config('adminlte.classes_auth_icon', '')}}"></span>
    </div>
  </div>

  @error('username')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div>


  {{-- password field --}}
  {{-- <div class="input-group mb-3">
    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"
    placeholder="{{__('adminlte::adminlte.password')}}" autofocus>

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


  {{-- register field --}}
{{-- <button type="submit" class="btn btn-block {{config('adminlte.classes_auth_btn', 'btn-flat btn-primary')}}">
<span class="fas fa-user-plus"></span>
{{__('adminlte::adminlte.register')}}
</button>
</form>  
@stop

@section('auth_footer')
<p class="my-0">
  <a href="{{ route('login')}}">
  {{__('adminlte::adminlte.i_already_have_a_membership')}}
</a>
</p>
@stop --}}

