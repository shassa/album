<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletalbumRequest;
use App\Models\album;
use App\Http\Requests\StorealbumRequest;
use App\Http\Requests\UpdatealbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=album::with('pictures')->where('user_id',auth()->user()->id)->get();
         $arr=album::all()->where('user_id',auth()->user()->id);
         return view('home',compact(['albums','arr']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorealbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorealbumRequest $request)
    {
        album::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);
        return redirect('/home')->with('message','You have add new album');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatealbumRequest  $request
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatealbumRequest $request, album $album)
    {
        $album->update(["name"=>$request->name]);
        return redirect('/home')->with('message','You have updated '.$album->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletalbumRequest $request,album $album)
    {
        if($request->radio=="a"){
            $album->pictures()->delete();
            $album->delete();
        }else{
            $album->pictures()->update(['album_id'=>$request->selector]);
            $album->delete();
        }
        
        return redirect('/home')->with('message','You have deleted an album');

    }
}
