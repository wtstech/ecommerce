<?php

namespace App;

class Cart extends ObjectModel
{

    protected $table = 'cart';
    protected $fillable = ['product_id', 'quantity', 'cart_price', 'unique_id', 'discount', 'options'];
    protected $uniqueID;
    protected $user;
    protected $product_id;
    protected $quantity;
    protected $cart_price;

    public function __construct()
    {
		
	$this->user = new User;

	if($this->user->uniqueId()){
	
		$this->uniqueID = $this->user->uniqueId();
	
	}

	
    }	

	
    public function getAll()
    {
		
	return $this->execute("SELECT *, cart.id AS cart_id FROM cart 
					LEFT JOIN products ON products.id = cart.product_id 
					WHERE cart.unique_id = ? AND cart.quantity > '0' AND cart.deleted_at IS NULL ", [$this->uniqueID] );
		
    }
		

    public function getTotalSpend()
    {
		
	$total_spend = 0;
	
	$query = $this->execute(' SELECT * FROM orders WHERE user_id = ? AND status != ? AND deleted_at IS NULL ', [$this->user->auth()->id, 'Pending']);
	
	foreach($query as $row){
	
		$total_spend += $row->cost;
	
	}
	
	return $total_spend;
		
    }

		
    public function discount()
    {
		
	$discount = 1;
		
	return $discount;
		
    }


    public function countItems()
    {

	$total = 0;

	foreach($this->getAll() as $row){
	
		$total += $row->quantity;
	
	}
	
	return $total;

    }
    

    public function subTotal()
    {

	$subTotal = 0;

	foreach($this->getAll() as $row){
	
		$subTotal += ( $row->quantity * $row->cart_price );
	
	}
	
	return $subTotal;
		
    }


    public function total()
    {
	return $this->subTotal() * $this->discount() * $this->getPromoDiscount() + $this->shipping();
    }
		
		
    public function newTotal()
    {
		
	if($this->total() <= 50){
	
		return 0;
	
	} else {
	
		return $this->total() - 50;
	
	}
		
    }
		
		
    public function vat()
    {
		
	if( ( $this->user->auth() && $this->user->auth()->member_type == 1 ) || !$this->user->auth() ){
	
		return 1.2;
	
	}
	
	return 1;
		
    }
		
		
    public function shipping()
    {
		
	if(isset($_SESSION[SESSION.'shipping']) && $_SESSION[SESSION.'shipping'] != ''){
	
		return $_SESSION[SESSION.'shipping'];
	
	}
	
	/* OR RETURN DEFAULT IF SHIPPING IS NOT SET */

	return '0.00';

    }
		
    public function setShipping()
    {
		
	$_SESSION[SESSION.'shipping'] = $_POST['shipping'];
	
	return redirect('basket.php', 'Your shipping option has been changed');
		
    }
    
    
    public function add()
    {
		
	if( isset($_POST['option_title']) ){
	
	$options = '';
	
		for( $i = 0; $i < count($_POST['option_title']); $i++ ){
		
			$options .= $_POST['option_title'][$i].': '.substr($_POST['option_values'][$i], 0, strpos($_POST['option_values'][$i], '-')).' <br /> ';
		
		}
	
	}
	
	$this->options = $options;
	$this->unique_id = $this->uniqueID;
	$this->discount = $this->discount();
	
	parent::add();

	return redirect($_SERVER['REQUEST_URI'], 'The product has been added to your basket');
		
    }
		
		
    public function cartReOrder()
    {
		
	$order_id = $_POST['order_id'];
	
	$query = $this->execute("SELECT * FROM products_from_order WHERE products_from_order.order_id = ?  ", [$order_id] );
	
	foreach($query as $row){
	
		$this->product_id = $row->product_id;
		$this->quantity = $row->quantity;
		$query2 = $this->execute("SELECT * FROM products WHERE id = ?  ", [$row->product_id] );
		
		/*  DON'T ADD THE PRODUCT IF IT HAS SINCE BEEN DELETED  */
		
		if($query2[0]->deleted_at != NULL){ continue; }
		
		/*  GET THE PRICE OF THE PRODUCT, NOT THE PRICE IT WAS ORIGINALLY BOUGHT FOR, INCASE IT HAS CHANGED  */
		
		$this->cart_price = $query2[0]->price;
		
		$this->add();
	
	}
		
    }
		
		
    public function delete($id)
    {
		
	$this->updateRow($this->table, ['deleted_at' => DT], 'id = :id AND unique_id = :unique_id  ', [ 'id' => $id, 'unique_id' => $this->uniqueID ] );
	
	return redirect('basket.php', 'The item has been deleted');
		
    }


    public function updateCart()
    {
		
	foreach($_POST as $key => $value){
	
		if(strstr($key, 'quantity')){
		
			$id = preg_replace("/[^0-9]/", '', $key);
			
			$this->updateRow($this->table, ['quantity' => $_POST[$key]], 'id = :id AND unique_id = :unique_id  ', [ 'id' => $id, 'unique_id' => $this->uniqueID ] );
		
		}
	
	}
	
	return redirect('basket.php', 'The basket has been updated');
		
    }
		
		
    public function setOrderEmailHtml($html)
    {
	$_SESSION[SESSION.'order-for-email'] = $html;
    }

		
    public function updateCartWithMemberType($member_type)
    {
		
	foreach($this->getAll() as $row){
	
		$this->updateRow($this->table, ['cart_member_type' => $member_type, 'discount' => $this->discount()], 'id = :id AND unique_id = :unique_id  ', [ 'id' => $row->cart_id, 'unique_id' => $this->uniqueID ] );
	
	}
		
    }
		
		
    public function updateCartWithNoMemberType()
    {
		
	foreach($this->getAll() as $row){
	
		$this->updateRow($this->table, ['cart_member_type' => 0, 'discount' => 1], 'id = :id AND unique_id = :unique_id  ', [ 'id' => $row->cart_id, 'unique_id' => $this->uniqueID ] );
	
	}
		
    }
		
		
    public function getPromoDiscountCodeId()
    {
		
	if(isset($_SESSION[SESSION.'promo_code']) && $_SESSION[SESSION.'promo_code'] != '' ){
	
		$this->table = 'promo_codes';
		
		$row = $this->getRowByFieldNotDeleted('id', $_SESSION[SESSION.'promo_code']);
		
		return $row->id;
	
	} elseif (isset( $_COOKIE[SESSION.'promo_code'] ) && $_COOKIE[SESSION.'promo_code'] != '' ) {
	
		$this->table = 'promo_codes';
		
		$row = $this->getRowByFieldNotDeleted('id', $_COOKIE[SESSION.'promo_code']);
		
		return $row->id;
	
	} else {
	
		return null;
	
	}
		
    }
		
		
    public function getPromoDiscount()
    {
		
	if(isset($_SESSION[SESSION.'promo_code']) && $_SESSION[SESSION.'promo_code'] != '' ){
	
		$this->table = 'promo_codes';
		
		$row = $this->getRowByFieldNotDeleted('id', $_SESSION[SESSION.'promo_code']);
		
		return ( 100 - $row->percentage )  / 100;
	
	} elseif (isset( $_COOKIE[SESSION.'promo_code'] ) && $_COOKIE[SESSION.'promo_code'] != '' ) {
	
		$this->table = 'promo_codes';
		
		$row = $this->getRowByFieldNotDeleted('id', $_COOKIE[SESSION.'promo_code']);
		
		return ( 100 - $row->percentage )  / 100;
	
	} else {
	
		return 1;
	
	}
		
    }

		
    public function deletePromoCodeIfExists()
    {
		
	if( isset($_SESSION[SESSION.'promo_code']) ){
	
		unset($_SESSION[SESSION.'promo_code']);
	
	}
	
	if( isset($_COOKIE[SESSION.'promo_code']) ){
	
		setcookie(SESSION.'promo_code', '', time()-3600, '/');
	
	}
		
    }



}
