<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/collections/all', 'shopifyApp@index');
Route::post('/shopify/data', 'ShopifyData@index');
Route::get('/show_products', function() { 
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
    $call = $shopify->call(['URL' => "admin/products.json?collection_id=4282712076&vendor=1%20Exam%20Prep&fields=id,title,images,vendor,product_type,variants", 'METHOD' => 'GET' ]);
}
catch (Exception $e)
{
    $call = $e->getMessage();
}

echo '<pre>';
print_r($call);
// print_r($call->product->images[0]->src);
echo '</pre>';
    // echo '<pre>';
    // print_r($products);
    // echo '</pre>';

    // Print out the title of each product we received 
    /*foreach($products as $product) { 
        echo ' ' . $product->id . ': ' . $product->title . ' '; 
    } */
});