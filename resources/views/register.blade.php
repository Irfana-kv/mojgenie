@extends('layout')
@section('content')

       <div class="wrapper fadeInDown">
              <div id="formContent">
                     <!-- Tabs Titles -->

                     <!-- Icon -->
                     <div class="fadeIn first">
                            <h2>Create New Account</h2>
                     </div>
                     @if ($errors->any())
                     <div class="alert alert-danger">
                            <ul>
                                   @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                                   @endforeach
                            </ul>
                     </div>
                     @endif
                     <form method="post" id="registerForm">
                            @csrf
                            <input type="text" id="name" class="fadeIn second" name="name" id="name" placeholder="Name*" required>
                            <input type="email" id="login" class="fadeIn second" name="email" id="username" placeholder="Email*" required>
                            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password*" required><br>
                            <input type="checkbox" class="mx-2" id="remember" value="1" required><label for="remember">Agree the terms and poicy</label><br>
                            <input type="submit" class="fadeIn fourth" value="Register">
                     </form>

                     <!-- Remind Passowrd -->
                     <div id="formFooter">
                            <a class="underlineHover" href="{{url('login')}}">Already have an account? Sign In</a>
                     </div>

              </div>
       </div>
       @endsection