<?php

namespace App\Controllers;

use App\Models\PropertyModel;

class Property extends BaseController
{
    protected $property_model;

    public function __construct()
    {
        $this->property_model = model(PropertyModel::class);
    }

    public function detail($prop_code)
    {                  
        
        $this->data_to_views['active_menu']="property";        
        
        $lp_data['latest_properties']=$this->property_model->get_property_list(["latest"=>2]);     
        dd($lp_data);       
        $this->data_to_view['latest_prop'] = $this->load->view('templates/latest_prop', $lp_data, TRUE);
        $cf_params=[];
        $this->data_to_view['contact_form'] = $this->load->view('templates/contact_form', $cf_params, TRUE);
        
        // send property code to the view
        $this->data_to_view['prop_code']=$prop_code;
        // get all the detail from the property using the code
        $this->data_to_view["property_data"] = $this->property_model->get_property_detail_from_code($prop_code);
        // get photos
        $photos_arr = get_filenames("photos/".$prop_code);
        // remove main image
        if ($photos_arr) {
            $key = array_search($this->data_to_view["property_data"]['property_img'], $photos_arr);
            unset($photos_arr[$key]);
        }
        $this->data_to_view["photos"]=$photos_arr;
        
        
        
        // scripts to load
        $this->data_to_footer['scripts_to_load']=array(
            "https://maps.googleapis.com/maps/api/js?key=AIzaSyBeY1SbJOL5kjjqRr9Kwf4RZ3Zyf44S1Dg",
            "assets/plugins/gmaps/gmaps.js",
            );
        
        
        // get lat and long
        $gps_arr= explode(",", $this->data_to_view['property_data']['property_gps']);
        if (count($gps_arr)>1) {
            $lat=$gps_arr[0];
            $long=$gps_arr[1];
        
        // script to add gmaps to the page
        $this->data_to_footer['scripts_to_display'][]="            
            var PageContact = function() {
            
                var _init = function() {
                    var mapbg = new GMaps({
                            div: '#property-map',
                            lat: $lat,
                            lng: $long,
                            zoom: 15,
                            scrollwheel: false
                            });

                    mapbg.addMarker({
                            lat: $lat,
                            lng: $long,
                            title: '". html_escape($this->data_to_view['property_data']['property_address'])."',
                            infoWindow: {
                                    content: '<h3>".$this->data_to_view['property_data']['property_code']."</h3>".($this->data_to_view['property_data']['property_address'])."'
                            }
                           
                    });
                }

                return {
                    init: function() {
                        _init();
                    }

                };
            }();

            $(document).ready(function() {
                PageContact.init();
            });";        
        }
        
        $this->data_to_header['title']=$this->data_to_view["property_data"]['location_name']." | ".$prop_code;
        
        $this->load->view($this->header_url, $this->data_to_header);
        $this->load->view('detail', $this->data_to_view);
        $this->load->view($this->footer_url, $this->data_to_footer);
    }
}
