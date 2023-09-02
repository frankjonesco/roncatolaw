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



    // FORMATTERS

    public function full_name(){
        return $this->first_name.' '.$this->last_name;
    }




    public function getFullImage(){
        if(!$this->image){
            return asset('images/no-image.webp');
        }
        elseif(file_exists(public_path('images/testimonials/'.$this->hex.'/'.$this->image))){
            return asset('images/testimonials/'.$this->hex.'/'.$this->image);
        }
        return asset('images/no-image.webp');
    }

    // Save image (update)
    public function saveImage($request){
        $image = new ImageProcess();
        $this->image = $image->upload($request, 'testimonials', $this);
        return $this;
    }

    // Save rendered image (update)
    public function saveRenderedImage($data){
        $image = new ImageProcess();
        $this->image = $image->renderCrop($data, 'testimonials', $this, 320, 320);
        return $this;  
    }
}
