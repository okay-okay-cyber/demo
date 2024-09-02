<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Exercise;
use App\Models\product;
use App\Models\Program;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function productList(){
       $products= product::with('category')->where('amount',25)->take(1)->get();
        if ($products->isNotEmpty()){
            return ResponseHelper::success(message: 'All Products', data: $products, statuscode: 200);
        } else{
            return ResponseHelper::success(message:'No Products Found',data:[], statuscode: 200);

        }
    }
    public function categoryList(){
        $categories= Category::with('products')->get();
         if ($categories){
             return ResponseHelper::success(message: 'All Products', data: $categories, statuscode: 200);
         } else{
             return ResponseHelper::success(message:'No categories Found',data:[], statuscode: 200);
 
         }
        }
        public function programList(){
            $programs= Program::with('exercise')->where('amount',25)->take(1)->get();
             if ($programs->isNotEmpty()){
                 return ResponseHelper::success(message: 'All Programs', data: $programs, statuscode: 200);
             } else{
                 return ResponseHelper::success(message:'No Programs Found',data:[], statuscode: 200);
     
             }
         }
         public function exerciseList(){
            $exercises= Exercise::with('exercise')->get();
             if ($exercises){
                 return ResponseHelper::success(message: 'All Exercises', data: $exercises, statuscode: 200);
             } else{
                 return ResponseHelper::success(message:'No exercises Found',data:[], statuscode: 200);
     
             }

}
public function workoutList(){
    $workouts= Workout::with('exercise')->where('amount',25)->take(1)->get();
     if ($workouts->isNotEmpty()){
         return ResponseHelper::success(message: 'All Workouts', data: $workouts, statuscode: 200);
     } else{
         return ResponseHelper::success(message:'No Programs Found',data:[], statuscode: 200);

     }
    }
    public function userList(){
        $users= User::with('subscription')->where('amount',25)->take(1)->get();
         if ($users->isNotEmpty()){
             return ResponseHelper::success(message: 'All Users', data: $users, statuscode: 200);
         } else{
             return ResponseHelper::success(message:'No Users Found',data:[], statuscode: 200);
 
         }
        }
}
//categroy to product(one to many products)