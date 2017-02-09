<?php

require __DIR__.'/includes/config.php';

$url = $_SERVER['REQUEST_URI'];
$slug = explode('/', $_SERVER['REQUEST_URI']);
$slug = $slug[count($slug)-1];

if( strstr($url, 'blog/') ){

	include('blog-page.php');
	exit;

} elseif(strstr($url, 'product/')){

	include('product-details-page.php');
	exit;

} else{

	$row = $categoryObj->getRowByField('seo_url', $slug);
	$row2 = $subcategoryObj->getRowByField('seo_url', $slug);

	if( isset($row->id) ){

		$category_id = $row->id;
		$category_title = $row->title;
		include('product-list.php');

	} elseif( isset($row2->id) ){
	
		$sub_category_id = $row2->id;
		$sub_category_title = $row2->title;
		include('product-list.php');
	
	} else {
	
		include('404.php');
	
	}

	exit;

}