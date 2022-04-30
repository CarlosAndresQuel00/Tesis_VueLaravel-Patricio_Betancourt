<?php

namespace App\Http\Controllers\Api;

use App\Models\SharedSpace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;

class SharedSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SharedSpace::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sharedSpace=new SharedSpace;
        $sharedSpace->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SharedSpace  $sharedSpace
     * @return \Illuminate\Http\Response
     */
    public function show(SharedSpace $sharedSpace)
    {
        return $sharedSpace;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SharedSpace  $sharedSpace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SharedSpace $sharedSpace)
    {
        $sharedSpace->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SharedSpace  $sharedSpace
     * @return \Illuminate\Http\Response
     */
    public function destroy(SharedSpace $sharedSpace)
    {
        $sharedSpace->delete();
    }
}
