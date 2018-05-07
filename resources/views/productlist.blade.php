<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf_token" value="{{ csrf_token() }}">
		<title>Laravel</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<!-- Styles -->

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script>
		$(function () {

		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
		        }
		    });
		}); 
		</script>

		<style type="text/css">
			.main{
				margin: 20px;
			}
			.loderImg{
				position: fixed;
				display: none;
			    width: 100%;
			    height: 100%;
			    top: 0;
			    left: 0;
			    right: 0;
			    bottom: 0;
			    background-color: rgba(225, 225, 225, 0.78);
			    z-index: 2;
		        padding: 0;
   			 	margin: 0;
			}
			.loderImg img{
			    position: relative;
			    height: 80px;
			    margin: 0 auto;
			    vertical-align: middle;
			    top: 50%;
			}
			.filter-section{
				border-right: 1px solid #f7f7f7;
   			 	float: left;
			}
			.products-section{
				float: left;
				margin-top: 22px;
			}
			.filter-container{
			    padding: 0 50px;
			}
			.filter-container h3{
				text-align: center;
    			text-transform: uppercase;
			}
			.filter-container h4{
    			text-transform: uppercase;
			}
			.filter-container ul{
				list-style: none;
				padding-top: 3px;
				padding-bottom: 3px;
				background: #dedede;
				text-transform: uppercase;
			}
			.filter-container ul li{

			}
			.filter-container ul li label{
				padding-left: 6px;
			    letter-spacing: 0.1em;
			    font-size: 1em;
			    padding-right: 6px;
			}
			.product-img{
				width: 100%;
			    height: 200px;
			    overflow: hidden;
			}
			.product-container img{
				display: block;
			    max-width: 100%;
			    height: auto;
			    margin-top: 10px;
			}
			.shop_desc {
			    border: 1px solid #E0E0E0;
			    padding: 5%;
			    width: 100%;
   				height: 117px;
			}
			.shop_desc h3 {
				font-size: 16px;
			    margin-bottom: 5px;
			    font-weight: bold;
			}
			span.actual {
			    color: #7DB122;
			    font-size: 1em;
			    color: #000;
			}
			.alert-info{
				display: none;
				margin-top: 22px;
			}
		</style>

		<!-- <link rel="stylesheet" href="{{asset('asset/app.css')}}"> -->
	</head>
	<body>
		<dir class="loderImg">
			<img src='http://v6.player.abacast.net/assets/images/loading.gif' class="img-responsive" alt="loading . ."/>
		</dir>
		<div class="main">
			<div class="col-md-3 filter-section">
				<div class="row">
					<div class="filter-container">
						<h3>Filter Products</h3>
						<ul>
							<h4>Collections:</h4>
							@foreach($collections as $c)
							<li><input type="radio" value="{{$c->collection_id}}" name="collection"><label>{{$c->title}}</label></li>
							@endforeach
						</ul>
						<div class="vendors">
						</div>
						<div class="producttype">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9 products-section">
				<div class="row collectionProducts">
					@foreach($products as $p)
					<div class="col-md-4 product-container">
						<div class="product-img">
						<img src="@if(isset($p->images[0]->src)){{$p->images[0]->src}}@else
								    https://cdn.shopify.com/s/files/1/1706/0693/files/pic5.jpg?13336466864015698105 @endif" class="img-responsive" alt=""/>
						</div>
						<div class="shop_desc">
							<h3>{{$p->title}}</h3>
							
							<span class="actual">{{$p->variants[0]->price}} $</span>
						</div>
					</div>
					@endforeach
				</div>
				<div class="alert alert-info" role="alert">
				  <strong>Massage!</strong> Product Not Found.
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	var collectionid;
	var vendorid;
	var ptypeid;
    $(':radio[name="collection"]').change(function() {
    	var vendors=new Array();
	  	var productType=new Array();
	  	html1= '<ul><h4>Vendors:</h4>';
	  	html2= '<ul><h4>Product Type:</h4>';
      $('.loderImg').show();
      collectionid=this.value;
      console.log(collectionid);
	    $.ajax({
	      url: '/shopify/data',
	      type: 'post',
	      data: {
	      	pass: 'collectionData',
	        id: collectionid
	      },
	      success: function(response) {
	        var i,html='',src="https://cdn.shopify.com/s/files/1/1706/0693/files/pic5.jpg?13336466864015698105";
	        if(response.data.length < 1){
	        		$('.alert-info').show();
	        	}else{
	        		$('.alert-info').hide();
	        	}
	        for (i = 0, len = response.data.length ; i < len; i++) {
	        	console.log(response.data);
	        	if(response.data[i].vendor !== null && response.data[i].vendor !== ""){
	        		if(jQuery.inArray( response.data[i].vendor, vendors) == -1){
	        			vendors.push(response.data[i].vendor);
	        		}
	        	}
	        	if(response.data[i].product_type !== null && response.data[i].product_type !== ""){
	        		if(jQuery.inArray( response.data[i].product_type, productType) == -1){
	        			productType.push(response.data[i].product_type);
	        		}
	        	}
	        	if(response.data[i].image !== null && response.data[i].image.src !== null ){
	        		src=response.data[i].image.src;
	        	}
			    html+=	'<div class="col-md-4 product-container">'+
							'<div class="product-img">'+
							'<img src='+src+' class="img-responsive" alt=""/>'+
							'</div>'+
							'<div class="shop_desc">'+
								'<h3>'+response.data[i].title+'</h3>'+
								
								'<span class="actual">'+response.data[i].variants[0].price+'$</span>'+
							'</div>'+
						'</div>';
			}
			$('.collectionProducts').empty();
			$('.collectionProducts').append(html);
			$('.loderImg').hide();
			for (var i = 0, len = vendors.length ; i < len; i++) {
				html1+= '<li><input type="radio" value="'+vendors[i]+'" name="vendor"><label>'+vendors[i]+'</label></li>';
			}
			for (var i = 0, len = productType.length ; i < len; i++) {
				html2+= '<li><input type="radio" value="'+productType[i]+'" name="productType"><label>'+productType[i]+'</label></li>';
			}
			html1+= '</ul>';
			html2+= '</ul>';
			$('.producttype').empty();
			$('.vendors').empty();
			$('.vendors').append(html1);
			$('.producttype').append(html2);
	      },
	      error: function() {
	        
	      }
	  });
    });
    $(document).on('change', ':radio[name="vendor"]', function() {
	  var productType=new Array();
	  html2= '<ul><h4>Product Type:</h4>';
      $('.loderImg').show();
      vendorid=this.value.replace(/\s/g,"%20");
      console.log(vendorid);
	    $.ajax({
	      url: '/shopify/data',
	      type: 'post',
	      data: {
	      	pass: 'collectionDataVendor',
	        collectionid: collectionid,
	        id: vendorid
	      },
	      success: function(response) {
	        var i,html='',src="https://cdn.shopify.com/s/files/1/1706/0693/files/pic5.jpg?13336466864015698105";
	        if(response.data.length < 1){
	        		$('.alert-info').show();
	        	}else{
	        		$('.alert-info').hide();
	        	}
	        for (i = 0, len = response.data.length ; i < len; i++) {
	        	if(response.data[i].product_type !== null && response.data[i].product_type !== ""){
	        		if(jQuery.inArray( response.data[i].product_type, productType) == -1){
	        			productType.push(response.data[i].product_type);
	        		}
	        	}
	        	if(response.data[i].image !== null && response.data[i].image.src !== null ){
	        		src=response.data[i].image.src;
	        	}
			    html+=	'<div class="col-md-4 product-container">'+
							'<div class="product-img">'+
							'<img src='+src+' class="img-responsive" alt=""/>'+
							'</div>'+
							'<div class="shop_desc">'+
								'<h3>'+response.data[i].title+'</h3>'+
								
								'<span class="actual">'+response.data[i].variants[0].price+'$</span>'+
							'</div>'+
						'</div>';
			}
			$('.collectionProducts').empty();
			$('.collectionProducts').append(html);
			$('.loderImg').hide();
			for (var i = 0, len = productType.length ; i < len; i++) {
				html2+= '<li><input type="radio" value="'+productType[i]+'" name="productType"><label>'+productType[i]+'</label></li>';
			}
			html2+= '</ul>';
			$('.producttype').empty();
			$('.producttype').append(html2);
	      },
	      error: function() {
	        
	      }
	  });
    });
    $(document).on('change', ':radio[name="productType"]', function() {
      $('.loderImg').show();
      ptypeid=this.value.replace(/\s/g,"%20");
      console.log(ptypeid);
	    $.ajax({
	      url: '/shopify/data',
	      type: 'post',
	      data: {
	      	pass: 'collectionDataType',
	        collectionid: collectionid,
	        vendorid: vendorid,
	        id: ptypeid
	      },
	      success: function(response) {
	        var i,html='',src="https://cdn.shopify.com/s/files/1/1706/0693/files/pic5.jpg?13336466864015698105";
	        for (i = 0, len = response.data.length ; i < len; i++) {
	        	if(response.data.length < 1){
	        		$('.alert-info').show();
	        	}else{
	        		$('.alert-info').hide();
	        	}
	        	if(response.data[i].image !== null && response.data[i].image.src !== null ){
	        		src=response.data[i].image.src;
	        	}
			    html+=	'<div class="col-md-4 product-container">'+
							'<div class="product-img">'+
							'<img src='+src+' class="img-responsive" alt=""/>'+
							'</div>'+
							'<div class="shop_desc">'+
								'<h3>'+response.data[i].title+'</h3>'+
								
								'<span class="actual">'+response.data[i].variants[0].price+'$</span>'+
							'</div>'+
						'</div>';
			}
			$('.collectionProducts').empty();
			$('.collectionProducts').append(html);
			$('.loderImg').hide();
	      },
	      error: function() {
	        
	      }
	  });

    });
</script>