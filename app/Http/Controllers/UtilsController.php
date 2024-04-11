<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UtilsController extends Controller
{
    //
    public function returnSuccesJson()
    {
        return response()->json([
            'status' => 'done'
        ], Response::HTTP_OK);
    }

    public function returnErrorMessage($msg)
    {
        return response()->json([
            'status' => 'error',
            'msg' => $msg
        ], Response::HTTP_BAD_REQUEST);
    }

    public function returnErrorMessageWithException(Exception $ex)
    {
        Log::emergency("ERROR IN {$ex->getFile()} LINE {$ex->getLine()} - {$ex->getMessage()}");

        return response()->json([
            'status' => 'error',
            'msg' => 'Ah ocurrido un error, favor de ponerse en contacto con soporte'
        ], Response::HTTP_BAD_REQUEST);
    }

    public function returnValidationErrors($errors)
    {
        $finalMsg = '';

        foreach ($errors->toArray() as $error) {
            foreach ($error as $msg)
                $finalMsg .= "{$msg} <br>";
        }

        return response()->json([
            'status' => 'error',
            'msg' => $finalMsg
        ], Response::HTTP_BAD_REQUEST);
    }

    public function returnErrorView($msg)
    {
        return view('error', ['msg' => $msg]);
    }
}
