<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ShopifyData extends Controller
{
    public function index(Request $request){ 
    	 // dd($request->all());
    	$pass=$request->input('pass');
    	if(isset($pass)){
    		$shopify = App::make('ShopifyAPI', [ 
		        'API_KEY'       => env('API_KEY',''), 
		        'API_SECRET'    => env('API_SECRET',''), 
		        'SHOP_DOMAIN'   => env('SHOP_DOMAIN',''), 
		        'ACCESS_TOKEN'  => env('ACCESS_TOKEN','') 
		    ]);
    		if($pass == 'collectionData'){
    			$id=$request->input('id');
    			try
				{
				    $product = $shopify->call(['URL' => "admin/products.json?collection_id=".$id."&fields=id,title,image,vendor,product_type,variants", 'METHOD' => 'GET' ]);
				}
				catch (Exception $e)
				{
				    $product = $e->getMessage();
				}

				return response()->json([
					'data' => $product->products
				]);
    		}else if($pass == 'collectionDataVendor'){
    			$id=$request->input('id');
    			$collectionid=$request->input('collectionid');
    			try
				{
				    $product = $shopify->call(['URL' => "admin/products.json?collection_id=".$collectionid."&vendor=".$id."&fields=id,title,image,vendor,product_type,variants", 'METHOD' => 'GET' ]);
				}
				catch (Exception $e)
				{
				    $product = $e->getMessage();
				}

				return response()->json([
					'data' => $product->products
				]);
    		}else if($pass == 'collectionDataType'){
    			$URL="";
    			$id=$request->input('id');
    			$collectionid=$request->input('collectionid');
    			if($request->input('vendorid')){
    				$vendorid=$request->input('vendorid');
    				$URL="admin/products.json?collection_id=".$collectionid."&vendor=".$vendorid."&product_type=".$id."&fields=id,title,image,vendor,product_type,variants";
    			}else{
    				$URL="admin/products.json?collection_id=".$collectionid."&product_type=".$id."&fields=id,title,image,vendor,product_type,variants";
    			}
    			try
				{
				    $product = $shopify->call(['URL' => $URL, 'METHOD' => 'GET' ]);
				}
				catch (Exception $e)
				{
				    $product = $e->getMessage();
				}

				return response()->json([
					'data' => $product->products
				]);
    		}
	    }	
    }
}
