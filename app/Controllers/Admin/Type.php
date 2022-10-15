<?php

namespace App\Controllers\Admin;

use Config\Services;
use App\Controllers\AdminController;
use App\Models\TypeModel;

class Type extends AdminController
{
    private $return_url = "admin/type";
    private $create_url = "admin/type/create";
    protected $type_model;

    public function __construct()
    {
        $this->type_model = model(TypeModel::class);
    }

    public function view()
    {
        $this->data_to_views["type_data"] = $this->type_model->get_type_list();
        $this->data_to_views['heading'] = ["ID", "Property Type", "Actions"];
        $this->data_to_views['create_link'] = $this->create_url;

        $this->data_to_views['title'] = "Prperty Types";
        $this->data_to_views['crumbs'] =
            [
                "Home" => "/admin",
                "Types" => "/admin/type",
                "List" => "",
            ];

        $this->data_to_views['page_action_list'] =
            [
                [
                    "name" => "Add Property Type",
                    "icon" => "pin",
                    "uri" => "type/create/add",
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
            . view('admin/type/view')
            . view('templates/admin/footer');
    }

    public function create($action, $id = 0)
    {

        // set data
        $this->data_to_views['title'] = ucfirst($action) . " Type";
        $this->data_to_views['action'] = $action;
        $this->data_to_views['form_url'] = base_url($this->create_url) . "/" . $action;


        if ($action == "edit") {
            $this->data_to_views['type_detail'] = $this->type_model->get_type_detail($id);
            $this->data_to_views['form_url'] = $this->create_url . "/" . $action . "/" . $id;
        }

        $this->data_to_views['validation'] = Services::validation();

        if (strtolower($this->request->getMethod()) !== 'post') {
            $this->data_to_views['return_url'] = base_url($this->return_url);
            return view('templates/admin/header', $this->data_to_views)
                . view('admin/type/create')
                . view('templates/admin/footer');
        } else {
            $rules = [
                'type_name' => ['label' => 'Property Type', 'rules' => 'required|min_length[2]'],
            ];

            if ($this->validate($rules)) {
                $db_write = $this->type_model->set_type($action, $id);
                if ($db_write) {
                    $alert = "Property type has been updated";
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
                    $this->return_url = "admin/type/create/edit/" . $db_write;
                }

                return redirect()->to(base_url($this->return_url));
            } else {
                $this->data_to_views['return_url'] = base_url($this->return_url);
                return view('templates/admin/header', $this->data_to_views)
                    . view('admin/type/create')
                    . view('templates/admin/footer');
            }
        }
    }


    public function delete($type_id = 0)
    {

        if (($type_id == 0) and (!is_int($type_id))) {
            $this->session->setFlashdata('alert', 'Cannot delete record: ' . $type_id);
            $this->session->setFlashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get type detail for nice delete message
        $type_detail = $this->type_model->get_type_detail($type_id);
        // delete record
        $db_del = $this->type_model->remove_type($type_id);

        if ($db_del) {
            $msg = "Property Type has successfully been deleted: " . $type_detail['type_name'];
            $status = "success";
        } else {
            $msg = "Error in deleting the record:'.$type_id";
            $status = "danger";
        }

        $this->session->setFlashdata('alert', $msg);
        $this->session->setFlashdata('status', $status);
        return redirect()->to(base_url($this->return_url));
    }
}
