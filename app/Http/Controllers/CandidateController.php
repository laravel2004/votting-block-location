<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class CandidateController extends Controller {
    private Candidate $candidate;
    private Vote $vote;

    public function __construct(Candidate $candidate, Vote $vote) {
        $this->candidate = $candidate;
        $this->vote = $vote;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        try {
            $candidates = $this->candidate->all();
            $votes = $this->vote->all();
            return view("index", compact('candidates', 'votes'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $candidate = $this->candidate::find($id);
        $missions = explode('|', $candidate->misi);

        return view("detail", compact('candidate', 'missions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
