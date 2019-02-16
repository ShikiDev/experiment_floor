<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\Input;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $posts_list = Posts::where('status','published')->orderBy('created_at','desc')->limit(2)->get();
        return view('frontend/main',['posts' => json_encode($posts_list)]);
    }

    public function getJsonPosts(){
        $request = Input::all();
        $last_post_id = $request['last_id'];
        $posts_list = Posts::where('status','published')->where('id','<',$last_post_id)->limit(5)->get();
        return $posts_list;
    }

    public function projectList(){
        $test_array = [
            [
                'title' => 'First Projects',
                'description' => 'Some description of project',
                'img_url' => asset('/storage/images/sakura.jpg'),
                'created_at' => date('d.m.Y H:i:s')
            ],
        ];

        return view('frontend/projects',[
            'projects' => json_encode($test_array)
        ]);
    }

    public function aboutMe(){
        return view('frontend/about');
    }
}
