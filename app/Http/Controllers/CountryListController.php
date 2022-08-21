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
        $result =  array_reverse(array_slice($r,0,10),true);
        $values = $countries = $finalResult = [];

        foreach($result as $key => $data){
            $finalResult['values'][] = $data;
            $finalResult['countries'][] = $key;
        }

        return $finalResult;


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
        $values = $countries = $finalResult = [];

        foreach($result as $key => $data){
            $finalResult['values'][] = $data;
            $finalResult['countries'][] = $key;
        }
        return $finalResult;
//        return $result;
    }
    function Chart3(){

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
        $result =  array_slice($result,0,2);
        $values = $countries = $finalResult = [];

        foreach($result as $key => $data){
            $finalResult['values'][] = $data;
            $finalResult['countries'][] = $key;
        }
        return $finalResult;
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

    function table2(){
        $countries=[];
        $result = [];
        $jsonurl1 = "https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json";
        $json1 = file_get_contents($jsonurl1);
        $jsonurl2 = "https://raw.githubusercontent.com/lukes/ISO-3166-Countries-with-Regional-Codes/master/all/all.json";
        $json2 = file_get_contents($jsonurl2);
        $universities = json_decode($json1);
        $continents = json_decode($json2, true);
        $result = array();
        $tempArray = [];
        foreach($continents as $key => $v){
            $name = $v['name'];
            if($v['region'] == 'Europe'){
                $result[$name] =  $v['country-code'];
                array_push($tempArray, $name);
            }
        }
        $tempData = [];
        foreach($universities as $v)
        {
            if(in_array($v->country, $tempArray ) ){
                $tempData[] = ([ 'country' => $v->country, 'universityName' => $v->name, 'countryCode' => $result[ $v->country ]  ]);
                // print_r(json_encode($tempData));
            }
        }
        return $tempData;
    }

    function table3()
    {
        $country=[];
        $jsonurl = "https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json";
        $json = file_get_contents($jsonurl);
        $values = json_decode($json);
        $jsonurl2 = "https://raw.githubusercontent.com/lukes/ISO-3166-Countries-with-Regional-Codes/master/all/all.json";
        $json2 = file_get_contents($jsonurl2);
        $continents = json_decode($json2);
        $result=[];
        foreach($continents as $v){
            try{
                $result[ $v->name ] = $v->region ;
            }
            catch (\Exception $e){
                $contin = 0 ;
            }
        }
// echo(count($values));
        foreach($values as $v){
            array_push($country,$v->country);
        }
        $finalData = [];
        $data = array_count_values($country);

        foreach($data as $key => $value){
            $name = "others";
            try{
                $name = $result[$key];
            }
            catch (\Exception $e){
                $name = $key;
            }
            $finalData[] = ([ 'country' => $key, 'value' => $value, 'continent' => $name  ]);
        }
        return $finalData;
    }


}





