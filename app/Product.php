<?php	

namespace App;

use App\Helpers\Tools;
use App\ProductImage;

class Product extends ObjectModel{

    protected $table = 'products';
    protected $fillable = ['title', 'seo_url', 'category_id', 'price', 'special_offer_price', 'description', 'attributes'];
    protected $rules = [
					'title' => 'required',
					'seo_url' => 'required|unique:products',
					'category_id' => 'required', 
					'price' => 'required',
					'description' => 'required'
			];
			
			
    public function __construct()
    {
    
	$this->productImageObj = new ProductImage;
    
    }


    public function getAll()
    {

	return $this->execute('SELECT *, products.title AS product_title, categories.title AS category_title, products.seo_url AS product_seo_url, 
					products.id AS product_id FROM products 
					LEFT JOIN categories ON categories.id = products.category_id 
					WHERE products.deleted_at IS NULL  ', [] );

    }
    

    public function getAllForHomepage()
    {

	return $this->execute('SELECT * FROM products WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 16  ', [] );

    }
    

    public function getAllByCategory($categoryId)
    {

	return $this->execute("SELECT * FROM products WHERE 
					category_id = ? AND products.deleted_at IS NULL ", [$categoryId] );		

    }
    
    public function getLatest()
    {

	return $this->execute("SELECT * FROM products WHERE 
					products.deleted_at IS NULL ORDER BY products.id DESC LIMIT 4 ", [] );		

    }
		
		
    public function search($search)
    {
		
	return $this->execute("SELECT * FROM products WHERE 
					( title LIKE ? OR product_code LIKE ? ) AND products.deleted_at IS NULL 
					ORDER BY products.product_code ASC ", ["%".$search."%", "%".$search."%"] );		
		
    }


    public function getProductById($id)
    {

	return $this->execute("SELECT *, products.id AS product_id, products.title AS product_title 
					FROM products LEFT JOIN sub_categories ON sub_categories.id = products.sub_category_id 
					WHERE products.id = ?  ", [$id] );		

    }
    
    
    public function getAttributes()
    {
    
	if( !count($_POST['attributes']) ){
	
		return '';
	
	}

	$attributes = json_encode($_POST['attributes']);
	
	foreach( $_POST['attributes'] as $attribute ){
	
		if( $attribute == '' ){
		
			$attributes = '';
			continue;
		
		}
	
	}
	
	return $attributes;

    }
    


    public function add()
    {
    
	Tools::validateImages();

    	$this->seo_url = preg_replace("/[^A-Za-z0-9-]/", '', strtolower($_POST['seo_url']));

	if( !$this->validate() ){
	
		return redirect('account.php?page=product&action=add');
	
	}
	
	$this->attributes = $this->getAttributes();
	
	$id = parent::add();
	
	Tools::addImages( $id, 'product-images', $this->productImageObj );

	return redirect('account.php?page=products', 'The product has been added');

    }
		
		
    public function update($id, $whereValues = null)
    {
    
	$uploadedArray = array();
	
	/*  See if file uploads are valid images  */
    
	Tools::validateImages();
	
	/*  Remove all but chars and dashes from seo url  */

	$this->seo_url = preg_replace("/[^A-Za-z0-9-]/", '', strtolower($_POST['seo_url']));
	
	$this->attributes = $this->getAttributes();

	if( !parent::update('id = :id', ['id' => $id]) ){
	
		return redirect('account.php?page=product&action=edit&id='.$id);
	
	}
	
	Tools::updateImages( $id, 'product-images', $this->productImageObj );

	return redirect('account.php?page=products', 'The product has been updated');

    }


    public function delete($id)
    {

	$this->updateRow($this->table, ['deleted_at' => DT], 'id = :id  ', [ 'id' => $id ] );
	
	return redirect('account.php?page=products', 'The product has been deleted');

    }


    public function deleteImage($image)
    {

	copy('../product-images/'.$image, '../deleted-product-images/'.$image);
	unlink('../product-images/'.$image);

	return redirect( 'account.php?page=product&action=edit&id='.$_GET['id'], 'The image has been deleted' );

    }
		
		
    public function uploadImages($id)
    {

	foreach($_FILES as $key => $file){
	
		$fileNum = str_replace('file-', '', $key);

		if($_FILES[$key]['size'] > 0){

			$explodedot = explode('.', $_FILES[$key]['name']);
			$ext = $explodedot[sizeof($explodedot)-1];
			$ext = strtolower($ext);

			$size = getimagesize($_FILES[$key]['tmp_name']);

				if(empty($size)){
				
					return redirect( 'account.php?page=product&action=edit&id='.$id, 'You must upload a valid image', 'e' );
				
				}

				if ( $ext != "jpg" && $ext != "png" && $ext != "gif" ){
				
					return redirect( 'account.php?page=product&action=edit&id='.$id, 'JPG, PNG or GIF extensions only', 'e' );
				
				}
			
				if(file_exists('../product-images/'.$id.'-'.$fileNum.'.jpg')){ 
				
					unlink( '../product-images/'.$id.'-'.$fileNum.'.jpg' );
					
				}
				
				if(file_exists('../product-images/'.$id.'-'.$fileNum.'.png')){
				
					unlink( '../product-images/'.$id.'-'.$fileNum.'.png' );
				
				}
				
				if(file_exists('../product-images/'.$id.'-'.$fileNum.'.gif')){
				
					unlink( '../product-images/'.$id.'-'.$fileNum.'.gif' );
				
				}
				
				if(file_exists('../product-images/'.$id.'-'.$fileNum.'.jpeg')){
				
					unlink( '../product-images/'.$id.'-'.$fileNum.'.jpeg' );
				
				}
			
				move_uploaded_file($_FILES[$key]['tmp_name'], '../product-images/'.$id.'-'.$fileNum.'.'.$ext);

		}

	}

    }
		
		
    public function updateTable()
    {

	$query = $this->execute('SELECT * FROM products WHERE products.deleted_at IS NULL ', [] );
	
	foreach($query as $row){
	
		$count = substr_count($row->size, 'X');
		
		if($count == 2){
		
			$explode = explode('X', $row->size);
			
			$this->updateRow($this->table, ['inner_diameter' => trim($explode[0]), 'outer_diameter' => trim($explode[1]), 'thickness' => trim($explode[2])], 'id = :id LIMIT 1 ', [ 'id' => $row->id ] );
		
		}
	
		
	
	}

    }



}
