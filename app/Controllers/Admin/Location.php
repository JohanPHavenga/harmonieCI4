<?php

namespace App\Controllers\Admin;

use Config\Services;
use App\Controllers\AdminController;
use App\Models\LocationModel;

class Location extends AdminController
{
    private $return_url = "admin/location";
    private $create_url = "admin/location/create";
    protected $location_model;

    public function __construct()
    {
        $this->location_model = model(LocationModel::class);
    }

    public function view()
    {
        $this->data_to_views["location_data"] = $this->location_model->get_location_list();
        $this->data_to_views['heading'] = ["ID", "Location Name", "Actions"];
        $this->data_to_views['create_link'] = $this->create_url;

        $this->data_to_views['title'] = "Locations";
        $this->data_to_views['crumbs'] =
            [
                "Home" => "/admin",
                "Locations" => "/admin/location",
                "List" => "",
            ];

        $this->data_to_views['page_action_list'] =
            [
                [
                    "name" => "Add Location",
                    "icon" => "map",
                    "uri" => "location/create/add",
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
            . view('admin/location/view')
            . view('templates/admin/footer');
    }

    public function create($action, $id = 0)
    {

        // set data
        $this->data_to_views['title'] = ucfirst($action) . " Location";
        $this->data_to_views['action'] = $action;
        $this->data_to_views['form_url'] = base_url($this->create_url) . "/" . $action;


        if ($action == "edit") {
            $this->data_to_views['location_detail'] = $this->location_model->get_location_detail($id);
            $this->data_to_views['form_url'] = $this->create_url . "/" . $action . "/" . $id;
        }

        $this->data_to_views['validation'] = Services::validation();

        if (strtolower($this->request->getMethod()) !== 'post') {
            $this->data_to_views['return_url'] = base_url($this->return_url);
            return view('templates/admin/header', $this->data_to_views)
                . view('admin/location/create')
                . view('templates/admin/footer');
        } else {
            $rules = [
                'location_name' => ['label' => 'Location Name', 'rules' => 'required|min_length[2]'],
            ];

            if ($this->validate($rules)) {
                $db_write = $this->location_model->set_location($action, $id);
                if ($db_write) {
                    $alert = "Location has been updated";
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
                    $this->return_url = "admin/location/create/edit/" . $db_write;
                }

                return redirect()->to(base_url($this->return_url));
            } else {
                $this->data_to_views['return_url'] = base_url($this->return_url);
                return view('templates/admin/header', $this->data_to_views)
                    . view('admin/location/create')
                    . view('templates/admin/footer');
            }
        }
    }


    public function delete($location_id = 0)
    {

        if (($location_id == 0) and (!is_int($location_id))) {
            $this->session->setFlashdata('alert', 'Cannot delete record: ' . $location_id);
            $this->session->setFlashdata('status', 'danger');
            redirect($this->return_url);
            die();
        }

        // get location detail for nice delete message
        $location_detail = $this->location_model->get_location_detail($location_id);
        // delete record
        $db_del = $this->location_model->remove_location($location_id);

        if ($db_del) {
            $msg = "Location has successfully been deleted: " . $location_detail['location_name'];
            $status = "success";
        } else {
            $msg = "Error in deleting the record:'.$location_id";
            $status = "danger";
        }

        $this->session->setFlashdata('alert', $msg);
        $this->session->setFlashdata('status', $status);
        return redirect()->to(base_url($this->return_url));
    }
}
