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

               
                function artoxml($arr, $i=1,$flag=false){
                    $sp = "";
                    for($j=0;$j<=$i;$j++){
                        $sp.="";
                     }
                    foreach($arr as $key=>$val){
                        echo "$sp&lt;".$key."&gt;";
                        if($i==1) echo "\n";
                        if(is_array($val)){
                            if(!$flag){echo"\n";}
                            artoxml($val,$i+5);
                            echo "$sp&lt;/".$key."&gt;\n";
                        }else{
                              echo "$val"."&lt;/".$key."&gt;\n";
                         }
                    }
                
                }
                
                artoxml(array($data), 1);
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
