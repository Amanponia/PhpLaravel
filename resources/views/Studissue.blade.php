<!------------                     STUDENT BOOK ISSUE PAGE            -------------->
@extends('layouts.app')


@section('nav-items')
<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/home') }}">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/studallbook">Books</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="bookissue">BookIssue</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="bookReturn">BookReturn</a>
  </li>
</ul>

</ul>


@endsection

@section('content')

<div class="card">
  <div class="card-header" style="background:yellow">
    <h2>Student Book Issue Form :- </h2>
  </div>
  <div class="card-body">

    <form action="/issueRequest" method="get">
      @csrf
      <div class="form-group">
        <label for="username">Student Name</label>
        <input type="text" value="{{ Auth::user()->name }}" readonly name="Name">
      </div>
      <div class="form-group">
        <label for="bookid">BookSerial</label>
        <input type="number" required name="Bookserial" placeholder="Enter Correct Serial_ID">
      </div>

      <div class="form-group">
        <label for="username">Book Name</label>
        <input type="text" required name="BookName">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">BOOK REQUEST</button>
      </div>

    </form>
  </div>
</div>

<br>
<div class="">
  <div class="card-header" style="background:yellow">
    <h2>List of Pervious Requested Book </h2>
  </div> <br>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Book</th>
        <th scope="col">Serial_ID</th>
        <th scope="col">Status</th>
        <th scope="col">Issuedate</th>
        <th scope="col">DueDate</th>

      </tr>
    </thead>


    <tbody>
      @foreach($data as $i )
      <tr>
        <th scope="row">{{$i -> id}}</th>
        <td>{{$i ->bookname}}</td>
        <td>{{$i ->bookserial}}</td>

        <td style="color:red ">{{$i ->status}}</td>
        <td>{{$i ->issuedate}}</td>
        <td>{{$i ->Duedate}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>


  @endsection