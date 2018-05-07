<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class ShopifyApp extends Controller
{
   public function index(){ 
	    // Code put here will run when you navigate to /show_products 
	    // This creates an instance of the Shopify API wrapper and 
	    // authenticates our app. 
	     $shopify = App::make('ShopifyAPI', [ 
	        'API_KEY'       => env('API_KEY',''), 
	        'API_SECRET'    => env('API_SECRET',''), 
	        'SHOP_DOMAIN'   => env('SHOP_DOMAIN',''), 
	        'ACCESS_TOKEN'  => env('ACCESS_TOKEN','') 
	    ]);

	    try
		{
		    $product = $shopify->call(['URL' => "admin/products.json?collection_id=4313874444?fields=id,title,images,body_html,variants", 'METHOD' => 'GET' ]);
		}
		catch (Exception $e)
		{
		    $product = $e->getMessage();
		}


		try
		{
		    $collections = $shopify->call(['URL' => "/admin/collection_listings.json?limit=10", 'METHOD' => 'GET' ]);
		}
		catch (Exception $e)
		{
		    $collections = $e->getMessage();
		}
		$data = [
		    'products'  => $product->products,
		    'collections'=>$collections->collection_listings
		];
		return view('productlist')->with($data);


		/*echo '<pre>';
		print_r($product->products);
		// print_r($call->product->images[0]->src);
		echo '</pre>';*/

	    // // Gets a list of products 
	    // $result = $shopify->call([ 
	    //     'METHOD'    => 'GET', 
	    //     'URL'       => '/admin/products.json?page=1' 
	    // ]); 
	    // $products = $result->products; 

	    // // Print out the title of each product we received 
	    // foreach($products as $product) { 
	    //     echo ' ' . $product->id . ': ' . $product->title . ' '; 
	    // } 
	}
}
