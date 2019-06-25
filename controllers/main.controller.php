<?php

class MainController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Products();
    }

    public function index()
    {
        $this->data['products'] = $this->model->get_products();

        session_start();
//        session_destroy();
        if(isset($_POST['add_to_cart'])){
            if(isset($_SESSION['cart']) & !empty($_SESSION['cart'])){
                $items = $_SESSION['cart'];
                $items .= "," . $_POST['id'];
                $_SESSION['cart'] = $items;

            }else{
                $items = $_POST['id'];
                $_SESSION['cart'] = $items;
            }
        }

    }

}