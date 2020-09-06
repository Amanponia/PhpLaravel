<!------------                      LIBRARIAN SHOW BOOK REQUEST PAGE               -------------->
@extends('layouts.app')


@section('nav-items')
<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="/admin" Active>Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="BooksListt">Books</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="LibrarianReq">BookRequest</a>
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

<div class="card-header" style="background:yellow">
  <h2> Books Which Are Requested By Students : -</h2>
</div>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">StudentName</th>
      <th scope="col">Serial_ID</th>
      <th scope="col">Book</th>
      <th scope="col">Status</th>
      <!-- <th scope="col">Issuedate</th>
        <th scope="col">DueDate</th>
        <th scope="col">Return ON</th>
        <th scope="col">Fine</th> -->
      <th scope="col">Action</th>


    </tr>
  </thead>



  <tbody>
    @foreach($data as $i )
    <tr>
      <th scope="row">{{$i ->id}}</th>
      <td>{{$i ->stud_name}}</td>
      <td>{{$i ->bookserial}}</td>
      <td>{{$i ->bookname}}</td>
      <td style="color:green">{{$i ->status}}</td>
      <!-- <td>{{$i ->issuedate}}</td>
        <td style="color:red">{{$i ->Duedate}}</td>
        <td>{{$i ->studentreturnbook}}</td> -->
      <!-- <td>{{$i ->Fine}}</td> -->

      <td>
        <form action="BookGranted">
          <input hidden type="number" value="{{$i ->id}}" name="rowid" id="rowid" required>
          <Button class="btn btn-success" name="granted">Accept</Button> </form>
      </td>



    </tr>
    @endforeach
  </tbody>
</table>


@endsection