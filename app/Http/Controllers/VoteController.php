<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    private Vote $vote;

    public function __construct(Vote $vote){
        $this->vote = $vote;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateRequest = $request->validate([
                "ip" => "required",
                "city" => "required",
                "country" => "required",
                "candidate_id" => "required",
            ]);

            if($request->cookie("logged")){
                return  response()->json([
                    "status" => "error",
                    "message" => "Anda sudah melakukan voting",
                ]);
            }

            $this->vote->create($validateRequest);
            response()->cookie("logged", true, 3600 * 24 * 30);
            return response()->json([
                "status" => "success",
                "message" => "Vote telah ditambahkan"
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
