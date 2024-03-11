<?php

namespace App\Helpers;
use App\Helpers\Globals as Globals;


class SharedHelper
{
    public static function sendOkHttpResponse($data)
    {
        try {
            return response()->json($data);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function sendOkHttpMessage($message)
    {
        try {
            return response()->json(["message" => $message], Globals::$STATUS_CODE_SUCCESS);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    public static function sendFailedHttpResponse($message)
    {
            return response()->json(["message" => $message], Globals::$STATUS_CODE_ERROR);
    }

}