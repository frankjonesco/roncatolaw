<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
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
        'title',
        'caption',
        'body',
        'status'
    ];


    // ROUTES
    
    // Set the route key name
    public function getRouteKeyName(){
        return 'hex';
    }


    // Relationship to topic
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship to category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relationship to topic
    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id');
    }





    public function getFullImage(){
        if(!$this->image){
            return asset('images/no-image.webp');
        }
        elseif(file_exists(public_path('images/articles/'.$this->hex.'/'.$this->image))){
            return asset('images/articles/'.$this->hex.'/'.$this->image);
        }
        return asset('images/no-image.webp');
    }

    // Save image (update)
    public function saveImage($request){
        $image = new ImageProcess();
        $this->image = $image->upload($request, 'articles', $this);
        return $this;
    }

    // Save rendered image (update)
    public function saveRenderedImage($data){
        $image = new ImageProcess();
        $this->image = $image->renderCrop($data, 'articles', $this, 760, 428);
        return $this;  
    }


    
}
