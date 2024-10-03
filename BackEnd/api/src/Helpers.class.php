<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Request-Method: *");
header("Access-Control-Request-Headers: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
class Helpers
{
    //Helpers
    public function isValidJSON($str)
    {
        json_decode($str);
        return json_last_error() == JSON_ERROR_NONE;
    }
}
