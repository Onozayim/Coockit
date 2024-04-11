<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait Utils
{
    public function returnSuccesJson()
    {
        return response()->json([
            'status' => 'done'
        ], Response::HTTP_OK);
    }

    public function returnDataJson($data, $key = 'data')
    {
        return response()->json([
            'status' => 'done',
            $key => $data
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

        foreach ($errors->toArray() as $index => $error) {
            foreach ($error as $msg)
            {
                if(str_contains($msg, ':position'))
                {
                    $new_index = 0;
                    if(str_contains($index, '.'))
                    {
                        $new_index = substr($index, strpos($index, '.') + 1); 
                        $new_index = (int)$new_index;
                        $new_index++;
                    }
                    $msg = str_replace(':position', $new_index, $msg);
                }

                $finalMsg .= "{$msg} <br>";
            }
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
