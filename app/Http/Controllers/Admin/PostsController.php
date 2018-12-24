<?php

namespace App\Http\Controllers\Admin;

use App\Posts;
use App\Hashtag;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if($request->input('hashtag_setted')) :
            if(is_array($request->input('hashtag_setted'))):
                $hashtag_setted_list = $request->input('hashtag_setted');
                foreach($hashtag_setted_list as $hashtag) $post->hashtagable()->attach($hashtag);
            endif;
        endif;
        $post->created_at = time();
        $post->updated_at = time();
        $post->author_uid = $user_id;
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
        foreach($post->hashtagable as $setted_hashtag) $selected_hashtags[] = $setted_hashtag->id;
        return view('admin.posts.post_edit',[
            'post' => $post,
            'hashtag_list' => Hashtag::all(),
            'selected_hashtags' => $selected_hashtags
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
}
