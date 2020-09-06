<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Nicolaslopezj\Searchable\SearchableTrait;
class Book extends Model
{
    //
      protected $table ='Book';
    public $timestamps=false;


    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
             'Book.id' =>10 ,
             'Book.serialID' =>10 ,
             'Book.name' => 10 ,
             'Book.Author' => 10 ,
             'Book.Category' => 10 ,
             'Book.Quantity' => 10 ,
             'Book.Edition' => 10 ,
             
         
        ]
    ];


    protected $fillable = [
        'id', 'serialID', 'name', 'Author', 'Category', 'Quantity','Edition',
    ];
}
