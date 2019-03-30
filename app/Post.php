<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{

    use Searchable;

    protected $fillable=[


        'user_id','category_id',
        'slug','title','body','featured',
        'status','published_at'
        
    ];
    protected $dates=[
        'published_at','created_at','updated_at'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function comments(){

       return $this->hasMany(Comment::class);
    }
    //search data post
    public function SearchableAs(){

        return 'posts_index';
    }
    // carbon ::untuk membuat tanggal menjadi 20 weak ago
    public function getDateAttribute(){
            return Carbon::parse($this->published_at)->diffForHumans();
    }
}
