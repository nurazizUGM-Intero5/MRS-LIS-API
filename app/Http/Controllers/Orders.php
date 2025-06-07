<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Orders extends Controller
{
    private $client = null;
    private $baseUrl = 'https://localhost:8444/fhir/';

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'verify' => false,
            'cert' => base_path('storage/cert.pem'),
            'ssl_key' => base_path('storage/key.pem'),
        ]);
    }

    public function index()
    {
        $orders = $this->client->get($this->baseUrl . 'ServiceRequest?_format=json');
        $data = json_decode($orders->getBody());
        $orders = $data->entry ?? [];
        $orders = array_map(function ($order) {
            return $order->resource;
        }, $orders);

        $orders = array_filter($orders, function ($order) {
            return isset($order->code) && isset($order->code->coding[0]) && isset($order->priority) && isset($order->authoredOn) && isset($order->requisition->value);
        });
        return view('order.index', [
            'orders' => $orders,
        ]);
    }

    public function show(string $id)
    {
        $order = $this->client->get($this->baseUrl . 'ServiceRequest/' . $id . '?_format=json');
        $data = json_decode($order->getBody());

        return view('order.show', [
            'order' => $data
        ]);
    }
}
