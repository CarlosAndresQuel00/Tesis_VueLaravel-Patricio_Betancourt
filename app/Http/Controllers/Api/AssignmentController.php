<?php

namespace App\Http\Controllers\Api;

use App\Models\Assignment;
use App\Models\Membership;
use App\Http\Resources\Assignment as AssignmentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Membership $membership)
    {
        $assignment = $membership->assignments;
        return response()->json(AssignmentResource::collection($assignment), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Membership $membership)
    {
        $assignments = $membership->assignments()->save(new Assignment($request->all()));
        return response()->json(new AssignmentResource($assignments), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership, Assignment $assignment)
    {
        $assignments = $membership->assignments()->where('id', $assignment->id)->firstOrFail();
        return response()->json(new AssignmentResource($assignments), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        $membership->assignments()->update($request->all());
        return response()->json($membership, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $membership->assignments()->delete();
        return response()->json(null, 204);
    }
}
