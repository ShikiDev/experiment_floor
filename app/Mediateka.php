<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mediateka extends Model
{
    //
    public static function exchangeTagForCode($tag_list, $content){
        foreach ($tag_list as $tag) {
                if($tag->media_type == 'images') $media_code = '<img src="' . $tag->filepath . '" class="img-fluid" alt="Responsive image">';
                else $media_code = '<iframe width="560" height="320" src="'.str_replace('watch?v=','embed/', $tag->filepath).'"
                allow="encrypted-media" frameborder="0" allowfullscreen></iframe>';

                $content = str_replace("&lt;:" . $tag->media_tag . "&gt;",$media_code, $content);
        }

        return $content;
    }
}
