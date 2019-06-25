<?php

class OrderController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Nova_poshta_data();
    }

    public function index()
    {
        $city_curl = $this->model->get_curl($this->model->city_fields);
        $this->data['cities'] = $this->model->get_cities_list($city_curl);

        if(isset($_REQUEST["term"])){

            $points = $this->model->get_points_of_selected_city($_REQUEST["term"]);
            $points_curl = $this->model->get_curl($points);
            $this->data['points'] = $this->model->get_points_list($points_curl);

            foreach ($this->data['points']['data'] as $key => $item) {
                    echo "<option>" . $item['Description'] . "</option>";
            }

        }
        else {
            $city_ref  = "8e1718f5-1972-11e5-add9-005056887b8d";
        }

        $points = $this->model->get_points_of_selected_city($city_ref);
        $points_curl = $this->model->get_curl($points);
        $this->data['points'] = $this->model->get_points_list($points_curl);

//        $this->data['default_city']  = $this->model->get_default_city();

    }
}