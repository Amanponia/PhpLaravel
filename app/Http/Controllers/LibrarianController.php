<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\StudentBook;

class LibrarianController extends Controller
{
  public function __construct()
  {


    // // this function is used to check the student due date crossed or not  if cross then change the status to "Expired"
    $data = StudentBook::all();
    foreach ($data as $i) {

      //  $Returndate =  $i->Duedate  ;
      //  $Todaydate = date("Y-M-d") ; 

      $Returndate = $i->Duedate;
      $Todaydate =  date("Y-m-d");

      if ($Returndate < $Todaydate) {
        // echo  " expired\n ";

        DB::table('StudentBooks')
          ->where('id', $i->id)
          ->where('status', 'Granted')
          ->update(['status' => 'Expired']);
      }
    }
  }





  
  public function AllBook()
  {
    // List all the book 

  
    $bookdata = Book::all();
    return view('Booksavail', ['data' => $bookdata]);
  }

  public function AddBook(Request $req)
  {

    // Add new book  to System 
    $Book  = new Book;
    $Book->serialID = $req->Serial_ID;
    $Book->name = $req->bookname;
    $Book->author = $req->author;
    $Book->category = $req->category;
    $Book->quantity = $req->quantity;
    $Book->Edition = $req->Edition;
    $Book->save();  // Data Pushed
    $bookdata = Book::all();
    return view('Booksavail', ['data' => $bookdata]);
  }




  public function BookRequest()
  {   // List of book are requested for issued
    $StudentBook  = new StudentBook;  // StudentBook table in DB 
    $data = DB::table('StudentBooks')
      ->where('status', 'Requested')
      ->get();

    return view('Libbookrequest', ['data' => $data]);
  }

  public function ShowAllBookGranted()
  {   // List all the books which are issued to students
    $data = DB::table('StudentBooks')
      ->where('status', 'Granted')

      ->get();
    return view('LibShowGrantedBook', ['data' => $data]);
  }
  public function BookGranted(Request $req)
  {
       // Admin accept the student book request and give him duedate to return book
    $date = date("Y/m/d");



    //  echo date('Y-m-d', strtotime($date. ' + 1 days'));
    $Duedate = date('Y/m/d', strtotime($date . ' + 12 days'));
    // $returndate = '2019-09-10';
    DB::table('StudentBooks')
      ->where('id', $req->rowid)
      ->update(['issuedate' => $date]);

    DB::table('StudentBooks')
      ->where('id', $req->rowid)
      ->update(['status' => 'Granted']);

    DB::table('StudentBooks')
      ->where('id', $req->rowid)
      ->update(['Duedate' => $Duedate]);

    // $StudentBook->issuedate = date("Y/m/d") ;
    // // $StudentBook->duedate =   
    // $StudentBook->save();
    $data = DB::table('StudentBooks')
      ->where('status', 'Requested')
      ->get();

    return view('Libbookrequest', ['data' => $data]);
  }



  public function Overdue()
  {
      // List all the book which are Cross duedate(Expired) or in return process , or return successfully with FINE charged 
    // $data = DB::select('select * from StudentBooks where status = ?', ['Expired']);
    // print_r($results);
    $data = DB::table('StudentBooks')
      ->where('status', 'Expired')
      ->orWhere('status', 'RETURN_PROCESS')
      ->orWhere('status', 'RETURN_SUCCESS')
      ->get();
    return view('Liboverdue', ['data' => $data]);
  }

  public function DeleteRecord(Request $req)
  {  // AFTER SUCCESSSFULL RETURN ADMIN MAY DELETE THE RECORD
    DB::table('StudentBooks')->where('id', $req->bookid)->delete();
    $data = DB::table('StudentBooks')
      ->where('status', 'Expired')
      ->orWhere('status', 'RETURN_PROCESS')
      ->orWhere('status', 'RETURN_SUCCESS')
      ->get();
    return view('Liboverdue', ['data' => $data]);
  }
}
  