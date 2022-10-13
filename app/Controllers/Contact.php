<?php

namespace App\Controllers;

use Config\Services;

class Contact extends BaseController
{

    public function index($from = NUll)
    {
        $this->data_to_views['title'] = "Contact Us";
        $this->data_to_views['active_menu'] = "contact";

        $lp_data['latest_properties'] = $this->property_model->get_property_list(["latest" => 4]);
        $this->data_to_views['latest_prop'] = view('templates/latest_prop', $lp_data);
        $this->data_to_views['css_to_load'] = array("assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css",);
        $this->data_to_views['js_to_load'] = array("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",);
        $this->data_to_views['scripts_to_load'] = array("assets/scripts/contact.js", "https://www.google.com/recaptcha/api.js");
        $this->data_to_views["sleeps_dropdown"] = $this->property_model->get_sleeps_dropdown();
        $this->data_to_views["beds_dropdown"] = $this->property_model->get_beds_dropdown();
        $this->data_to_view['from'] = $from;

        $this->data_to_views['validation'] = Services::validation();

        $errors = [];
        $rules = [
            'inputContactName' => ['label' => 'Name', 'rules' => 'required|min_length[3]'],
            'inputContactEmail' => ['label' => 'Email', 'rules' => 'required|valid_email'],
            'inputContactPhone' => ['label' => 'Phone Number', 'rules' => 'required'],
            'inputSleeps' => ['label' => 'Number of guests', 'rules' => 'required'],
            'inputDateFrom' => ['label' => 'Date From', 'rules' => 'required'],
            'inputDateTo' => ['label' => 'Date To', 'rules' => 'required'],
            'inputContactMessage' => ['label' => 'Message', 'rules' => 'required'],
        ];

        if ($_ENV['CI_ENVIRONMENT'] == "production") {
            $rules['g-recaptcha-response'] = ['label' => 'Captcha', 'rules' => 'recaptcha'];
            $errors = [
                'g-recaptcha-response' => [
                    'recaptcha' => 'Please tick the reCaptcha box'
                ]
            ];
        }

        if ($this->validate($rules, $errors)) {
            // mail
            $email = \Config\Services::email();

            // $config['SMTPHost'] = 'https://smtp.harmonieprop.co.za';
            // $config['SMTPPort'] = '465';
            $config['mailType'] = 'html';

            $email->initialize($config);

            $email->setFrom($_POST['inputContactEmail'], $_POST['inputContactName']);
            $email->setTo('info@harmonieprop.co.za');
            $email->setBCC('johan.havenga@gmail.com');

            if ($_POST['inputPropCode']) {
                $email->setSubject('Website Query: ' . $_POST['inputPropCode'] . ' #' . time());
            } else {
                $email->setSubject('General website query #' . time());
            }

            // set msg
            $msg_arr[] = "Name: " . $_POST['inputContactName'];
            $msg_arr[] = "Phone Number: " . $_POST['inputContactPhone'];
            $msg_arr[] = "Email: " . $_POST['inputContactEmail'];
            if ($_POST['inputPropCode']) {
                $msg_arr[] = "Property equiring about: " . $_POST['inputPropCode'];
            }
            if ($_POST['inputSleeps'] > 0) {
                if ($_POST['inputSleeps'] == 12) {
                    $num_guests = "12+";
                } else {
                    $num_guests = $_POST['inputSleeps'];
                }
                $msg_arr[] = "Number of Guests: " . $num_guests;
            }
            if ($_POST['inputBeds'] > 0) {
                if ($_POST['inputBeds'] == 5) {
                    $num_beds = "5+";
                } else {
                    $num_beds = $_POST['inputBeds'];
                }
                $msg_arr[] = "Bedrooms: " . $num_beds;
            }
            $msg_arr[] = "Date From: " . $_POST['inputDateFrom'];
            $msg_arr[] = "Date To: " . $_POST['inputDateTo'];
            $msg_arr[] = "Message: " . $_POST['inputContactMessage'];
            $msg = implode("<br>", $msg_arr);

            $email->setMessage($msg);

            $email->send();
            return view('templates/header', $this->data_to_views)
                . view('contact_success')
                . view('templates/footer');
        } else {
            $data['validation'] = $this->validator;
            return view('templates/header', $this->data_to_views)
                . view('contact')
                . view('templates/footer');
        }


        // if (strtolower($this->request->getMethod()) !== 'post') {
        //     return view('templates/header', $this->data_to_views)
        //         . view('contact')
        //         . view('templates/footer');
        // }

        // $rules = [];

        // if (!$this->validate($rules)) {
        //     $this->data_to_views['validation'] = $this->validator;
        //     return view('templates/header', $this->data_to_views)
        //         . view('contact')
        //         . view('templates/footer');
        // }

        // // success
        // return view('templates/header', $this->data_to_views)
        //     . view('contact_success')
        //     . view('templates/footer');
    }

    public function about()
    {
        $this->data_to_views['title'] = "About Us";
        $this->data_to_views['active_menu'] = "about";

        return view('templates/header', $this->data_to_views)
            . view('about')
            . view('templates/footer');
    }
}
