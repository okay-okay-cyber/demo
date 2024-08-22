<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\EmailVerification;
use App\Models\User;
use App\Models\MobileUsers;
use App\Http\Controllers\Api\Validator;
use Illuminate\Support\Str;
use Exception;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;
use PhpParser\Node\stmt\TryCatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
  public function Addregister(RegisterRequest $request){
   // dd($request->all());
   try{
    $user=User::create([

        'name'=>$request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
        'phoneno'=>$request->phoneno
    ]);
    if ($user){
        $user->assignRole('user');
        $this->sendOtp($user);
        //return ResponseHelper::success(message:'User is saved', data: $user, statuscode:201);
        return ResponseHelper::success(message:'Mail has been sent, please check your mail', data: [], statuscode:201);

    }else{
        return ResponseHelper::errors(message: 'Unable to create User',statuscode:422);
    }

   } catch(Exception $ex){
    return ResponseHelper::errors(message:'Unable to save'.$ex->getMessage(), statuscode:500);
   }
  }
 public function login(LoginRequest $request )
 {
    
   $auth = Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
   if($auth === false){
    return ResponseHelper::errors(message:'Please enter valid Credentials',statuscode:401);
   }
   $user = Auth::user();
   if(!$user->is_verified){
    return ResponseHelper::errors(message:'Please verify your mail',statuscode:401);

   }
   $token = $user->createToken('token')->plainTextToken;
   $authUser=[
    'user'=>$user,
    'token'=>$token
   ];
   return ResponseHelper::success(message:'User is Logged In', data: $authUser, statuscode:200);
 }
 public function logout(){
    $user = Auth::user();
    if($user){
        $user->currentAccessToken()->delete();
        return ResponseHelper::success(message:'User is Logout', statuscode:200);
    }else{
        return ResponseHelper::errors(message: 'User not found',statuscode:422);
    }
 }
 public function sendOtp($user){
    $otp = rand(100000,999999);
    $time = date('Y-m-d H:i:s');

    EmailVerification::updateOrCreate(
        ['email'=>$user->email],
        ['otp'=>$otp],
        ['updated_at'=>$time]
    );
    $data['email']=$user->email;
    $data['title']="Mail Verification";
    $data['body']= "Your Otp is :-" . $otp;

    Mail::send('mail',['data'=>$data],function($message)use ($data){
        $message->to($data['email'])->subject($data['title']);
    });

 }
 public function verifiedOtp(Request $request){
    $user = User::where('email',$request->input('email'))->first();
    $otpData = EmailVerification::where('otp',$request->input('otp'))->first();
    if(!$otpData){
        return ResponseHelper::errors(message: 'Wrong otp',statuscode:400);
    }else{
        $currentTime = strtotime(date('Y-m-d H:i:s'));
        $time = strtotime($otpData->updated_at);
        if($currentTime>=$time && $time>=$currentTime-(90+5)){
            User::where('id',$user->id)->update([
                'is_verified'=> 1
            ]);
            return ResponseHelper::success(message:'Mail Verified',data:$user, statuscode:200);
        }else{
            return ResponseHelper::errors(message: 'Mail Expired',statuscode:400); 
        }
    }
 }
 public function resendOtp(Request $request){
    $user = User::where('email',$request->input('email'))->first();
    $otpData= EmailVerification::where('email',$request->input('email'))->first();
    $currentTime= strtotime(date('Y-m-d H:i:s'));
    $time = strtotime($otpData->updated_at);
    $timeDifference = $currentTime - $time;
    if($timeDifference<95){
        //90 seconds
        return ResponseHelper::errors(message: 'Please Wait',statuscode:400); 
    }else{
        $this -> sendOtp($user);
        //OTP SEND
        return ResponseHelper::success(message:'OTP has been sent', statuscode:200);
    }
 }
}