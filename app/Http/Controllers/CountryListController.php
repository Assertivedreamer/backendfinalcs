<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryListController extends Controller
{
    function Chart1()
    {
        $country=[];
        $jsonurl = "https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json";
        $json = file_get_contents($jsonurl);
        // var_dump(json_decode($json));
        $values = json_decode($json);
        // echo(count($values));
        foreach($values as $v){
        array_push($country,$v->country);
        }
        $r = array_count_values($country);
        arsort($r);
        $result =  array_slice($r,0,10);
        
        return $result;
    }

    function Chart2(){

        $countries=[];
        $result = [];
        $jsonurl1 = "https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json";
        $json1 = file_get_contents($jsonurl1);
        $jsonurl2 = "https://raw.githubusercontent.com/lukes/ISO-3166-Countries-with-Regional-Codes/master/all/all.json";
        $json2 = file_get_contents($jsonurl2);
        $universities = json_decode($json1);
        $continents = json_decode($json2);
        $result=[];
        foreach($universities as $v)
        {
            array_push($countries, $v->country);
        }
        $countriesWithCount = array_count_values($countries);
        $result=[];
        foreach($continents as $v){
            $contin = 0;
            try{
                $contin = $result[ $v->region ];
            }
            catch (\Exception $e){
                $contin = 0;
            }
            try{
                $value =  $countriesWithCount[ $v->name ];
                $result[ $v->region ] = $contin + $value ; 
            }
            catch (\Exception $e){
                $contin = 0;
            }
        } 
        return $result;
    }

    function Table1($name){
        $country=[];
        $jsonurl = "https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json";
        $json = file_get_contents($jsonurl);
        // var_dump(json_decode($json));
        $values = json_decode($json);
        // echo(count($values));
        foreach($values as $v){
            if($v->country == $name)
            {
              array_push($country,$v);
            }
        }
        return $country;
    }

    function Table2(){
        $countries = array();
        $result = array();
        $array = array();
        $jsonurl2 = "https://raw.githubusercontent.com/lukes/ISO-3166-Countries-with-Regional-Codes/master/all/all.json";
        $json2 = file_get_contents($jsonurl2);
        $continents = json_decode($json2);
        foreach($continents as $con){
            if($con->region == "Europe"){
                array_push($array,$con->name);
            }
        }
        echo(count($array)."\n");

        

        $jsonurl1 = "https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json";
        $json1 = file_get_contents($jsonurl1);
        $universities = json_decode($json1);
         foreach($universities as $v){
            array_push($countries,$v->country);
        }

        $result = array_intersect($array,$countries);
        return $result;
        foreach($universities as $v){
            array_push($countries,$v->country);
        }
    }

}
        
     
        

    
