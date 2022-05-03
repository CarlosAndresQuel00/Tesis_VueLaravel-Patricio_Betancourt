<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use App\Models\Assignment;
use App\Http\Resources\Payment as PaymentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Assignment $assignment)
    {
        $payment = $assignment->payments;
        return response()->json(PaymentResource::collection($payment), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Assignment $assignment)
    {
        $payments = $assignment->payments()->save(new Payment($request->all()));
        return response()->json(new PaymentResource($payments), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment, Assignment $assignment)
    {
        $payments = $assignment->payments()->where('id', $payment->id)->firstOrFail();
        return response()->json(new PaymentResource($payments), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $assignment->payments()->update($request->all());
        return response()->json($assignment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->payments()->delete();
        return response()->json(null, 204);
    }
}
