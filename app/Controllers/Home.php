<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        $this->data_to_views['active_menu'] = "home";

        $featured_props = $this->property_model->get_property_list(["is_featured" => TRUE]);
        $keys = array_keys($featured_props);
        shuffle($keys);
        foreach ($keys as $key) {
            $this->data_to_views["featured_properties"][$key] = $featured_props[$key];
        }

        $this->data_to_views["all_properties"] = $this->property_model->get_property_list(["all_prop" => TRUE]);

        $lp_data['latest_properties'] = $this->property_model->get_property_list(["latest" => 4]);

        $this->data_to_views['latest_prop'] = view('templates/latest_prop', $lp_data);
        $this->data_to_views['scripts_to_load'] = array("assets/scripts/home.js",);

        $numbers = range(1, 6);
        shuffle($numbers);
        $this->data_to_views['home_img_num'] = $numbers;

        return view('templates/header', $this->data_to_views)
            . view('home')
            . view('templates/footer');
    }

    public function about()
    {
        $this->data_to_views['title'] = "About Us";
        $this->data_to_views['active_menu'] = "about";

        return view('templates/header', $this->data_to_views)
            . view('about')
            . view('templates/footer');
    }
}
