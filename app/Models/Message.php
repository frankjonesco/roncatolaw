<?php

namespace App\Models;

use App\Models\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'hex', 
        'name', 
        'email', 
        'phone', 
        'subject', 
        'message'
    ];


    public function getRouteKeyName(){
        return 'hex';
    }


    public static function boot(){
        parent::boot();

        static::created(function($item){
            $adminEmail = 'frankjones.web@gmail.com';
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
  

}
