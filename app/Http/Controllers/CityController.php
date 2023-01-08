<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Response;

class CityController extends Controller
{
    public function getWeather(string $city): JsonResponse
    {              
        $client = new Client();

        $res = $client->get('http://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.env('WEATHER_API'));
        if ($res->getStatusCode() == 200) { 
            $response_data =json_decode( $res->getBody()->getContents());
        }
        return Response::json([
            'data' => $response_data->weather[0]->description,
            'message' => 'Weather fetched successfully',
        ]);  
    }
}
