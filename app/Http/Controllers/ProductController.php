<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(){
        $this-> middleware(['auth']);
    }
	
	public function index(){
		return view('products.index');
	}
	
	public function store(Request $request){

		$this->validate($request,[
            'productname' => 'required|max:255',
            //'quantity' =>'required',		-> commented out for future possible functionality
        ]);

		//for ($i = 0; $i < $request->quantity; $i++) { -> for loop is needed, when implementing quantity
			Product::create([
				'productname' => $request->productname,
				'brandname' => $request->brandname,
				'articlenumber' => rand(100000,999999),
				'user_id' => auth()->id(),
			]);
		//}	
		
			//Other method of implementing above functionality
			/*$request->user()->products()->create([
				'productname' => $request->productname,
				'brandname' => $request->brandname,
				'articlenumber' => rand(100000,999999),	
			]);*/

		return back();
    }	

	public static function storeExisting(Product $product){
		Product::create([
			'productname' => $product->productname,
			'brandname' => $product->brandname,
			'articlenumber' => rand(100000,999999),
			'user_id' => auth()->id(),
		]);
	}
	
}
