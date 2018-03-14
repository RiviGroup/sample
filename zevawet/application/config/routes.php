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
$route['default_controller'] = 'Admin';
$route['admin_login'] = 'Admin/admin_login';
$route['dashboard'] = 'Admin/dashboard';
$route['Clinician'] = 'Admin/Clinician';
$route['Appointments'] = 'Admin/Appointments';
//$route['Users'] = 'Admin/Users';
$route['Patient'] = 'Admin/Patient';
$route['Payments'] = 'Admin/Payments';
$route['Analytics'] = 'Admin/Analytics';
$route['reports'] = 'Admin/reports';
$route['settings'] = 'Admin/settings';
$route['login_checkin'] = 'Admin/login_checkin';
$route['get_submenulist/(:any)'] = 'Admin/get_submenulist/$1';
$route['Menu_Management'] = 'Admin/Menu_Management';
$route['Role_Management'] = 'Admin/Role_Management';
$route['User_Management'] = 'Admin/User_Management';
$route['createuser'] = 'Admin/createuser';
$route['mopderator_dashboard'] = 'Admin/mopderator_dashboard';
$route['marketing_dashboard'] = 'Admin/marketing_dashboard';
$route['fromdateandtodatedata/(:any)'] = 'Admin/fromdateandtodatedata/$1';
$route['advanced_searching'] = 'Admin/advanced_searching';
$route['mobilevalidation/(:any)'] = 'Admin/mobilevalidation/$1';
$route['patient_page/(:any)'] = 'Admin/patient_page/$1';
$route['Registration'] = 'Admin/Registration';
$route['Referrer_Management'] = 'Admin/Referrer_Management';
$route['Referral_Managent'] = 'Admin/Referral_Managent';
$route['referrer_add_type'] = 'Admin/referrer_add_type';
$route['select_refer_type'] = 'Admin/select_refer_type';
$route['referrer_edit_refer'] = 'Admin/referrer_edit_refer';
$route['edit_referrer/(:any)'] = 'Admin/edit_referrer/$1';
$route['edit_corp_referrer/(:any)'] = 'Admin/edit_corp_referrer/$1';
$route['referrer_update_type'] = 'Admin/referrer_update_type';
$route['referrer_add_registration'] = 'Admin/referrer_add_registration';
$route['logout'] = 'Admin/logout';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
