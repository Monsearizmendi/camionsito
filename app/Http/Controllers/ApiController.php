<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    //region
    public function mostrarregiones(){
        //consumo de mi API de entregas
        $cliente =new \GuzzleHttp\Client();
        $response = $cliente ->request('GET','http://data.streetfoodapp.com/1.1/regions');
        $datos =json_decode($response->getBody()->getContents(), true);
    
        //-- reconocer elementos
        $regiones =[];
    
        foreach($datos['regions'] as $region){
            $regiones[] = [
                'id' => $region['identifier'],
                'nombre' => $region['name'],
                'nombrel'=> $region['name_long'],
                'zonah' => $region['time_zone'],
                'latitude' => $region['latitude'],
                'longitude' => $region ['longitude'],
                'ciudad' => $region['country'],
                'direccion' => $region['example_location']['address'],
                'elatitude' => $region['example_location']['latitude'],
                'elongitude' => $region['example_location']['longitude']
                
            ];
        }
    
            return view('index',['regiones' => $regiones]);
    }

    //city

    public function mostrarcity(){
        //consumo de mi API de entregas
        $cliente =new \GuzzleHttp\Client();
        $response = $cliente ->request('GET','http://data.streetfoodapp.com/1.1/schedule/:city');
        $datos_ciudad =json_decode($response->getBody()->getContents(), true);
    
        //-- reconocer elementos
        $ciudades =[];
    
        foreach($datos_ciudad['city'] as $ciudad){
            $regiones[] = [
                'id' => $ciudad['identifier'],
                'nombre' => $ciudad['name'],
                'region'=> $ciudad['region'],
                'url' => $ciudad['url'],
                'nombre' => $ciudad['phone'],
                'email' => $ciudad ['email'],
                'twitter' => $ciudad['twitter'],
                'facebook' => $ciudad['facebook'],
                'instagram' => $ciudad['instagram'],
                't_url' => $ciudad['takeout_url'],
                'delivery_url' => $ciudad ['delivery_url'],
                'r_url' => $ciudad['restaurant_url']
            ];

            
        }
    
            return view('index',['regiones' => $regiones]);
    }
}

