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

class ForgotPasswordController extends Controller
{
    
 //public function forgetPassword(Request $request){
   // $request->validate(['email' => 'required|email']);

//    $user = User::where('email', $request->email)->first();
//
  //  if (!$user) {
   //     return ResponseHelper::errors(message: 'Email not found', statuscode:404);
    //}

   // $token = app('auth.password.broker')->createToken($user);
   // $resetLink = url('/reset-password/' . $token);

    //$data['email'] = $user->email;
    //$data['title'] = "Password Reset";
    //$data['body'] = "Here is your password reset link: " . $resetLink;

    //Mail::send('mail', ['data' => $data], function ($message) use ($data) {
      //  $message->to($data['email'])->subject($data['title']);
    //});

    //return ResponseHelper::success(message: 'Password reset link sent', data: [], statuscode:200);

 //}

 //public function resetPassword(Request $request){
   // $request->validate([
     //   'email' => 'required|email',
       // 'token' => 'required',
        //'password' => 'required|string|min:8|confirmed',
    //]);

    //$status = app('auth.password.broker')->reset(
      //  $request->only('email', 'password', 'password_confirmation', 'token'),
        //function ($user, $password) {
          //  $user->forceFill([
            //    'password' => Hash::make($password)
            //])->save();
        //}
    //);
   // if ($status == Password::PASSWORD_RESET) {
     //   return ResponseHelper::success(message: 'Password has been reset', data: [], statuscode:200);
   // } else {
     //   return ResponseHelper::errors(message: 'Invalid token or email', statuscode:400);
    //}
//}
// public function forgotPassword(Request $request){
//  try{
 //   $validateUser = FacadesValidator::make($request->all(),[
     //// Validator::make($request->all(),[
 //     'email'=> 'required|email|exists:mobile_users'
 //   ]);
  //  if($validateUser->fails()){
   //   //dd('validate fail');
   //   return response()->json([
    //    'status' => false,
    //   'message'=> 'Validation error',
    //    'errors'=> $validateUser->errors()
     // ],401);
   // }
   // //dd('validate pass');
   // $user = User::where('email',$request->email)->first();
  // MobileUsers::Where('email',$request->email)->first();
   //$this-> sendOtp($user);
   // return response()->json([
    //  'status'=> true,
   //   'message'=>'OTP has been sent.Pleaseverify your account to reset the password'
   // ], 200);



 // }catch(\Throwable $th){
  //  return response()->json([
  //    'status'=> false,
   //   'message'=> $th->getMessage()
   // ],500);

 // }
 // }
 
 public function forgotPassword(Request $request){

    $request->validate(['email'=>'required|email']);
    $status = Password::sendResetLink($request->only('email'));
    return $status === Password::RESET_LINK_SENT? response()->json(['message'=>__($status)],200):response()->json(['email'=>__($status)],400);
   }
   public function reset(Request $request){
    $request-> validate([
    'token'=>'required',
      'email'=>'required|email',
      'password'=>'required|string',
    ]);
    $status=Password::reset(
      $request->only('email','password','token'),
      function(User $user,string $password){
        $user->forcefill([
          'password'=>bcrypt($password),
         'remember_token'=> Str::random(60),
        ])->save();
      });
     return $status === Password::RESET_LINK_SENT? response()->json(['message'=>__($status)],200)
     :response()->json(['email'=>__($status)],400);
    
   }
   //////
    
   public function sendOtppass($user){
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
 public function passv(Request $request){
    $user = User::where('email',$request->input('email'))->first();
    $otpData = EmailVerification::where('otp',$request->input('otp'))->first();
    if(!$otpData){
        return ResponseHelper::errors(message: 'Wrong otp',statuscode:400);
    }else{
         $status=Password::reset(
      $request->only('email','password','otp'),
      function(User $user,string $password){
        $user->forcefill([
          'password'=>bcrypt($password),
         'remember_token'=> Str::random(60),
        ])->save();
      });
            return ResponseHelper::success(message:'Mail Verified',data:$user, statuscode:200);
        
    }
 }
   
  
  

}