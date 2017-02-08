<?php

namespace App;

class Category extends ObjectModel
{

    protected $table = 'categories';
    protected $fillable = ['title', 'seo_url'];
    protected $rules = ['title' => 'required', 'seo_url' => 'required|unique:categories'];

	
    public function getAll()
    {
	return $this->execute('SELECT * FROM categories WHERE deleted_at IS NULL ORDER BY title ASC ', [] );
    }


    public function add()
    {
    
	$this->seo_url = preg_replace("/[^A-Za-z0-9-]/", '', strtolower($_POST['seo_url']));
		
	if( !$this->validate() ){
	
		return redirect('account.php?page=category&action=add');
	
	}
	
	parent::add();

	return redirect('account.php?page=categories', 'The category has been added');
		
    }
		
		
    public function delete($id)
    {
		
	$this->updateRow($this->table, ['deleted_at' => DT], 'id = :id  ', [ 'id' => $id ] );
	
	return redirect('account.php?page=categories', 'The category has been deleted');
		
    }
		
    
    public function update($id, $whereValues = null)
    {
    
	$this->seo_url = preg_replace("/[^A-Za-z0-9-]/", '', strtolower($_POST['seo_url']));
		
	if( !parent::update('id = :id', ['id' => $id]) ){
	
		return redirect('account.php?page=category&action=edit&id='.$id);
	
	}

	return redirect('account.php?page=categories', 'The category has been updated');

    }



}
