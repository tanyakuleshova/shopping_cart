<?php

class Products extends Model {
    
    public function get_products(){
        return parent::$db->query('select * from products');
    }

    public function get_cart_products($id){
        return parent::$db->query("select * from products where id = $id");
    }
}