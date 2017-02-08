<?php

namespace App\Helpers;

class Tools
{

    public static function flashes()
    {

	$flashes = array();
	
	if(isset($_SESSION[SESSION.'flash']) && !empty($_SESSION[SESSION.'flash'])){
	
		foreach( $_SESSION[SESSION.'flash'] as $flash ){ 

			$flashes[] = $flash;					
		
		}				
	
	}

	return $flashes;

    }


    public static function flash($message)
    {
	$_SESSION[SESSION.'flash'][] = $message;
    }


    public static function error($message)
    {
	$_SESSION[SESSION.'errors'][] = $message;
    }


    public static function passwordHash($password)
    {

	if( $password == null ){
	
		return null;
	
	}
	
	return hash("sha256", $password . SALT);

    }


    public static function createHash($length)
    {

	$bytes = openssl_random_pseudo_bytes($length * 2);

	return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);

    }


    public static function boot()
    {

	if( isset($_POST) ){

		foreach( $_POST as $key => $value ){
		
			$_SESSION[SESSION.$key] = $value;
		
		}	

	}
	
	if( strstr( $_SERVER['REQUEST_URI'], '.php' ) ){
	
		/* Remove the .php in URL */
	
		redirect( str_replace('.php', '', $_SERVER['REQUEST_URI']) );
	
	}


    }


    public static function deleteSessions()
    {

	foreach($_SESSION as $key => $session){
	
		if( $key != self::passwordHash(SESSION.'session') && $key != SESSION.'shipping' && $key != SESSION.'unique'  ){
	
			unset($_SESSION[$key]);
		
		}
	
	}

    }


    public static function formatPostcode($postcode)
    {

	/*  Remove any spaces from postcode  */

	$postcode = preg_replace("/[^A-Za-z0-9]/", '', $postcode);
	
	/*  Make it capitals  */
	
	$postcode = strtoupper($postcode);
	
	/*  See how many characters are in postcode  */
	
	$postcodelength = strlen($postcode);
	
	/*  Put a space before last 3 digits  */
	
	$postcode = substr_replace($postcode, " ", ($postcodelength - 3), 0);
	
	return $postcode; 

    }


    public static function formatDate($date)
    {

		if(!$date){ return ''; }

		/*  Format all dates from dd/mm/yyy to yyyy-mm-dd for mysql  */
	
		$day = substr($date, 0, 2);
		$month = substr($date, 3, 2);
		$year = substr($date, 6, 4);
		
		return $year."-".$month."-".$day;

    }


    public static function formatFields($values, $dates)
    {

	foreach($values as $key => $value){
		
		/*  Format all fields with postcode in the field name  */
		
		if( strstr($key, 'postcode') ){
		
			$values[$key] = self::formatPostcode($values[$key]);
		
		}
	
		
	}
	
	foreach($dates as $dateField){
	
		if(isset($values[$dateField]) && $values[$dateField] != null){
		
			$values[$dateField] = self::formatDate($values[$dateField]);
		
		}
		
	}
	
		/*  Hash the password  */

	if( isset($values['password']) ){
	
		$values['password'] = self::passwordHash($values['password']);
		
	}
	
	if( isset($values['email']) ){
	
		/*  strtolower the email to look neat in DB  */
	
		$values['email'] = strtolower($values['email']);
		
	}

	
	return $values;

    }
    
    public static function getFileExtension($fileName)
    {
    
	$explodedot = explode('.', $fileName);
	$ext = $explodedot[sizeof($explodedot)-1];
	$ext = strtolower($ext);
	return $ext;
    
    }
    
    public static function validateImages()
    {
    
	foreach($_FILES as $key => $file){

		if($_FILES[$key]['size'] > 0){
		
			$ext = self::getFileExtension($_FILES[$key]['name']);

			$size = getimagesize($_FILES[$key]['tmp_name']);

				if(empty($size)){
				
					return redirect( $_SERVER['REQUEST_URI'], 'You tried to upload an invalid image', 'e' );
				
				}

				if ( $ext != "jpg" && $ext != "png" && $ext != "gif" ){
				
					return redirect( $_SERVER['REQUEST_URI'], 'JPG, PNG or GIF extensions only', 'e' );
				
				}

		}
		
	}
    
    }
    
    
    public static function addImages( $id, $image_folder, $obj )
    {
    
	foreach($_FILES as $key => $file){
	
		if($_FILES[$key]['size'] > 0){
	
			$alt_key = str_replace('file', 'alt', $key);
			
			$alt = $_POST[$alt_key];
			
			$ext = self::getFileExtension($_FILES[$key]['name']);
		
			$image_id = $obj->addImage( $id, $alt, $ext );
			
			move_uploaded_file($_FILES[$key]['tmp_name'], '../'.$image_folder.'/'.$image_id.'.'.$ext);
		
		}

	}
    
    }
    
    
    public static function updateImages( $id, $image_folder, $obj )
    {
   
	/* Set uploaded array as empty array */
    
	$uploadedArray = [];
    
	/*  See if any images exist first. If they do update the alt tags and update the image if one has been uploaded  */
	
	foreach($_POST as $key => $value){
	
		if( strstr($key, 'id-') ){
		
			$file_num = str_replace('id-', '', $key);
			
			$ext = $_POST['ext-'.$file_num];
			
			if( isset($_FILES['file-'.$file_num]) && $_FILES['file-'.$file_num]['size'] > 0 ){
			
				$ext = self::getFileExtension($_FILES['file-'.$file_num]['name']);
				
				move_uploaded_file($_FILES['file-'.$file_num]['tmp_name'], '../'.$image_folder.'/'.$_POST[$key].'.'.$ext);
				
				/*  Put this file upload in an array so we can skip it later on in the script  */
				
				$uploadedArray[] = 'file-'.$file_num;
			
			}
			
			/*  Update the file row  */
			
			$obj->updateImage( $_POST[$key], $_POST['alt-'.$file_num], $ext );
		
		}
	
	}
	
	/*  Upload new images  */
	
	foreach($_FILES as $key => $file){
	
	/*  Skip any that have been uploaded for an existing file row  */
	
	if(in_array($key, $uploadedArray)){ continue; }
	
		if($_FILES[$key]['size'] > 0){
	
			$alt_key = str_replace('file', 'alt', $key);
			$alt = $_POST[$alt_key];
			
			$ext = self::getFileExtension($_FILES[$key]['name']);
		
			$image_id = $obj->addImage( $id, $alt, $ext );
			
			move_uploaded_file($_FILES[$key]['tmp_name'], '../'.$image_folder.'/'.$image_id.'.'.$ext);
		
		}

	}
    
    }


}
