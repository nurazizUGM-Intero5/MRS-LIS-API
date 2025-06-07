<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $client = null;

    public function __construct()
    {
        $this->client =  new Client([
            'verify' => false,
            'cert' => base_path('storage/cert.pem'),
            'ssl_key' => base_path('storage/key.pem'),
        ]);
    }

    /**
     * @OA\Get(
     *     path="/patients",
     *     summary="Get all patients",
     *     tags={"Patients"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter patients by name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of patients"
     *     )
     * )
     */
    public function getAllPatients(Request $request)
    {
        $name = $request->get('name', '');
        $response = $this->client->get("https://localhost:8444/fhir/Patient?_format=json&name=$name");
        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }

    public function getPatient($id)
    {
        $response = $this->client->get("https://localhost:8444/fhir/Patient/{$id}");
        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }
}
