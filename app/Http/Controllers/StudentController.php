<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\StudentBook;
use App\Book;
use DateTime;
use Auth;

class StudentController extends Controller
{
  // shows all book list to student
  public function ShowListBook()
  {

    $bookdata  = DB::table('book')->select('id', 'serialID', 'name', 'Author', 'Edition', 'Category')->get();
    return view('Studallbook', ['data' => $bookdata]);
  }






  public function BookIssue()
  {
    //SHOW ALL THE REQUESTED BOOK LIST TO STUDENT(USER) 
  
    $matchThese = ['status' => 'Requested', 'stud_name' =>  Auth::user()->name];
    $data = StudentBook::where($matchThese)->get();

    return view('Studissue', ['data' => $data]);
  }

  //  BookRequest

  public function BookRequest(Request $req)
  { 
    // handle student issue request
    // First check the reqbookserial exists in book database or not 
    if (Book::where('serialID', '=', $req->Bookserial )->exists()) {
      // book exists then, took the name of book 
      $StudentBook  = new StudentBook;  // StudentBook table in DB 
      $Booktitle =  DB::table('Book')
      ->where('serialID', '=', $req->Bookserial)
      ->pluck('name');  // 
      // NOW UPDATE THE DATABASE AND REDIRECT TO PAGE
      $StudentBook->bookserial = $req->Bookserial;
      $StudentBook->stud_name = $req->Name;
      $StudentBook->bookname = $Booktitle[0];
      $StudentBook->status = "Requested";
      $StudentBook->save();
      $matchThese = ['status' => 'Requested', 'stud_name' =>  Auth::user()->name];
      $data = StudentBook::where($matchThese)->get();
      return view('Studissue', ['data' => $data]);
   }
    
       else{  //e no book found Back to page
        echo '<script>alert("Enter the Correct Book Serial")</script>'; 
        $matchThese = ['status' => 'Requested', 'stud_name' =>  Auth::user()->name];
        $data = StudentBook::where($matchThese)->get();
        return view('Studissue', ['data' => $data]);
       }

    
  }

  public function BookReturn(Request $req)
  {
    //show all the expired & Granted book whom student can return
  

    $data = DB::table('StudentBooks')
      ->where('stud_name', '=', Auth::user()->name)
      ->where(function ($query) {
        $query->orwhere('status', '=', 'Granted')
          ->orWhere('status', '=', 'RETURN_SUCCESS')
          ->orWhere('status', '=', 'RETURN_PROCESS')
          ->orWhere('status', '=', 'Expired');
      })
      ->get();




    return view('StudBookReturn', ['data' => $data]);
  }
  //  BookReturn send Request to Librarian

  public function BookReturnTO(Request $req)
  {
    // First : student return book so it change the status : RETURN_PROCESS and store the date on which book return Date

      $returndate = date("Y-m-d");


    $i = $req->bookid;
    $bookserial = $req->bookserial;
    DB::table('StudentBooks')
      ->where('id', $i)
      ->update(['status' => 'RETURN_PROCESS']);  //status changed
    DB::table('StudentBooks')
      ->where('id', $i)
      ->update(['studentreturnbook' => $returndate]); // retrunbook date saved




    // Second : calculate the Fine via using DueDate date & return Date

    $name =  DB::table('StudentBooks')
      ->where('bookserial', '=', $bookserial)

      ->pluck('Duedate');  // "5"

    $datetime1 = new DateTime($name[0]);
    $datetime2 = new DateTime($returndate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%R%a'); //  it gives us the difference in days b/w the Duedate (gives via Librarian) and ReturnDate (on the day student request to  return it)

    //  print_r($days);   THANKYOU BRO..
    if ($days > 0) {
      DB::table('StudentBooks')
        ->where('id', $i)
        ->update(['Fine' => $days * 5]);

      DB::table('StudentBooks')
        ->where('id', $i)
        ->update(['status' => 'RETURN_PROCESS']);  //status changed
      DB::table('StudentBooks')
        ->where('id', $i)
        ->update(['studentreturnbook' => $returndate]); // retrunbook date saved


    } else {

      DB::table('StudentBooks')
        ->where('id', $i)
        ->update(['Fine' => '0']);
      DB::table('StudentBooks')
        ->where('id', $i)
        ->update(['status' => 'RETURN_SUCCESS']);  //status changed
    }

    // Third : get the updated data from database to route to STUDENT RETURNPAGE
    $data = DB::table('StudentBooks')
      ->where('stud_name', '=', Auth::user()->name)
      ->where(function ($query) {
        $query->orwhere('status', '=', 'Granted')
          ->orWhere('status', '=', 'RETURN_SUCCESS')
          ->orWhere('status', '=', 'RETURN_PROCESS')
          ->orWhere('status', '=', 'Expired');
      })
      ->get();
    return view('StudBookReturn', ['data' => $data]);
  }

  public function FineAmountPaid(Request $req)
  {   // Only if student pay the amount then Return Success
    $i = $req->bookid;
    // when Student Pay the Fine charge then status is change to return_successfully
    DB::table('StudentBooks')
      ->where('id', $i)
      ->update(['status' => 'RETURN_SUCCESS']);  //status changed

    // return back to student book return  page + updated data
  
    $data = DB::table('StudentBooks')
      ->where('stud_name', '=', Auth::user()->name)
      ->where(function ($query) {
        $query->orwhere('status', '=', 'Granted')
          ->orWhere('status', '=', 'RETURN_SUCCESS')
          ->orWhere('status', '=', 'RETURN_PROCESS')
          ->orWhere('status', '=', 'Expired');
      })
      ->get();



    return view('StudBookReturn', ['data' => $data]);
  }
}




