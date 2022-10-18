<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtendedUserModel extends Model
{
    protected $table = 'users';

    public function record_count()
    {
        return $this->db($this->table)->countAll();
    }

    public function get_user_list()
    {
        $data = [];
        $builder = $this->db->table($this->table);
        // $builder->orderBy("user_name", "user_surname");
        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $data[$row['id']] = $row;
        }
        return $data;
    }

    public function get_user_list_old()
    {
        $data = [];
        $builder = $this->db->table("users_old");
        // $builder->orderBy("user_name", "user_surname");
        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $data[$row['user_id']] = $row;
        }
        return $data;
    }

    public function get_user_dropdown()
    {
        $builder = $this->db->table($this->table);
        $builder->select("user_id, user_name, user_surname");
        $builder->orderBy("user_name, user_surname");
        $query = $builder->get();

        $this->data[] = "Please Select";
        foreach ($query->getResultArray() as $row) {
            $data[$row['user_id']] = $row['user_name'] . " " . $row['user_surname'];
        }
        return $data;
    }

    public function get_user_detail($id)
    {
        if (!($id)) {
            return false;
        } else {
            $builder = $this->db->table($this->table);
            $query = $builder->getWhere(['id' => $id]);

            return $query->getRowArray();
        }
    }

    public function get_user_roles($id)
    {
        if (!($id)) {
            return false;
        } else {
            $data = [];
            $builder = $this->db->table('auth_groups_users');
            $builder->where(['user_id' => $id]);
            $query = $builder->get();

            foreach ($query->getResultArray() as $row) {
                $data[] = $row['group_id'];
            }

            return $data;
        }
    }

    public function get_roles()
    {
        $builder = $this->db->table('auth_groups');
        $query = $builder->get();
        foreach ($query->getResultArray() as $row) {
            $data[$row['id']] = $row['name'];
        }

        return $data;
        // return $query->getResultArray();
    }

    public function set_user($action, $id, $user_data = [])
    {
        // POSTED DATA
        if (empty($user_data)) {
            $user_data = array(
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
            );
            $roles['roles'] = $_POST['roles'];
        }

        // remove and add roles
        $builder = $this->db->table("auth_groups_users");
        $builder->delete(['user_id' => $id]);
        foreach ($roles['roles'] as $group_id) {
            $builder->insert(["group_id" => $group_id, "user_id" => $id]);
        }

        $builder = $this->db->table($this->table);
        switch ($action) {
            case "add":
                $builder->insert($user_data);
                return true;

            case "edit":
                // add updated date to both data arrays
                $user_data['updated_at'] = date("Y-m-d H:i:s");

                // start SQL transaction                
                $builder->update($user_data, array('id' => $id));
                return true;

            default:
                throw new \Exception('Incorrect Action');
                break;
        }
    }


    public function remove_user($id)
    {
        $builder = $this->db->table($this->table);
        if (!($id)) {
            return false;
        } else {
            $builder->delete(array('id' => $id));
            return true;
        }
    }
}
