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

    // Gets a list of products 
    // $result = $shopify->call([ 
    //     'METHOD'    => 'GET', 
        // 'URL'       => '/admin/products.json' 


        // Retrieve all products, showing only some attributes
        // 'URL'       => '/admin/products.json?fields=id,images,title' 

        // Retrieve all products that belong to a certain collection
        // 'URL'       => '/admin/products.json?collection_id=841564295' 


        // Retrieve all products after the specified ID
        // 'URL'       => '/admin/products.json?since_id=632910392' 


        // Retrieve a count of all products
        // 'URL'       => '/admin/products/count.json' 


        // Retrieve a count of all products of a given collection
        // 'URL'       => '/admin/products/count.json?collection_id=841564295

        // Retrieve a single product by ID
        // 'URL'       => '/admin/products/#{product_id}.json

        // Retrieve only particular fields
        // GET /admin/products/#{product_id}.json?fields=id,images,title


        // Create a new unpublished product
        //ID 1330213421134
        /*'METHOD'    => 'POST',
        'URL'       => '/admin/products.json',
        'DATA'      => '{
                          "product": {
                            "title": "test product",
                            "body_html": "<strong>test product</strong>",
                            "vendor": "test",
                            "product_type": "test",
                            "published": false
                          }
                        }'*/

    //     'METHOD'    => 'PUT',                
    //     'URL'       => '/admin/products/#{1330213421134}.json',
    //     'DATA'      => '{
    //                       "product": {
    //                         "id": 1330213421134,
    //                         "title": "New test product title"
    //                       }
    //                     }'


    // ]); 
    // $products = $result; 

// try
// {
//     $call = $shopify->call(['URL' => '/admin/products/#{product_id}.json', 'METHOD' => 'PUT', 'DATA'      => '{
//                           "product": {
//                             "id": 632910392,
//                             "title": "New test product title"
//                           }
//                         }' ]);
// }
// catch (Exception $e)
// {
//     $call = $e->getMessage();
// }


// try
// {
//     $call = $shopify->call(['URL' => '/admin/products/1330213421134.json', 'METHOD' => 'PUT', 'DATA'      => '{
//                           "product": {
//                             "id": 632910392,
//                             "title": "New test product title"
//                           }
//                         }' ]);
// }
// catch (Exception $e)
// {
//     $call = $e->getMessage();
// }



// try
// {
//     $call = $shopify->call(['URL' => '/admin/products/1330213421134.json', 'METHOD' => 'DELETE' ]);
// }
// catch (Exception $e)
// {
//     $call = $e->getMessage();
// }

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