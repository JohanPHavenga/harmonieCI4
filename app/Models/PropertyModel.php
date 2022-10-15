<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table = 'properties';

    public function record_count()
    {
        return $this->db($this->table)->countAll;
    }

    public function get_sleeps_dropdown()
    {
        $data[] = "Any";
        $data[2] = "2";
        $data[4] = "4";
        $data[5] = "5";
        $data[6] = "6";
        $data[7] = "7";
        $data[8] = "8";
        $data[10] = "10";
        $data[12] = "12+";
        return $data;
    }

    public function get_beds_dropdown()
    {
        $data[] = "Any";
        $data[1] = "1";
        $data[2] = "2";
        $data[3] = "3";
        $data[4] = "4";
        $data[5] = "5+";
        return $data;
    }

    public function get_property_list($params = [])
    {
        $builder = $this->db->table($this->table);
        $data = [];

        // ALL properties
        if (isset($params['all_prop'])) {
            $builder->orderBy('properties.updated_date', "desc");
        }
        // ALL properties incl unpublished
        if (!isset($params['include_unpublished'])) {
            $builder->where('property_ispublished', 1);
        }
        // FEATURED properties
        if (isset($params['is_featured'])) {
            $builder->limit(6);
            $builder->where('property_isfeatured', 1);
            $builder->orderBy('property_code');
        }
        // LATEST properties
        if (isset($params['latest'])) {
            $builder->limit($params['latest']);
            $builder->orderBy('properties.created_date', "desc");
        }

        // search
        if (isset($params['search'])) {
            $builder->where('property_code', $params['search']);
            $builder->orLike('property_summary', $params['search']);
            $builder->orLike('property_overview', $params['search']);
            $builder->orderBy('property_code');
        }

        // actual select
        $builder->select("properties.*,location_name, type_name");
        $builder->join('locations', 'properties.location_id=locations.location_id', 'left');
        $builder->join('types', 'properties.type_id=types.type_id', 'left');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $data[$row['property_id']] = $row;
        }
        return $data;
    }


    // Property grid filter
    public function get_property_filter($post)
    {

        $builder = $this->db->table($this->table);

        // Location filter
        if (isset($post['location_id'])) {
            if ($post['location_id'] > 0) {
                $builder->where('properties.location_id', $post['location_id']);
            }
        }
        // Type filter
        if (isset($post['type_id'])) {
            if ($post['type_id'] > 0) {
                $builder->where('properties.type_id', $post['type_id']);
            }
        }
        // Bedrooms filter
        if (isset($post['property_bedrooms'])) {
            if (($post['property_bedrooms'] > 0) && ($post['property_bedrooms'] <= 4)) {
                $builder->where('property_bedrooms', $post['property_bedrooms']);
            }
            if ($post['property_bedrooms'] == 5) {
                $builder->where('property_bedrooms >=', $post['property_bedrooms']);
            }
        }
        // Sleeps filter
        if (isset($post['property_sleeps'])) {
            if (($post['property_sleeps'] > 0) && ($post['property_sleeps'] <= 10)) {
                $builder->where('property_sleeps', $post['property_sleeps']);
            }
            if ($post['property_sleeps'] == 12) {
                $builder->where('property_sleeps >=', $post['property_sleeps']);
            }
        }

        // Sort by filter
        $builder->orderBy($post['sort'], $post['order']);

        // Rate Filter
        if (isset($post['inputPriceFrom'])) {
            $builder->where('property_rate_low >=', $post['inputPriceFrom']);
            $builder->where('property_rate_low <=', $post['inputPriceTo']);
        }

        // actual select
        $builder->join('locations', 'properties.location_id=locations.location_id', 'left');
        $builder->join('types', 'types.type_id=types.type_id', 'left');
        $builder->where('property_ispublished', 1);

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $data[$row['property_id']] = $row;
        }
        if (isset($data)) {
            $keys = array_keys($data);
            shuffle($keys);
            foreach ($keys as $key) {
                $shuffled_data[$key] = $data[$key];
            }
            return $shuffled_data;
        } else {
            return false;
        }
    }


    public function get_property_detail($id)
    {
        if (!($id)) {
            return false;
        } else {
            $builder = $this->db->table($this->table);
            $query = $builder->getWhere(['property_id' => $id]);

            return $query->getRowArray();
        }
    }

    public function get_property_detail_from_code($prop_code)
    {
        if (!($prop_code)) {
            return false;
        } else {
            $builder = $this->db->table($this->table);
            $builder->distinct();
            $builder->join('locations', 'properties.location_id=locations.location_id');
            $builder->join('types', 'types.type_id=types.type_id');
            $builder->where('property_code', $prop_code);
            $query = $builder->get();

            return $query->getRowArray();
        }
    }

    public function set_property($action, $id, $property_data = [])
    {
        // POSTED DATA
        if (empty($property_data)) {
            $property_data = $_POST;
            unset($property_data['save_only']);
            unset($property_data['files']);
            if (isset($_POST['property_ispublished'])) {
                $property_data['property_ispublished'] = true;
            } else {
                $property_data['property_ispublished'] = false;
            }
            if (isset($_POST['property_isfeatured'])) {
                $property_data['property_isfeatured'] = true;
            } else {
                $property_data['property_isfeatured'] = false;
            }
            // sit 0 voor getalle onder 10 in kode
            $code_arr = preg_split("/(,?\s+)|((?<=[a-z])(?=\d))|((?<=\d)(?=[a-z]))/i", $_POST['property_code']);
            if ($code_arr[1] < 10) {
                $code_arr[1] = "0" . $code_arr[1];
            }
            $code_search = implode("", $code_arr);
            $property_data['property_code_search'] = $code_search;
        }

        $builder = $this->db->table($this->table);

        switch ($action) {
            case "add":
                $builder->insert($property_data);
                return $this->db->insertID();

            case "edit":
                // add updated date to both data arrays
                $property_data['updated_date'] = date("Y-m-d H:i:s");

                $builder->set($property_data);
                $builder->where('property_id', $id);
                // dd($builder->getCompiledUpdate());
                $builder->update();
                // start SQL transaction                
                $builder->update($property_data, array('property_id' => $id));
                return $id;

            default:
                throw new \Exception('Incorrect Action');
                break;
        }
    }

    public function remove_property($id)
    {
        $builder = $this->db->table($this->table);
        if (!($id)) {
            return false;
        } else {
            $builder->delete(array('property_id' => $id));
            return true;
        }
    }

    public function get_property_list_data($params)
    {
        // field_arr is compulsary
        $field_arr = $params['field_arr'];
        $builder = $this->db->table($this->table);
        $builder->select($field_arr);
        return $builder->get();
    }
}
