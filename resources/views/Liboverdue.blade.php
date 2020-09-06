 <!------------ ....................  LIBRARIAN  BOOK EXPIRED_DATE OR RETURN_PROCESS PAGE  ................. -------------->
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
     <a class="nav-link" href="LibrarianReq">BookRequest</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="/GrantedBooksscreen">GrantedBooks</a>
   </li>
   <li class="nav-item">
     <a class="nav-link active" href="/expiredbooks">Overdue</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="{{ route('register') }}">StudentRegister</a>
   </li>
 </ul>

 @endsection
 @section('content')
 <div class="card-header" style="background:yellow">
   <h2> List of All books Which Are Overdue :- </h2>
 </div>

 <table class="table">
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">StudentName</th>
       <th scope="col">Serial_ID</th>
       <th scope="col">Status</th>
       <th scope="col">Issuedate</th>
       <th scope="col">DueDate</th>
       <th scope="col">Fine</th>
       <th scope="col">Action</th>


     </tr>
   </thead>



   <tbody>
     @foreach($data as $i )
     <tr>
       <th scope="row">{{$i ->id}}</th>
       <td>{{$i ->stud_name}}</td>
       <td>{{$i ->bookserial}}</td>
       <td style="color:green">{{$i ->status}}</td>
       <td>{{$i ->issuedate}}</td>
       <td style="color:red">{{$i ->Duedate}}</td>
       <td>{{$i ->Fine}}</td>

       @if(strcmp($i ->status,"RETURN_SUCCESSS" === 0) )


       <td>
         <form action="DeleteRecord">
           <input hidden value="{{$i ->bookserial}}" name="bookserial">
           <input hidden value="{{$i -> id}}" name="bookid">
           <Button class="btn btn-danger" name="Return">DeleteRecord</Button></form>
       </td>



       @else
       <td>
         <form action="BookGranted">

           <input hidden type="number" name="rowid" value="{{$i ->id}}" id="rowid">
           <Button type="submit" class="btn btn-primary" name="granted">Accept</Button> </form>
       </td>



       @endif



     </tr>
     @endforeach
   </tbody>
 </table>



 @endsection