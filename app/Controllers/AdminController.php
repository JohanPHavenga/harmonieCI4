<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\PropertyModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class AdminController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['session', 'form', 'formulate', 'filesystem', 'auth'];
    protected $property_model, $uri;

    public $logout_url = "/login/logout";
    public $upload_path = "./uploads/admin/";

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // set data_to_views as empty array
        $this->data_to_views = [];
        // global property model
        $this->property_model = model(PropertyModel::class);
        // create session
        $this->session = \Config\Services::session();

        $this->data_to_views['crumbs'] = $this->set_crumbs();
        $this->data_to_views['menu_array'] = $this->set_admin_menu_array();    
        
    }

    private function set_crumbs()
    {
        // setup auto crumbs from URI
        $uri = current_url(true);
        $segs = $uri->getSegments();
        $crumb_uri = substr(base_url(), 0, -1);
        $total_segments = $uri->getTotalSegments();

        // d($segs);
        // d($crumb_uri);
        // dd($total_segments);

        for ($x = 0; $x < $total_segments; $x++) {

            if (($x == $total_segments) || ($x == 3)) {
                $crumb_uri = "";
            } else {
                $crumb_uri .= "/" . $segs[$x];
            }

            if ($segs[$x] == "admin") {
                $segs[$x] = "home";
            }
            if ($segs[$x] == "dashboard") {
                continue;
            }
            if ($segs[$x] == "delete") {
                $crumbs = [];
                break;
            }

            $segs[$x] = str_replace("_", " ", $segs[$x]);
            $crumbs[ucwords($segs[$x])] = $crumb_uri;

            if ($x == 3) {
                break;
            }
        }

        return $crumbs;
    }

    function set_admin_menu_array()
    {
        return [
            // Dashboard
            [
                "text" => "Dashboard",
                "url" => 'admin',
                "icon" => "bar-chart",
                "seg0" => ['dashboard'],

            ],
            // Properties
            [
                "text" => "Properties",
                "url" => 'admin/property',
                "icon" => "home",
                "seg0" => ['property'],
                "submenu" => [
                    [
                        "text" => "List properties",
                        "url" => 'admin/property',
                        "icon" => "home",
                    ],
                    [
                        "text" => "Add property",
                        "url" => 'admin/property/create/add',
                        "icon" => "plus",
                    ],
                    [
                        "text" => "Import properties",
                        "url" => 'admin/property/import',
                        "icon" => "arrow-up",
                    ],
                    [
                        "text" => "Export properties",
                        "url" => 'admin/property/export',
                        "icon" => "arrow-down",
                    ],
                ],
            ],
            // Users
            [
                "text" => "Users",
                "url" => 'admin/user',
                "icon" => "user",
                "seg0" => ['user'],
            ],
            // Locations
            [
                "text" => "Locations",
                "url" => 'admin/location',
                "icon" => "map",
                "seg0" => ['location'],
            ],
            // Locations
            [
                "text" => "Property Types",
                "url" => 'admin/type',
                "icon" => "pin",
                "seg0" => ['type'],
            ],
        ];
    }
}
