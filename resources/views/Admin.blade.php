<!--.......................... ..........Librarian Dashboard .............................................-->

@extends('layouts.app')

@section('nav-items')
<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link active " href="#">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="BooksListt">Books</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="LibrarianReq">BookRequest</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/GrantedBooksscreen">GrantedBooks</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/expiredbooks">Overdue</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">StudentRegister</a>
  </li>
</ul>
@endsection


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Admin Dashboard') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          {{ __(' Admin  are logged in!') }}
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <h2 class="w3-center">Automatic Slideshow</h2> -->

<div class="w3-content w3-section" style="max-width:500px">
  <img class="mySlides" src="{{ asset('BookAssets/polity.jpg') }}" style="width:100%">
  <img class="mySlides" src="{{ asset('BookAssets/think.jpeg') }}" style="width:100%">
  <img class="mySlides" src="{{ asset('BookAssets/php.jpg') }}" style="width:100%">
  <img class="mySlides" src="{{ asset('BookAssets/ice&fire.jpg') }}" style="width:100%">
  <img class="mySlides" src="{{ asset('BookAssets/harryy.jpg') }}" style="width:100%">
  <img class="mySlides" src="{{ asset('BookAssets/kalamshab.jpg') }}" style="width:100%">
  <img class="mySlides" src="{{ asset('BookAssets/java2.jpg') }}" style="width:100%">
</div>

<script>
  var myIndex = 0;
  carousel();

  function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {
      myIndex = 1
    }
    x[myIndex - 1].style.display = "block";
    setTimeout(carousel, 2000); // Change image every 2 seconds
  }
</script>


@endsection