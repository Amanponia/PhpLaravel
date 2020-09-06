 <!------------   ................................   STUDENT  BOOK RETURN PAGE   ........................-------------->
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
     <a class="nav-link" href="bookissue">BookIssue</a>
   </li>
   <li class="nav-item">
     <a class="nav-link active" href="bookReturn">BookReturn</a>
   </li>
 </ul>

 </ul>

 @endsection






 @section('content')

 <div class="card-header" style="background:yellow">
   <h2>Book To Return</h2>
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
       <th scope="col">Pay</th>
       <th scope="col">Action</th>

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

       @if($i->Fine > 0 )
       <td>{{$i->Fine}}</td>
       <td>
         <form action="AmoutnPaid">
           <input hidden value="{{$i ->bookserial}}" name="bookserial">
           <input hidden value=" {{ Auth::user()->name }} " name="username">
           <input hidden value="{{$i -> id}}" name="bookid">
           <Button class="btn btn-primary" name="Return">Pay</Button> </form>
       </td>




       @else
       <td>No Fine</td>
       <td>
         <form action="returnbook">
           <input hidden value="{{$i ->bookserial}}" name="bookserial">
           <input hidden value=" {{ Auth::user()->name }} " name="username">
           <input hidden value="{{$i -> id}}" name="bookid">
           <Button type="submit" class="btn btn-primary" name="Return">Return</Button>
         </form>
       </td>


       @endif



     </tr>
     @endforeach
   </tbody>
 </table>
 @endsection