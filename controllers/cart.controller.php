<?php

class CartController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Products();
    }

    public function index()
    {
        session_start();
        $this->data['cart_count'] = 0;

        if(isset($_SESSION['cart'])) {
            $this->data['cart'] = $_SESSION['cart'];
            if($_SESSION['cart'] !== ""){
                $cart_items_id = explode(",", $this->data['cart']);
            }

            if(isset($_POST['delete_from_cart'])){
                $deleted_item = $_POST['deleted_id'];

                foreach ($cart_items_id as $key => $value){
                    if($value == $deleted_item){
                        unset($cart_items_id[$key]);
                        break;
                    }
                }
                header("Refresh:0");
                $updated_cart_items_id = implode(",", $cart_items_id);
                $_SESSION['cart'] = $updated_cart_items_id;
            }
            if(isset($cart_items_id)){
                $cart_unique_items_id = array_unique($cart_items_id);
                $amount_of_each_products = array_count_values($cart_items_id);

                foreach ($cart_unique_items_id as $key=>$id){
                    $cart_products[] = $this->model->get_cart_products($id);
                }
                $this->data['cart_products'] = $cart_products;
                $this->data['cart_count'] = count($cart_items_id);
                $this->data['amount_of_each_products'] = $amount_of_each_products;
            } else {
                $this->data['cart_count'] = 0;
            }
        }
    }
}