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

              @include('menu')

              <div id="formContent">
                     <!-- Tabs Titles -->

                     <!-- Icon -->
                     <div class="fadeIn first">
                            <h2>Deposit Money</h2>
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
                     <form method="post" id="depositForm">
                            @csrf
                            <input type="number" id="amount" class="fadeIn second" name="amount" placeholder="Enter Your Amount" required>
                            <input type="submit" class="fadeIn fourth" value="Deposit">
                     </form>

           
              </div>
       </div>
@endsection