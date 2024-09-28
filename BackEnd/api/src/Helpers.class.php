<?php
header("Access-Control-Allow-Origin: *");
class Helpers
{
    //Helpers
    public function isValidJSON($str)
    {
        json_decode($str);
        return json_last_error() == JSON_ERROR_NONE;
    }
}
