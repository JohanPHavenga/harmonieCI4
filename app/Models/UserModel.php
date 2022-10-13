<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    private function hash_pass($password)
    {
        if ($password) {
            return sha1($password . "37");
        } else {
            return NULL;
        }
    }

    public function record_count()
    {
        return $this->db($this->table)->countAll;
    }

    public function get_user_list()
    {
        $builder = $this->db->table($this->table);
        $builder->orderBy("user_name", "user_surname");
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
            $query = $builder->getWhere(['user_id' => $id]);

            return $query->getResultArray();
        }
    }

    public function set_user($action, $id, $user_data = [])
    {
        // POSTED DATA
        if (empty($user_data)) {
            $user_data = array(
                'user_name' => $_POST['user_name'],
                'user_surname' => $_POST['user_surname'],
                'user_email' => $_POST['user_email'],
                'user_username' => $_POST['user_username'],
                'user_password' => $this->hash_pass($_POST['user_password']),
            );
        } else {
            if (isset($user_data['user_password'])) {
                $user_data['user_password'] = $this->hash_pass($user_data['user_password']);
            }
        }
        $builder = $this->db->table($this->table);

        switch ($action) {
            case "add":
                $builder->insert($user_data);
                return true;

            case "edit":
                // add updated date to both data arrays
                $user_data['updated_date'] = date("Y-m-d H:i:s");
                //check of password wat gepost is alreeds gehash is
                if (@$this->check_password($_POST['user_password'], $id)) {
                    unset($user_data['user_password']);
                }

                // start SQL transaction                
                $builder->update($user_data, array('user_id' => $id));
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
            $builder->delete(array('user_id' => $id));
            return true;
        }
    }

    public function check_login()
    {
        $user_data = array(
            'user_username' => $_POST['user_username'],
            'user_password' => $this->hash_pass($_POST['user_password']),
        );

        $builder = $this->db->table($this->table);
        $builder("user_id, user_name, user_surname");
        $builder->where($user_data);
        $query = $builder->get();

        return $query->getRowArray();
    }

    private function check_password($password, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_password', $password);
        $builder->where('user_id', $id);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function export()
    {
        $builder = $this->db->table($this->table);
        $builder->select("user_id, user_name, user_surname, user_email");
        return $query = $builder->get();
    }
}
