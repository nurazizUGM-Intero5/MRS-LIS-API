<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class LabOrderController extends Controller
{
    private $client = null;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'verify' => false,
            'cert' => base_path('storage/cert.pem'),
            'ssl_key' => base_path('storage/key.pem'),
        ]);
    }

    public function generateServiceRequest(array $order)
    {
        $labNumber = '';
        for ($i = 0; $i < 20; $i++) {
            $labNumber .= random_int(0, 9);
        }
        $coding = array_map(function ($o) {
            return [
                "system" => "http://loinc.org",
                "display" => $o['testType']['label']
            ];
        }, $order);
        return [
            "resourceType" => "ServiceRequest",
            "status" => "active",
            "intent" => "original-order",
            "requisition" => [
                "use" => "usual",
                "system" => "http://openelis-global.org/samp_labNo",
                "value" => "API" . $labNumber
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://openelis-global.org/sample_program",
                            "code" => "Routine Testing",
                            "display" => "Routine Testing"
                        ]
                    ]
                ]
            ],
            "priority" => "routine",
            "code" => [
                "coding" => $coding
            ],
            "subject" => [
                "reference" => "Patient/a2bfd70b-c18c-4043-b610-ae4f79f0d35d"
            ],
            "authoredOn" => date('c'),
            "requester" => [
                "reference" => "Practitioner/f9badd80-ab76-11e2-9e96-0800200c9a66"
            ],
            "locationReference" => [
                [
                    "reference" => "Location/"
                ]
            ],
            "specimen" => [
                [
                    "reference" => "Specimen/64b5af43-581a-4893-9cd3-f41ccbb60f7a"
                ]
            ]
        ];
    }

    /**
     * @OA\Get(
     *     path="/lab-orders",
     *     summary="Get all lab orders",
     *     tags={"Lab Orders"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of lab orders"
     *     )
     * )
     */
    public function getAllLabOrders(Request $request)
    {
        $response = $this->client->get("https://localhost:8444/fhir/ServiceRequest?_format=json");
        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/lab-orders/{id}",
     *     summary="Get a specific lab order",
     *     tags={"Lab Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details of the lab order"
     *     )
     * )
     */
    public function getLabOrder($id)
    {
        $response = $this->client->get("https://localhost:8444/fhir/ServiceRequest/{$id}");
        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }

    /**
     * @OA\Post(
     *     path="/lab-orders",
     *     summary="Create a new lab order",
     *     tags={"Lab Orders"},
     *     @OA\RequestBody(
     *         required=true,
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(
    *                 type="object",
    *                 @OA\Property(property="action", type="string", example="NEW"),
    *                 @OA\Property(property="urgency", type="string", example="ROUTINE"),
    *                 @OA\Property(property="display", type="string", example="Haemoglobin"),
    *                 @OA\Property(
    *                     property="testType",
    *                     type="object",
    *                     @OA\Property(property="label", type="string", example="Haemoglobin"),
    *                     @OA\Property(property="conceptUuid", type="string", example="21AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA")
    *                 ),
    *                 @OA\Property(property="orderer", type="string", example="e016efdf-4cf2-41af-8b5a-bd1b55fc4887"),
    *                 @OA\Property(property="accessionNumber", type="string", example="124")
    *             )
    *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lab order created successfully"
     *     )
     * )
     */
    public function createLabOrder(Request $request)
    {
        $id = (string) \Illuminate\Support\Str::uuid();

        $data = $this->generateServiceRequest($request->all());
        $data['id'] = $id;
        try {
            $response = $this->client->put("https://localhost:8444/fhir/ServiceRequest/$id", [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/fhir+json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            return response()->json($body, $response->getStatusCode());

            if ($response->getStatusCode() === 201) {
                return response()->json(['message' => 'Lab order created successfully'], 201);
            }

            return response()->json(['error' => 'Failed to create lab order'], $response->getStatusCode());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle the exception, log it, or return an error response
            $errorBody = $e->hasResponse() ? (string) $e->getResponse()->getBody() : $e->getMessage();
            return response()->json(['error' => 'Failed to create lab order', 'details' => $errorBody], 500);
        } finally {
            $lab_number = $data['requisition']['value'] ?? null;
            $priority = $data['priority'] ?? null;
            ServiceRequest::create([
                'lab_number' => $lab_number,
                'priority' => $priority,
                'data' => json_encode($data),
            ]);
        }
    }
}
