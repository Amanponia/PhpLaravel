<!------------                     STUDENT SHOW ALL BOOK LIST PAGE            -------------->
@extends('layouts.app')
@section('nav-items')
<!-- Links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link " href="{{ url('/home') }}"> Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="/studallbook">Books</a>
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
<div class="container">
  <br />
  <h3 align="center"> Library </h3>
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
          <th scope="col">Name</th>
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