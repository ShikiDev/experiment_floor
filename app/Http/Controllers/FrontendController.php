<?php

namespace App\Http\Controllers;

use App\Mediateka;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\Input;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $posts_list = Posts::where('status','published')->orderBy('created_at','desc')->limit(2)->get();
        $posts = [];
        foreach($posts_list as $key => $post){
            $posts[$key] = $post->toArray();
            $posts[$key]['main_img'] = $post->mainImg['filepath'];
        }

        return view('frontend/main',['posts' => json_encode($posts)]);
    }

    public function getJsonPosts(){
        $request = Input::all();
        $last_post_id = $request['last_id'];
        $posts_list = Posts::where('status','published')->where('id','<',$last_post_id)->orderBy('created_at','desc')->limit(5)->get();
        $posts = [];
        foreach($posts_list as $key => $post){
            $posts[$key] = $post->toArray();
            $posts[$key]['main_img'] = $post->mainImg['filepath'];
        }
        return $posts;
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

    public function getPost(Request $request, $id){
        $post = Posts::find($id);
        $images = Mediateka::where('post_uid', $id)->get();

        $post->content = Mediateka::exchangeTagForCode($images, $post->content);
        return view('frontend/post',['post' => $post]);
    }
}
