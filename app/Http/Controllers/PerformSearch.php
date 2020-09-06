<?php
//...................Used for performin search ...........................// -->
namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class PerformSearch extends Controller
{


    function index()
    {
        return view('Studallbook');
    }

    function action(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::search($request->get('full_text_search_query'))->get();

            return response()->json($data);
        }
    }
}
