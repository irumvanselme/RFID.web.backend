<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a home view of the resource.
     *
     */
    public function index()
    {
        return view("welcome");
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return response()->json(Transaction::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $valid = Validator::make($request->all(), [
            "customer_id" => "required|string",
            "initial_balance" => "required|numeric",
            "transport_fare" => "required|numeric"
        ]);

        if($valid->fails()) return response()->json($valid->errors(), 400);

        $transaction = Transaction::query()->create([
            "customer_id" => $request->get("customer_id"),
            "initial_balance" => $request->get("initial_balance"),
            "transport_fare" => $request->get("transport_fare")
        ]);

        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        //
    }
}
