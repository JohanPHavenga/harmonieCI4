<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table = 'types';

    public function record_count()
    {
        return $this->db($this->table)->countAll;
    }

    public function get_type_list()
    {
        $builder = $this->db->table($this->table);
        $builder->orderBy("type_name");
        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $data[$row['type_id']] = $row;
        }
        return $data;
    }

    public function get_type_dropdown()
    {
        $builder = $this->db->table($this->table);
        $builder->select("type_id, type_name");
        $builder->orderBy("type_name");
        $query = $builder->get();

        $data[] = "Please Select";
        foreach ($query->getResultArray() as $row) {
            $data[$row['type_id']] = $row['type_name'];
        }
        return $data;
    }

    public function get_type_detail($id)
    {
        if (!($id)) {
            return false;
        } else {
            $builder = $this->db->table($this->table);
            $query = $builder->getWhere(['type_id' => $id]);

            return $query->getResultArray();
        }
    }

    public function set_type($action, $id, $type_data = [])
    {
        // POSTED DATA
        if (empty($type_data)) {
            $type_data = array(
                'type_name' => $this->input->post('type_name'),
            );
        }
        $builder = $this->db->table($this->table);

        switch ($action) {
            case "add":
                $builder->insert($type_data);
                return true;

            case "edit":
                // add updated date to both data arrays
                $type_data['updated_date'] = date("Y-m-d H:i:s");

                // start SQL transaction                
                $builder->update($type_data, array('type_id' => $id));
                return true;

            default:
                throw new \Exception('Incorrect Action');
                break;
        }
    }


    public function remove_type($id)
    {
        $builder = $this->db->table($this->table);
        if (!($id)) {
            return false;
        } else {
            $builder->delete(array('type_id' => $id));
            return true;
        }
    }
}
