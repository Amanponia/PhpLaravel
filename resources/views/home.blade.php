<!--.......................... ..........Student Dashboard .............................................-->

@extends('layouts.app')

@section('nav-items')
<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link active" href="#">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/studallbook">Books</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="bookissue">BookIssue</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="bookReturn">BookReturn</a>
  </li>
</ul>

</ul>

@endsection

@section('content')

<!-- {{ asset('BookAssets/letusc.jpg') }} -->
<!-- ...................................................screen ............................. -->
<!-- Card design with bootstrap class mx-auto  
        for making it centered in the div-->
<div class="container">
  <div class="row">
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/ice&fire.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Think & Grow</h5>
          <hr>
          <p>George R. R. Martin</p>
        </div>
      </div>


    </div>
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/harryy.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Harry Potter and the Half-Blood Prince</h5>
          <hr>
          <p>J. K. Rowling</p>
        </div>
      </div>


    </div>
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/java2.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">JAVA</h5>
          <hr>
          <p>Herbert Schildt</p>
        </div>
      </div>


    </div>

  </div> <br><br><br>
  <div class="row">
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/polity.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Indian Polity</h5>
          <hr>
          <p>M. Laxmikanth</p>
        </div>
      </div>


    </div>
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/kalamshab.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <hr>
          <p>A. P. J. Abdul Kalam</p>
        </div>
      </div>


    </div>
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/phys.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Physics</h5>

          <a href="#" class="btn btn-primary">Show</a>
          <!-- IssueForm trigger Modal  -->
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#issueModal" onclick="issueform()">Issue</a>
        </div>
      </div>


    </div>

  </div> <br><br><br>
  <div class="row">
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/think.jpeg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Think & Grow</h5>
          <hr>
          <p>Napoleon Hill</p>
        </div>
      </div>


    </div>
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/php.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Php</h5>
          <hr>
          <p>W Jason Gilmore</p>
        </div>
      </div>


    </div>
    <div class="col-md-4">

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('BookAssets/math.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Physics</h5>
          <hr>
          <p>R.D Sharma</p>
        </div>
      </div>


    </div>

  </div>
</div> <br><br><br>


</div>
<!-- ...................xxxxxxxx................................screen ...............xxxxxxxx.............. -->
@endsection