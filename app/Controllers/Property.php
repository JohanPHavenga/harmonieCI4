<?php

namespace App\Controllers;

use App\Models\LocationModel;
use App\Models\TypeModel;

class Property extends BaseController
{

    public function grid($property_type)
    {            
        $location_model = model(LocationModel::class);
        $type_model = model(TypeModel::class);
    
        $this->data_to_views['title']="Properties Listing | ".ucfirst($property_type);
        $this->data_to_views['active_menu']="property";        
        
        // pre-filter
        switch ($property_type) {
            case "houses":
                $filter['type_id']=1;
                break;
            case "apartments":
                $filter['type_id']=2;
                break;
            default:
                $filter['type_id']=0;             
                break;
        }
        
        if ($_POST) {
            $filter=$_POST;
        } else {
            $filter['sort']="property_sleeps";
            $filter['order']="DESC";
        }
        $this->data_to_views["filter"]=$filter;
        $this->data_to_views["prop_list"] = $this->property_model->get_property_filter($filter); 
       
        // get Dropdowns
        $this->data_to_views["location_dropdown"] = $location_model->get_location_dropdown();
        $this->data_to_views["type_dropdown"] = $type_model->get_type_dropdown();
        $this->data_to_views["beds_dropdown"] = $this->property_model->get_beds_dropdown(); 
        $this->data_to_views["sleeps_dropdown"] = $this->property_model->get_sleeps_dropdown(); 
        
        $this->data_to_views["sort_dropdown"]["property_rate_low"]="Rate";                
        $this->data_to_views["sort_dropdown"]["property_bedrooms"]="Beds";
        $this->data_to_views["sort_dropdown"]["property_sleeps"]="Sleeps";
        
        $this->data_to_views["order_dropdown"]["ASC"]="ASC";                
        $this->data_to_views["order_dropdown"]["DESC"]="DESC";
        
        return view('templates/header', $this->data_to_views)
            . view('property')
            . view('templates/footer');
    }

    public function search()
    {            
        $this->data_to_views['title']="Search";
        $this->data_to_views['active_menu']="property";        
        
        $this->data_to_views["prop_list"] = $this->property_model->get_property_list(["search"=>$_POST['ss']]);        
        return view('templates/header', $this->data_to_views)
        . view('search')
        . view('templates/footer');
    }

    public function detail($prop_code)
    {                  
        
        $this->data_to_views['active_menu']="property";        
        
        $lp_data['latest_properties']=$this->property_model->get_property_list(["latest"=>2]);     
        $this->data_to_views['latest_prop'] = view('templates/latest_prop', $lp_data);
        $cf_params=[];
        $this->data_to_views['contact_form'] = view('templates/contact_form', $cf_params);
        
        // send property code to the view
        $this->data_to_views['prop_code']=$prop_code;
        // get all the detail from the property using the code
        $this->data_to_views["property_data"] = $this->property_model->get_property_detail_from_code($prop_code);
        
        // get photos
        $photos_arr = get_filenames("photos/".$prop_code);
        // remove main image
        if ($photos_arr) {
            // dd($this->data_to_views["property_data"]);
            $key = array_search($this->data_to_views["property_data"]['property_img'], $photos_arr);
            unset($photos_arr[$key]);
        }
        $this->data_to_views["photos"]=$photos_arr;

        // d($this->data_to_views["property_data"]['property_img']);
        // dd($this->data_to_views["photos"]);
        
        // scripts to load
        $this->data_to_views['scripts_to_load']=array(
            "https://maps.googleapis.com/maps/api/js?key=".getenv('google.api'),
            "assets/plugins/gmaps/gmaps.js",
            );
        
        
        // get lat and long
        $gps_arr= explode(",", $this->data_to_views['property_data']['property_gps']);
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
                            title: '". esc($this->data_to_views['property_data']['property_address'])."',
                            infoWindow: {
                                    content: '<h3>".$this->data_to_views['property_data']['property_code']."</h3>".($this->data_to_views['property_data']['property_address'])."'
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
        
        $this->data_to_views['title']=$this->data_to_views["property_data"]['location_name']." | ".$prop_code;
        
        return view('templates/header', $this->data_to_views)
            . view('detail')
            . view('templates/footer');
    }
}
