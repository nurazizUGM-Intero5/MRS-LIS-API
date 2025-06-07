<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    protected $openElisClient;
    public function __construct()
    {
        $this->openElisClient = new Client([
            'verify' => false,
            'cert' => base_path('storage/cert.pem'),
            'ssl_key' => base_path('storage/key.pem'),
        ]);
    }

    /**
     * @OA\Info(
     *    title="API Documentation",
     *    version="1.0.0",
     *    description="API Documentation for the application."
     * )
     * @OA\Server(
     *    url="http://127.0.0.1:8000/api",
     *    description="Local server"
     * )
     * @OA\Get(
     *     path="/",
     *     summary="Welcome to the API",
     *     description="Returns a welcome message.",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Welcome to the API"),
     *             @OA\Property(property="status", type="integer", example=200)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $res = $this->openElisClient->get('https://localhost:8444/fhir/Patient?_format=json');
        $response = $res->getBody();
        return response()->json([
            'message' => 'success',
            'status' => 200,
            'data' => [
                'status_code' => $res->getStatusCode(),
                'response' => json_decode($response),
            ],
        ]);
        return response()->json([
            'message' => 'Welcome to the API',
            'status' => 200,
        ]);
    }
}
