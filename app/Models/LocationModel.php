<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'locations';
    protected $data = false;

    public function record_count()
    {
        return $this->db($this->table)->countAll;
    }

    public function get_location_list()
    {
        $builder = $this->db->table($this->table);
        $builder->orderBy("location_name");
        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $this->data[$row['location_id']] = $row;
        }
        return $this->data;
    }

    public function get_location_dropdown()
    {
        $builder = $this->db->table($this->table);
        $builder->select("location_id, location_name");
        $builder->orderBy("location_name");
        $query = $builder->get();

        $this->data[] = "Please Select";
        foreach ($query->getResultArray() as $row) {
            $this->data[$row['location_id']] = $row['location_name'];
        }
        return $this->data;
    }

    public function get_location_detail($id)
    {
        if (!($id)) {
            return false;
        } else {
            $builder = $this->db->table($this->table);
            $query = $builder->getWhere(['location_id' => $id]);

            return $query->getResultArray();
        }
    }

    public function set_location($action, $id, $location_data = [])
    {
        // POSTED DATA
        if (empty($location_data)) {
            $location_data = array(
                'location_name' => $this->input->post('location_name'),
            );
        }
        $builder = $this->db->table($this->table);

        switch ($action) {
            case "add":
                $builder->insert($location_data);
                return true;

            case "edit":
                // add updated date to both data arrays
                $location_data['updated_date'] = date("Y-m-d H:i:s");

                // start SQL transaction                
                $builder->update($location_data, array('location_id' => $id));
                return true;

            default:
                throw new \Exception('Incorrect Action');
                break;
        }
    }


    public function remove_location($id)
    {
        $builder = $this->db->table($this->table);
        if (!($id)) {
            return false;
        } else {
            $builder->delete(array('location_id' => $id));
            return true;
        }
    }
}
