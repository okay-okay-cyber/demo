<?php

namespace App\Helper;

class ResponseHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function success($status='success',$message=null,$data=[],$statuscode=200){

        return response()->json([
            'message'=>$message,
            'status'=>$status,
            'data'=>$data,
        ], $statuscode);

    }
    public static function errors($status='error',$message=null,$statuscode=400){

        return response()->json([
            'message'=>$message,
            'status'=>$status,
        ], $statuscode);
    }
}
