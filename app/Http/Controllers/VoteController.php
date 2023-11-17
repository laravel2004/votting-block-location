<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Response;
use SebastianBergmann\Type\FalseType;

class VoteController extends Controller {

    private Vote $vote;
    private Candidate $candidate;

    public function __construct(Vote $vote, Candidate $candidate) {
        $this->vote = $vote;
        $this->candidate = $candidate;
    }

    protected $baseUri = 'https://nominatim.openstreetmap.org/';
    public function checkLocation(Request $request) {
        try {
            $validateRequest = $request->validate([
                "long" => "required",
                "lat" => "required",
            ]);

            $longitude = $validateRequest['long'];
            $latitude = $validateRequest['lat'];

            $client = new Client(['base_uri' => $this->baseUri]);
            $response = $client->request('GET', 'reverse', [
                'query' => [
                    'lat' => $latitude,
                    'lon' => $longitude,
                    'format' => 'json',
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $city = $data['display_name'];
            $data = strpos($city, 'Surabaya') !== false;

            return response()->json([
                "status" => "success",
                "data" => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
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
        try {
            $validateRequest = $request->validate([
                "candidate_id" => "required",
                "permission" => "required",
            ]);

            $infoIP = Location::get($request->ip());

            if ($request->cookie("logged")) {
                return  response()->json([
                    "status" => "error",
                    "message" => "Anda sudah melakukan voting",
                ]);
            }

            if($validateRequest["permission"] != "granted") {
                if($infoIP->cityName != "Surabaya") {
                    return  response()->json([
                        "status" => "error",
                        "message" => "Anda harus berada di Surabaya",
                    ]);
                }
                
                $response = response()->json([
                    "status" => "success",
                    "message" => "Vote telah ditambahkan",
                ]);
            }

            $data = [
                "ip" => $request->ip(),
                "city" => $infoIP->cityName,
                "country" => $infoIP->countryName,
                "candidate_id" => $validateRequest["candidate_id"],
            ];

            $candidate = Candidate::find($validateRequest["candidate_id"]);
            $candidate->increment('total_vote');


            $this->vote->create($data);
            $response = response()->json([
                "status" => "success",
                "message" => "Vote telah ditambahkan",
            ]);

            $response->withCookie(cookie()->forever('logged', true));

            return $response;
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
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
