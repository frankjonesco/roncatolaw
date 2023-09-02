<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
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
        'job_title',
        'description',
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
        elseif(file_exists(public_path('images/partners/'.$this->hex.'/'.$this->image))){
            return asset('images/partners/'.$this->hex.'/'.$this->image);
        }
        return asset('images/no-image.webp');
    }

    // Save image (update)
    public function saveImage($request){
        $image = new ImageProcess();
        $this->image = $image->upload($request, 'partners', $this);
        return $this;
    }

    // Save rendered image (update)
    public function saveRenderedImage($data){
        $image = new ImageProcess();
        $this->image = $image->renderCrop($data, 'partners', $this, 200, 300);
        return $this;  
    }
}
