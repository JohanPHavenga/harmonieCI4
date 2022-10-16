<?php

namespace App\Controllers\Admin;

use Config\Services;
use App\Controllers\AdminController;
use App\Models\ExtendedUserModel;

class User extends AdminController
{
    private $return_url = "admin/user";
    private $create_url = "admin/user/create";
    protected $user_model;

    public function __construct()
    {
        $this->user_model = model(ExtendedUserModel::class);
    }

    public function view()
    {
        $this->data_to_views["user_data"] = $this->user_model->get_user_list();
        $this->data_to_views['heading'] = ["ID", "User", "Actions"];
        $this->data_to_views['create_link'] = $this->create_url;

        $this->data_to_views['title'] = "Users";
        $this->data_to_views['crumbs'] =
            [
                "Home" => "/admin",
                "Types" => "/admin/user",
                "List" => "",
            ];

        $this->data_to_views['page_action_list'] =
            [
                [
                    "name" => "Add User",
                    "icon" => "pin",
                    "uri" => "user/create/add",
                ],
            ];

        $this->data_to_views['css_to_load'] = array(
            "assets/plugins/datatables/datatables.min.css",
            "assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css",
        );

        $this->data_to_views['js_to_load'] = array(
            "assets/scripts/admin/datatable.js",
            "assets/plugins/datatables/datatables.min.js",
            "assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js",
            "assets/plugins/bootstrap-confirmation/bootstrap-confirmation.js",
        );

        $this->data_to_views['scripts_to_load'] = array(
            "assets/scripts/admin/table-datatables-managed.js",
        );

        return view('templates/admin/header', $this->data_to_views)
            . view('admin/user/view')
            . view('templates/admin/footer');
    }

    public function create($action, $id = 0)
    {

        // set data
        $this->data_to_views['title'] = ucfirst($action) . " Type";
        $this->data_to_views['action'] = $action;
        $this->data_to_views['form_url'] = base_url($this->create_url) . "/" . $action;


        if ($action == "edit") {
            $this->data_to_views['user_detail'] = $this->user_model->get_user_detail($id);
            $this->data_to_views['form_url'] = $this->create_url . "/" . $action . "/" . $id;
        }

        $this->data_to_views['validation'] = Services::validation();

        if (strtolower($this->request->getMethod()) !== 'post') {
            $this->data_to_views['return_url'] = base_url($this->return_url);
            return view('templates/admin/header', $this->data_to_views)
                . view('admin/user/create')
                . view('templates/admin/footer');
        } else {
            $rules = [
                'name' => ['label' => 'Name', 'rules' => 'required|min_length[2]'],
                'surname' => ['label' => 'Surname', 'rules' => 'required|min_length[2]'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'],
                'username' => ['label' => 'Username', 'rules' => 'required|min_length[5]'],
            ];

            if ($this->validate($rules)) {
                $db_write = $this->user_model->set_user($action, $id);
                if ($db_write) {
                    $alert = "User has been updated";
                    $status = "success";
                } else {
                    $alert = "Error committing to the database";
                    $status = "danger";
                }

                $this->session->setFlashdata([
                    'alert' => $alert,
                    'status' => $status,
                ]);

                // save_only takes you back to the edit page.
                if (array_key_exists("save_only", $_POST)) {
                    $this->return_url = "admin/user/create/edit/" . $db_write;
                }

                return redirect()->to(base_url($this->return_url));
            } else {
                $this->data_to_views['return_url'] = base_url($this->return_url);
                return view('templates/admin/header', $this->data_to_views)
                    . view('admin/user/create')
                    . view('templates/admin/footer');
            }
        }
    }


    public function delete($id = 0)
    {

        if (($id == 0) and (!is_int($id))) {
            $this->session->setFlashdata('alert', 'Cannot delete record: ' . $id);
            $this->session->setFlashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get user detail for nice delete message
        $user_detail = $this->user_model->get_user_detail($id);
        // delete record
        $db_del = $this->user_model->remove_user($id);

        if ($db_del) {
            $msg = "User has successfully been deleted: " . $user_detail['name'];
            $status = "success";
        } else {
            $msg = "Error in deleting the record:'.$id";
            $status = "danger";
        }

        $this->session->setFlashdata('alert', $msg);
        $this->session->setFlashdata('status', $status);
        return redirect()->to(base_url($this->return_url));
    }
}
