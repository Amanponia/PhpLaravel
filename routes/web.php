<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// ........................................Admin  Routes...........................
Route::prefix('admin')->group(function(){
Route::get('/login','Auth\AdminLoginController@showloginForm')->name('admin.login');
Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/', 'AdminController@index')->name('admin.dashboard'); });
// show all books
Route::get('/BooksListt', 'LibrarianController@AllBook');
// Add new Book
Route::post('addbook', 'LibrarianController@AddBook');
// Book issue request
Route::get('LibrarianReq','LibrarianController@BookRequest');
// BOOK Granted
Route::get('/GrantedBooksscreen','LibrarianController@ShowAllBookGranted');
Route::get('BookGranted','LibrarianController@BookGranted' );
// Expired Date students
Route::get('/expiredbooks','LibrarianController@Overdue' ) ;
// Delete the Record
Route::get('DeleteRecord', 'LibrarianController@DeleteRecord'  );






//-----------------------------........................... STUDENT -...........................---------------------------------//
// Show list of all book
Route::get('studallbook','StudentController@ShowListBook') ;
// BOOK ISSUE 
Route::get('bookissue','StudentController@BookIssue') ;
// BOOK REQUEST
Route::get('issueRequest', 'StudentController@BookRequest');
// BOOK Return
Route::get('bookReturn', 'StudentController@BookReturn');
Route::get('returnbook', 'StudentController@BookReturnTO');

// Fine Paid
Route::get('AmoutnPaid','StudentController@FineAmountPaid');





//-----------------------------........................... Searching into book database -...........................---------------------------------//

// SEARCHING ROUTES

Route::get('full-text-search', 'PerformSearch@index');

Route::post('full-text-search/action', 'PerformSearch@action')->name('full-text-search.action');



