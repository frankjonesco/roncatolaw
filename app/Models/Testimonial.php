<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hex',
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'job_title',
        'testimonial',
        'image',
        'status'
    ];

    
    // ROUTES
    
    // Set the route key name
    public function getRouteKeyName(){
        return 'hex';
    }
}
