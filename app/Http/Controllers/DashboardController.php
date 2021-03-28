<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this ->middleware(['auth']);
    }

    //prepare a list of items, which will be past to the dashboard
    public function index(){
        //get a list of all items, containing product duplicates
        $products = auth()->user()->products;

        //create a new list, eliminating all duplicates to iterate over
        $filtered_products = auth()->user()->products->uniqueStrict('productname');
        
        //create a final list, which will be passed to the frondend as variable
        $final_list = collect([]);

        //iterate over all available producttypes, f.e.: toothpaste, tomatoe, apple
        foreach($filtered_products as $product){
            //reconstruct a list containing only one product type but with restored created_at / updated_at dates
            //f.e.: a list of all instances, where the user bought an apple
            $sorted_products = $products->where('productname', $product->productname)->values();
            $sorted_products->all();
            
            //if only a product was bought once, there is no real comsumption behaviour
            if($sorted_products->count()<=1){
                continue;
            }
            else{
                //calculate the time difference in days between buying each instance and calculate the average
                $date_diff = 0;
                for($i = 0; $i < $sorted_products->count()-1; $i++){
                    //look at dateConverter() for explanation
                    $date_diff += ($this->dateConverter($sorted_products[$i]->created_at)->diffInDays($this->dateConverter($sorted_products[$i+1]->created_at)));
                }
                
                //checking boundaries for user who frequently buys items to a point where average is lowered below one day
                //if average is below 1, round up the value, else cut off the decimal places for benefit of doubt
                if($date_diff < $sorted_products->count()-1){
                    $date_diff /= $sorted_products->count()-1;
                    $date_diff = intval(ceil($date_diff));
                }else{

                    $date_diff /= $sorted_products->count()-1;
                    $date_diff = intval($date_diff);
                }

                //calculate the difference between today and the last instance of buying a product
                $today = $this->dateConverter($sorted_products->last()->created_at)->diffInDays($this->dateConverter(Carbon::now()));
                

                //check if the product is flagged as remind me later item, if not
                //check if the product should be visible in recommendations
                
                if($this->dateConverter($sorted_products->last()->updated_at)->diffInDays($this->dateConverter(Carbon::now()))){
                    if($today >= $date_diff){
                        $final_list->push($sorted_products->last());
                        $final_list->all();
                    }
                }    
            }
        }
        
        //return the final list to frontend
        return view('dashboard' ,[
            'products' => $final_list,
        ]);
    }

    public function dontremind(Product $product){
        $product->touch();
        return back();
    }

    //Carbon date comparison only returns a date difference of 1 if 24 hours have passed between the days
    //date comparison should only look at date month and year as a date to work properly
    private function dateConverter(Carbon $date){
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;
        
        $correctDate = Carbon::create($year, $month, $day);
        return $correctDate;
    }

    public function buyitem(Product $product) {
        ProductController::storeExisting($product);
        return back();
    }
}
