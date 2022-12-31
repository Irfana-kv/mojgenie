@extends('layout')
@section('content')

       <div class="wrapper fadeInDown">
              @if (session('success'))
              <div class="alert alert-success" role="alert">
                     <button type="button" class="close" data-dismiss="alert">×</button>
                     {{ session('success') }}
              </div>
              @elseif(session('error'))
              <div class="alert alert-danger" role="alert">
                     <button type="button" class="close" data-dismiss="alert">×</button>
                     {{ session('error') }}
              </div>
              @endif
              <div id="formContent">
                     <!-- Tabs Titles -->

                     <!-- Icon -->
                     <div class="fadeIn first">
                            <h2>User Login</h2>
                     </div>

                     <!-- Login Form -->

                     @if ($errors->any())
                     <div class="alert alert-danger">
                            <ul>
                                   @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                                   @endforeach
                            </ul>
                     </div>
                     @endif
                     <form method="post" id="loginForm">
                            @csrf
                            <input type="text" id="login" class="fadeIn second" name="email" id="username" placeholder="Email" required>
                            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required><br>
                            <input type="checkbox" class="mx-2" id="remember" name="remember" value="1"><label for="remember">Remember me</label><br>
                            <input type="submit" class="fadeIn fourth" value="Log In">
                     </form>

                     <!-- Remind Passowrd -->
                     <div id="formFooter">
                            <a class="underlineHover" href="{{url('register')}}">Don't have account yet? Sign up</a>
                     </div>

              </div>
       </div>
@endsection