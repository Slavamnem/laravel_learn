<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    //
    protected $table = 'article';
    //protected $primaryKey = "id";
    //public $incrementing = false;
    public $timestamps = TRUE;

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'name', 'text', 'img', 'created_at', 'updated_at'
    ];
    //protected $guarded = ['text']; // недоступные для записи
    protected $casts = [
      'name' => 'string',
      'text' => 'array',
    ];


    public function user(){
        return $this->belongsTo("App\User", "user_id", "id");
    }

//    public function getNameAttribute($value){
//        return "|||".$value."|||";
//    }
//    public function setNameAttribute($value){
//        $this->attributes['name'] = "_".$value."_";
//    }
    //
    public static function getData(){
        return [
            [
                'name' => "sport new7",
                'text' => "sport new 7 text full",
                'img' => "sp7.jpg",
            ],
            [
                'name' => "sport new8",
                'text' => "sport new 8 text full",
                'img' => "sp8.jpg",
            ],
            [
                'name' => "sport new9",
                'text' => "sport new 9 text full",
                'img' => "sp9.jpg",
            ]
        ];
    }
}
