<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable = ['name','color','deleted'];
    //

    public static function getHashtagsListJson(){
        $hashtags = self::all();
        $hashtag_list = array();
        if(!empty($hashtags)){
            foreach($hashtags as $hashtag){
                $hashtag_list[] = array(
                    'name' => $hashtag->name,
                    'hex' => $hashtag->color,
                );
            }
        }

        return json_encode($hashtag_list);
    }
}
