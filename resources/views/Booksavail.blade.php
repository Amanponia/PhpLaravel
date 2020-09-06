@extends('layouts.app')

@section('nav-items')
<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="/admin" Active>Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="BooksListt">Books</a>
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
  <br />
  <h3 align="center" underline> <U> ALL BOOK AVAILABLE</U> </h3>
  <HR>
  </HR>

  <br />
  <div class="row">
    <div class="col-md-10">
      <input type="text" name="full_text_search" id="full_text_search" class="form-control" placeholder="Search" value="">
    </div>
    <div class="col-md-2">
      @csrf
      <button type="button" name="search" id="search" class="btn btn-success">Search</button>
    </div>
  </div>
  <br />
  <hr>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Serial_ID</th>
          <th scope="col">Title</th>
          <th scope="col">Author</th>
          <th scope="col">Field</th>
          <th scope="col">No. of copies</th>
          <th scope="col">Edition</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

  </div>
</div>
<button style="float : right ; " class="w3-button w3-xxlarge w3-circle w3-red w3-card-4 " data-toggle="modal" data-target="#AddBook">+</button>

<!-- Add Form Modal  -->
<form action="addbook" method="post">

  @csrf
  <div class="modal fade" id="AddBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color:blue;"> <u> Add New Book To Library :- </u> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="usr">Serial_ID</label>
            <input type="number" class="form-control" required name="Serial_ID" id="usr">
          </div>
          <div class="form-group">
            <label for="usr">Title:</label>
            <input type="text" class="form-control" required name="bookname" id="usr">
          </div>
          <div class="form-group">
            <label for="Author">Author:</label>
            <input type="text" class="form-control" required name="author" id="pwd">
          </div>
          <div class="form-group">
            <label for="sel1">Field:<label>
                <select class="form-control" name="category" required id="sel1">
                  <option>Education & Reference</option>
                  <option>Literature & Fiction</option>
                  <option>Science & Math.</option>
                  <option>Teen & Young Adult.</option>
                  <option>History</option>
                  <option>Biographies & Memoirs.</option>
                  <option>Best Sellers</option>
                  <option>Sci-Fi & Fantasy.</option>


                </select>
          </div>
          <div class="form-group">
            <label for="quantity">No. of copies</label>
            <input type="number" class="form-control" name="quantity" required id="number">
          </div>
          <div class="form-group">
            <label for="quantity">Edition</label>
            <input type="year" class="form-control" name="Edition" required id="number">
          </div>
          <!-- <div class="form-group">
  <label for="pwd">Password:</label>
  <input type="password" class="form-control" id="pwd">
</div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>


@endsection







@section('javascript')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {

    load_data('');

    function load_data(full_text_search_query = '') {
      var _token = $("input[name=_token]").val();
      $.ajax({
        url: "{{ route('full-text-search.action') }}",
        method: "POST",
        data: {
          full_text_search_query: full_text_search_query,
          _token: _token
        },
        dataType: "json",
        success: function(data) {
          var output = '';
          if (data.length > 0) {
            for (var count = 0; count < data.length; count++) {
              output += '<tr>';
              output += '<td>' + data[count].id + '</td>';
              output += '<td>' + data[count].serialID + '</td>';
              output += '<td>' + data[count].name + '</td>';
              output += '<td>' + data[count].Author + '</td>';
              output += '<td>' + data[count].Category + '</td>';
              output += '<td>' + data[count].Quantity + '</td>';
              output += '<td>' + data[count].Edition + '</td>';
              output += '</tr>';
            }
          } else {
            output += '<tr>';
            output += '<td colspan="6">No Book Found</td>';
            output += '</tr>';
          }
          $('tbody').html(output);
        }
      });
    }

    $('#search').click(function() {
      var full_text_search_query = $('#full_text_search').val();
      load_data(full_text_search_query);
    });

  });
</script>
@endsection