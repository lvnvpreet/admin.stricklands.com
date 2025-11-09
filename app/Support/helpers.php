<?php

if (! function_exists('settings')) {
    /**
     * Get / set the specified settings value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function settings($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('anlutro\LaravelSettings\SettingStore');
        }

        return app('anlutro\LaravelSettings\SettingStore')->get($key, $default);
    }
}
if (! function_exists('getAllTeams')) {

      function getAllTeams(){
        // $teamsData = Vanguard\User::with('details')->whereHas('details',function($q){
        //     $q->where('fld_is_team',1);
        //   })->get();
        //   $teams = [];
        //   $teams["0"] = "Select Team";

        // foreach($teamsData as $team){
        //     $teams[$team->id] = $team->first_name;
        // }
        // return $teams;

        return [
            "0"=>"Select Team",
            "1"=>"Greg",
            "2"=>"Josh",
            "3"=>"Chris", 
            "4"=>"Damion"
        ];
      }
}

if (! function_exists('getMonths')) {

    function getMonths(){
        return [
            "01"=>"January",
            "02"=>"Feburary",
            "03"=>"March",
            "04"=>"April",
            "05"=>"May",
            "06"=>"June",
            "07"=>"July",
            "08"=>"August",
            "09"=>"September",
            "10"=>"October",
            "11"=>"November",
            "12"=>"December"
        ];
    }
}

if (!function_exists('lastQuery')) {
function lastQuery()
{
foreach(DB::getQueryLog() as $ky => $query){
dump(\Illuminate\Support\Str::replaceArray('?', $query['bindings'], $query['query']));
}
dd('DONE');
}
}


if(!function_exists('str_limit')){

    function str_limit($string,$limit=0,$end=null){
        return \Illuminate\Support\Str::limit($string,$limit,$end);
    }
}

if(!function_exists('str_slug')){

    function str_slug($string){
        return \Illuminate\Support\Str::slug($string);
    }
}

if(!function_exists('str_random')){

    function str_random(){
        return \Illuminate\Support\Str::random();
    }
}
