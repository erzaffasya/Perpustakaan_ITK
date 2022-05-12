<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Api extends Controller
{
    public const ERROR_VALIDATION_CODE = 201;
    public const SUCCESS_MESSAGE_UPDATE = 'SUCCESS TO UPDATE DATA';
    public const ERROR_MESSAGE_WHEN_SAVE = 'ERROR TO UPDATE DATA';
    protected const VIDEO_MIME= ['mp4','flv','m3u8','ts','3gp','mov','avi','wmv'];
    protected const IMAGE_MIME= ['jpeg','JPEG','jpg','JPG','png','PNG'];

    protected function successResponse($data = null, $message = "success", $code = 200)
    {
        return response()->json([
            'status'=> 'success',
            // 'message' => $message,
            'code' => $code,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'status'=>'error',
            'message' => $message,
            'code' => $code,
            'data' => null
        ], 201);
    }

    protected function now(){
        return date('Y-m-d H:i:s');
    }

    protected function user (){
        $user = null;
        if(auth('sanctum')->check()){
            $user = auth('sanctum')->user();
        }
        return $user;
    }

    protected function vendor() {
        $user = null;
        if(auth('sanctum')->check()){
            $user = auth('sanctum')->user();
            if (!$user->is_vendor) {
                return null;
            }
            $user = User::where('id' , $user->id)->with('vendor')->first();
        }
        return $user;
    }
}