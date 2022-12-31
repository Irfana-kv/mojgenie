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

       <!-- <div id="formContent"> -->
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
       <!-- <div class="card mb-4"> -->

       <!-- <div class="card-body"> -->
       <!-- <div class="row"> -->


       <table id="example" class="table table-striped" style="width:100%">
              <thead>
                     <tr>
                            <th>ID</th>
                            <th>Date & Time</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Balance</th>
                     </tr>
              </thead>
              <tbody>
              @foreach($transactions as $transaction)
                     <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$transaction->created_at}}</td>
                            <td>{{$transaction->amount}}</td>
                            
                            @if($transaction->type=='Deposit' || $transaction->type=='TransferDeposit')
                            <td>Credit</td>
                            @else
                            <td>Debit</td>
                            @endif
                            
                            @if($transaction->type=='Transfer')
                            <td>Transfer To {{@$transaction->transferUser->email}}</td>
                            @elseif($transaction->type=='TransferDeposit')
                            <td>Transfer From {{@$transaction->transferUser->email}}</td>
                            @else
                            <td>{{$transaction->type}}</td>
                            @endif
                            <td>{{$transaction->balance}}</td>
                     </tr>
                     @endforeach

              </tbody>
       </table>

       <!-- </div> -->

       <!-- </div>
              </div> -->


       <!-- </div> -->
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
       $(document).ready(function() {
              $(document).ready(function() {
                     $('#example').DataTable();
              });
       })
</script>


@endsection