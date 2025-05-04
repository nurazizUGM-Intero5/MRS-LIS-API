<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * @OA\Info(
   *    title="API Documentation",
   *    version="1.0.0",
   *    description="API Documentation for the application."
   * )
   * @OA\Get(
   *     path="/",
   *     tags={"Home"},
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
    return response()->json([
      'message' => 'Welcome to the API',
      'status' => 200,
    ]);
  }
}
