<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    protected $modelFields = [
        "name",
        "address",
        "card_code"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employer = Employer::find($id);

        if (!$employer) {
            return response()->json(['message' => "Not found"], 404);
        }

        return response()->json(['data' => $employer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        if (!$request->only($this->modelFields)) {
            return response()->json(['message', 'errors' => $this->modelFields], 422);
        }

        $employer = Employer::find($id);
        $employer->update([
            'name' => $request->name,
            'address' => $request->address,
            'card_code' => $request->card_code
        ]);

        return response()->json(['data' => $employer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::find($id);

        if (!$employer) {
            return response()->json(['message' => "Not found"], 404);
        }
        $employer->delete();
        return response()->json(['data' => $employer]);
    }
}
