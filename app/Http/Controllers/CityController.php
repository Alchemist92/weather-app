<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

class CityController extends Controller
{
    public function getWeather(string $city)
    {              
        $client = new Client();

        try{
            $res = Http::get('http://api.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.env('VITE_WEATHER_API_KEY'));
            if ($res->getStatusCode() == 200) {                 
                
                $data = json_decode($res, true);

                return response()->xml(['data' => array($data)])->header('Content-Type', 'text/xml');               
            }              
        } catch(Exception $e){
            if($e){
                return Response::json([
                    'status' => 'error',
                    'message' => 'Failed to find city',
                ]); 
            }       
        }
    }
}
