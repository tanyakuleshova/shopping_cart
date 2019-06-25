<?php

class Nova_poshta_data extends Model
{
    public $city_fields = "{
            \"modelName\": \"Address\",
            \"calledMethod\": \"getCities\",
            \"methodProperties\": {
                \"\": \"\"
            },
            \"apiKey\": \"b988722612513eec4b1ce24df832172d\"
        }";

    public $city_ref;

    public function get_points_of_selected_city($city_ref){
        return $points = "{
            \"modelName\": \"Address\",
            \"calledMethod\": \"getWarehouses\",
            \"methodProperties\": {
                \"CityRef\": \"$city_ref\"
            },
            \"apiKey\": \"b988722612513eec4b1ce24df832172d\"
        }";
    }


    public function get_curl($fields)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => array("content-type: application/json",),
        ));
        return $curl;
    }
    public function get_cities_list($curl){
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);

        }
        return $response;
    }

    public function get_points_list($curl){
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }
        return $response;
    }

    /**
     * @return string
     */
    public function get_default_city()
    {

        $points = "{
            \"modelName\": \"Address\",
            \"calledMethod\": \"getWarehouses\",
            \"methodProperties\": {
                \"CityRef\": \"9523ea02-7302-11e9-898c-005056b24375\"
            },
            \"apiKey\": \"b988722612513eec4b1ce24df832172d\"
        }";

        $curl= $this->get_curl($points);
        $response=$this->get_points_list($curl);
        return $response;

    }

}