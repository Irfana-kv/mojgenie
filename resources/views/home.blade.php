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
                     <h2>Welcome {{auth()->user()->name}}</h2>
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
              <div class="card mb-4">

                     <div class="card-body">
                            <div class="row">
                                   <div class="col-sm-3">
                                          <p class="mb-0">Your Id</p>
                                   </div>
                                   <div class="col-sm-9">
                                          <p class="text-muted mb-0">{{auth()->user()->email}}</p>
                                   </div>
                            </div>
                            <div class="row">
                                   <div class="col-sm-3">
                                          <p class="mb-0">Balance</p>
                                   </div>
                                   <div class="col-sm-9">
                                          <p class="text-muted mb-0">{{$balance>0?$balance:0}} INR</p>
                                   </div>
                            </div>
                     </div>
              </div>


       </div>
</div>

@endsection