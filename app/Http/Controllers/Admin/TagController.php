<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function index()
    {
        $tags = tag::all();
        return view('DashboardAdmin.tag.tag', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('DashboardAdmin.tag.buattag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'=>'required',
            'deskripsi'=>'required',
            'slug'=>'required',
        ]);

        $tag = new tag;
        $tag->nama = $request->nama;
        $tag->deskripsi = $request->deskripsi;
        $tag->slug = $request->slug;
        $tag->save();

        return redirect(route('tag.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag=tag::where('id',$id)->first();
        return view('DashboardAdmin.tag.edittag', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'=>'required',
            'deskripsi'=>'required',
            'slug'=>'required',
        ]);

        $tag = tag::find($id);
        $tag->nama = $request->nama;
        $tag->deskripsi = $request->deskripsi;
        $tag->slug = $request->slug;
        $tag->save();

        return redirect(route('tag.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = tag::where('id',$id)->delete();

        return redirect()->back();
    }
}
