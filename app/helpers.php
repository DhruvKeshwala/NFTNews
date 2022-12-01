<?php
use App\Models\Country;
//to get all countries list
if(!function_exists("getCountries")){

    function getCountries()
    {
        return Country::orderBy('id','desc')->get();
    }
}
//to get global pagination_records value
function getPaginationRecordNo()
{
    return config('constant.pagination_records');
}