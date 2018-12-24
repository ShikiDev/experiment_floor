<?php

namespace App\Http\Controllers\Admin;

use App\Hashtag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hashtag_list = Hashtag::orderBy('created_at')->paginate(10);

        return view('admin.hashtag.hashtag_list', [
            'hashtags' => $hashtag_list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hashtag.hashtag_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required',
            'color' => 'required']);
        $hashtag = new Hashtag();
        $hashtag->name = $request->input('name','');
        $hashtag->color = $request->input('color','');
        $hashtag->created_at = time();
        $hashtag->updated_at = time();
        $hashtag->save();

        return redirect()->route('admin.hashtags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function show(Hashtag $hashtag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hashtag = Hashtag::find($id);
        return view('admin.hashtag.hashtag_edit',[
            'hashtag' => $hashtag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hashtag = Hashtag::find($id);
        $hashtag->name = $request->input('name','');
        $hashtag->color = $request->input('color','');
        $hashtag->updated_at = time();
        $hashtag->update();

        return redirect()->route('admin.hashtags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hashtag $hashtag)
    {
        $hashtag->delete();
        return redirect()->route('admin.hashtags.index')->with('success','Hashtag has been deleted');
    }
}
