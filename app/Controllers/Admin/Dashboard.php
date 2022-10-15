<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;

class Dashboard extends AdminController
{

    public function view()
    {
        $this->data_to_views['title'] = "Dashboard";
        $this->data_to_views['crumbs'] =
            [
                "Home" => "/admin",
                "Dashboard" => "",
            ];
        

        return view('templates/admin/header', $this->data_to_views)
            . view('admin/dashboard/view')
            . view('templates/admin/footer');
    }
}
