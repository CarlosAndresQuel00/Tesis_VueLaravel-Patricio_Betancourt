<?php

namespace App\Http\Controllers\Api;

use App\Models\Reserve;
use App\Models\Assignment;
use App\Http\Resources\Reserve as ReserveResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Assignment $assignment)
    {
        $reserve = $assignment->reserves;
        return response()->json(ReserveResource::collection($reserve), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Assignment $assignment)
    {
        $reserves = $assignment->reserves()->save(new Reserve($request->all()));
        return response()->json(new ReserveResource($reserves), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve, Assignment $assignment)
    {
        $reserves = $assignment->reserves()->where('id', $reserve->id)->firstOrFail();
        return response()->json(new ReserveResource($reserves), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $assignment->reserves()->update($request->all());
        return response()->json($assignment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->reserves()->delete();
        return response()->json(null, 204);
    }
}
