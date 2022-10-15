<?php

namespace App\Controllers\Admin;

use Config\Services;
use App\Controllers\AdminController;
use App\Models\LocationModel;
use App\Models\TypeModel;

class Property extends AdminController
{
    private $return_url = "admin/property";
    private $create_url = "admin/property/create";

    public function view()
    {

        $this->data_to_views["property_data"] = $this->property_model->get_property_list(["include_unpublished" => TRUE]);

        $this->data_to_views['create_link'] = $this->create_url;
        $this->data_to_views['title'] = "Property List";
        $this->data_to_views['crumbs'] =
            [
                "Home" => "/admin",
                "Properties" => "/admin/property",
                "List" => "",
            ];

        $this->data_to_views['page_action_list'] =
            [
                [
                    "name" => "Add property",
                    "uri" => 'property/create/add',
                    "icon" => "plus",
                ],
                [
                    "name" => "Import properties",
                    "uri" => 'property/import',
                    "icon" => "arrow-up",
                ],
                [
                    "name" => "Export properties",
                    "uri" => 'property/export',
                    "icon" => "arrow-down",
                ],
            ];

        // $this->data_to_view['url'] = $this->url_disect();

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
            . view('admin/property/view')
            . view('templates/admin/footer');
    }


    public function create($action, $id = 0)
    {
        $location_model = model(LocationModel::class);
        $type_model = model(TypeModel::class);

        // set data
        $this->data_to_views['title'] = ucfirst($action) . " Property";
        $this->data_to_views['action'] = $action;
        $this->data_to_views['form_url'] = base_url($this->create_url) . "/" . $action;

        $this->data_to_views['css_to_load'] = array(
            "assets/plugins/bootstrap-summernote/summernote.css",
        );

        $this->data_to_views['js_to_load'] = array(
            "assets/plugins/moment.min.js",
            "assets/plugins/bootstrap-summernote/summernote.min.js",
        );

        $this->data_to_views['scripts_to_load'] = array(
            "assets/scripts/admin/components-editors.js",
        );

        // get drop downs
        $this->data_to_views['location_dropdown'] = $location_model->get_location_dropdown();
        $this->data_to_views['type_dropdown'] = $type_model->get_type_dropdown();

        $this->data_to_views['sleeps_dropdown'] = $this->property_model->get_sleeps_dropdown();
        $this->data_to_views['sleeps_dropdown'][0] = "Select";

        if ($action == "edit") {
            $this->data_to_views['property_detail'] = $this->property_model->get_property_detail($id);
            $this->data_to_views['form_url'] = $this->create_url . "/" . $action . "/" . $id;
        } else {
            $this->data_to_views['property_detail']['property_ispublished'] = FALSE;
            $this->data_to_views['property_detail']['property_isfeatured'] = FALSE;
        }

        // dd($this->data_to_views);
        $this->data_to_views['validation'] = Services::validation();

        if (strtolower($this->request->getMethod()) !== 'post') {
            $this->data_to_views['return_url'] = base_url($this->return_url);
            return view('templates/admin/header', $this->data_to_views)
                . view('admin/property/create')
                . view('templates/admin/footer');
        } else {


            $rules = [
                'property_code' => ['label' => 'Property Code', 'rules' => 'required|min_length[2]'],
                'property_sleeps' => ['label' => 'Sleeps', 'rules' => 'required|numeric'],
                'property_bathrooms' => ['label' => 'Bathrooms', 'rules' => 'numeric'],
                'property_bedrooms' => ['label' => 'Bedrooms', 'rules' => 'numeric'],
                'property_rate_low' => ['label' => 'Rate Low', 'rules' => 'numeric'],
                'property_rate_med' => ['label' => 'Rate Medium', 'rules' => 'numeric'],
                'property_rate_high' => ['label' => 'Rate High', 'rules' => 'numeric'],
                'location_id' => ['label' => 'Location', 'rules' => 'required|numeric|greater_than[0]'],
            ];

            $errors = [
                'location_id' => [
                    'recaptcha' => 'Please select a location'
                ]
            ];

            if ($this->validate($rules, $errors)) {
                $db_write = $this->property_model->set_property($action, $id);
                if ($db_write) {
                    $alert = "Property has been updated";
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
                    $this->return_url = "admin/property/create/edit/" . $db_write;
                }

                return redirect()->to(base_url($this->return_url));
            } else {
                $this->data_to_views['return_url'] = base_url($this->return_url);
                return view('templates/admin/header', $this->data_to_views)
                    . view('admin/property/create')
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

        // get location detail for nice delete message
        $property_detail = $this->property_model->get_property_detail($id);
        // delete record
        $db_del = $this->property_model->remove_property($id);

        if ($db_del) {
            $msg = "Property has successfully been deleted: " . $property_detail['property_code'];
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
