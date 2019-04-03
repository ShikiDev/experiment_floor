<?php

namespace App\Http\Controllers\Admin;

use App\Posts;
use App\Hashtag;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use App\Mediateka;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts_list = Posts::orderBy('created_at')->paginate(10);

        return view('admin.posts.postslist', [
            'posts' => $posts_list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.post_create', [
            'hashtag_list' => Hashtag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = \Auth::user()->id;
        $post = new Posts();
        $post->title = $request->input('title','');
        $post->content = $request->input('content','');
        $post->status = $request->post('status');
        $post->status = empty($post->status) ? 'note' : $post->status;
        $post->created_at = time();
        $post->updated_at = time();
        $post->author_uid = $user_id;
        $post->save();

        if($request->input('hashtag_setted')) :
            if(is_array($request->input('hashtag_setted'))):
                $hashtag_setted_list = $request->input('hashtag_setted');
                foreach($hashtag_setted_list as $hashtag) $post->hashtagable()->attach($hashtag);
            endif;
        endif;

        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        $selected_hashtags = array();
        foreach($post->hashtagable as $setted_hashtag) $selected_hashtags[] = $setted_hashtag->id;
        $images = Mediateka::where('post_uid',$post->id)
            ->where('media_type','images')->get();
        $video_links = Mediateka::where('post_uid',$post->id)
            ->where('media_type','videos')->get();
        return view('admin.posts.post_edit',[
            'post' => $post,
            'hashtag_list' => Hashtag::all(),
            'selected_hashtags' => $selected_hashtags,
            'images' => $images,
            'video_links' => $video_links,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Posts::find($id);
        $post->title = $request->input('title','');
        $post->content = $request->input('content','');
        $post->status = $request->post('status');
        $post->status = empty($request->status) ? 'note' : $post->status;
        $post->updated_at = time();
        $post->hashtagable()->detach();
        if($request->input('hashtag_setted')):
            $post->hashtagable()->attach($request->input('hashtag_setted'));
        endif;

        $post->update();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','Post has been deleted');
    }

    /**
     *
     * @param Request $request
     * @return string
     */
    public function uploadImages(Request $request){
        $request_data = $request;
        $post_uid = $request->input('post_uid');

        $img_array = $request_data->file('file')->store('images', 'public');

        $image  = new Mediateka();
        $image->filepath = '/storage/'.$img_array;
        $image->post_uid = $post_uid;
        $image->media_tag = '';
        $image->media_type = 'images';
        $image->created_at = time();
        $image->updated_at = time();
        $image->save();

        $image->media_tag = 'post_'.$post_uid.'_'.$image->id;
        $image->save();

        return json_encode([
            'status' => 'ok',
            'path' => '/storage/'.$img_array
        ]);
    }

    public function addVideoLink(Request $request){
        $post_uid = $request->input('post_uid');
        $video = new Mediateka();
        $video->filepath = $request->input('video_link');
        $video->post_uid = $post_uid;
        $video->media_tag = '';
        $video->media_type = 'videos';
        $video->created_at = time();
        $video->updated_at = time();
        $video->save();

        $video->media_tag = 'post_'.$post_uid.'_'.$video->id;
        $video->save();

        $video_list = Mediateka::where('post_uid',$post_uid)->where('media_type','videos')->get();
        echo json_encode($video_list);
    }

    public function setMainImage(Request $request){
        $img_id = $request->input('img_id');
        $post_uid = $request->input('post_uid');
        Mediateka::where('post_uid',$post_uid)->where('media_type','images')->update(['main_img' => 'false']);
        $image = Mediateka::find($img_id);
        $image->main_img = 'true';
        $image->save();

        $post =  Posts::find($post_uid);
        $post->main_img_id = $img_id;
        $post->save();

        echo 'true';
    }

    /**
     * добавить для удаления видео перерисовку блока черезь старый и не очень старый
     */
    public function deleteVideos(){
        $request = Input::all();
        $video_id = $request['id'];
        $video = Mediateka::find($video_id);
        $post_id = $video->post_id;
        $video->delete();
        $video_list = Mediateka::where('post_uid',$post_id)->where('media_type','videos')->get();
        echo json_encode($video_list);
    }

    /**
     *
     */
    public function deleteImages(){
        $request = Input::all();
        $image_id = $request['id'];
        $image = Mediateka::find($image_id);
        $post_id = $image->post_id;
        Storage::delete($image->filepath);
        $image->delete();
        $image_list =  Mediateka::where('post_uid',$post_id)->where('media_type','images')->get();
        echo json_encode($image_list);
    }
}
