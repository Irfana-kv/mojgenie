
<h2>ABC BANK</h2>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

       <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                     <li class="nav-item {{Request::segment(1)=='home'?'active':''}}">
                            <a class="nav-link" href="{{url('home')}}">Home <span class="sr-only">(current)</span></a>
                     </li>
                     <li class="nav-item {{Request::segment(1)=='deposit'?'active':''}}">
                            <a class="nav-link" href="{{url('deposit')}}">Deposit</a>
                     </li>
                     <li class="nav-item {{Request::segment(1)=='withdraw'?'active':''}}">
                            <a class="nav-link" href="{{url('withdraw')}}">Withdraw</a>
                     </li>
                     <li class="nav-item {{Request::segment(1)=='transfer'?'active':''}}">
                            <a class="nav-link" href="{{url('transfer')}}">Transfer</a>
                     </li>
                     <li class="nav-item {{Request::segment(1)=='statements'?'active':''}}">
                            <a class="nav-link" href="{{url('statements')}}">Statement</a>
                     </li>
                     <li class="nav-item">
                            <a class="nav-link" href="{{url('logout')}}">Logout</a>
                     </li>
              </ul>

       </div>
</nav>