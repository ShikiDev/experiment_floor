<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['title','content','status','created_at','uploaded_at','deleted_at','deleted'];
    //

    public function hashtagable(){
        return $this->morphToMany('App\Hashtag','hashtagable','post_n_hashtag_connect');
    }

    public function author(){
        return $this->belongsTo('App\User', 'author_uid');
    }

    public function mainImg(){
        return $this->belongsTo('App\Mediateka', 'main_img_id');
    }

    public static function shortcutContent($content){
        $content = explode("&lt;:end_post_shortcut&gt;", $content);
        return $content[0];
    }

    /**
     * lol
     * @param $content
     * @return string
     */
    public static function cutShortcutContent($content){
        return str_replace("&lt;:end_post_shortcut&gt;","",$content);
    }
}
