<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$parameter_1 = $this->uri->segment(1);
$parameter_2 = $this->uri->segment(2);
$parameter_3 = $this->uri->segment(3);
$parameter_4 = $this->uri->segment(4);
$parameter_5 = $this->uri->segment(5);
$parameter_6 = $this->uri->segment(6);

//SUBFOLDER & CLASS;
$route['default_controller'] 	= 'ControllerMenus/ControllerDefault';
$route['welcome'] 		 	 		  = 'ControllerMenus/ControllerDefault';
$route['sitelogin'] 	 	 			= 'ControllerDoLogin/ControllerLogin/login';
$route['statlogin'] 	 	 			= 'ControllerDoLogin/ControllerLogin/do_login';
$route['logout'] 	 	 	 	 		  = 'ControllerDoLogin/ControllerLogin/do_logout';
$route['create-workload']     = 'ControllerMenus/ControllerCreateWorkload';
$route['test/(:any)'] 			  = 'ControllerMenus/ControllerTest';

//SWITCHING MENU MASTER.
switch($parameter_3)
{
	case 'edit':
		$route['master/(:any)/(:any)/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'/'.$parameter_3.'/'.$parameter_4.'';
	break;
	case 'delete':
		$route['master/(:any)/(:any)/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'/'.$parameter_3.'/'.$parameter_4.'';
	break;
	case 'add-children':
		$route['master/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'/'.$parameter_3.'/'.$parameter_4.'/'.$parameter_5.'/'.$parameter_6.'';
	break;
	case 'edit-children':
		$route['master/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'/'.$parameter_3.'/'.$parameter_4.'/'.$parameter_5.'/'.$parameter_6.'';
	break;
	case 'edit-parent':
		$route['master/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'/'.$parameter_3.'/'.$parameter_4.'/'.$parameter_5.'/'.$parameter_6.'';
	break;
	case 'delete-parent':
		$route['master/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'/'.$parameter_3.'/'.$parameter_4.'/'.$parameter_5.'/'.$parameter_6.'';
	break;
	default:
		$route['master/(:any)'] = 'ControllerMenus/ControllerDefault/'.$parameter_2 .'';
	break;
}
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
