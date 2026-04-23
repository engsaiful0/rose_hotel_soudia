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
$route['default_controller'] = 'admin';
$route['sign-in'] = 'welcome';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['home'] = 'Welcome';
$route['adminHome'] = 'Admin_controller';
$route['login-function'] = 'Admin/login_function';
$route['login'] = 'Admin';

$route['project-search'] = 'Admin_controller';


$route['database-backup'] = 'Databasecleaner/database_backup';



$route['sign-in-function'] = 'LoginController/FunctionLogin';
$route['Logout'] = 'LoginController/FunctionLogout';

$route['details-report/(:any)'] = 'ReportController/details_report/$1';


$route['company-setting'] = 'Examples/company_setting';
$route['user-setting'] = 'Examples/user';
$route['drug-list'] = 'Examples/drug_list';
$route['add-year'] = 'Examples/add_year';
$route['add-expense'] = 'Examples/add_expense';
$route['add-late'] = 'Examples/add_late';


$route['expense-report'] = 'ReportController/expense_report';
$route['checkinday-report'] = 'ReportController/checkinday_report';
$route['checkinmonth-report'] = 'ReportController/checkinmonth_report';
$route['credit-report'] = 'ReportController/credit_report';


$route['profession-setting'] = 'Examples/profession_setting';

$route['add-hotel'] = 'Examples/add_hotel';
$route['add-room'] = 'Examples/add_room';
$route['add-room-type'] = 'Examples/add_room_type';
$route['add-bed'] = 'Examples/add_bed';
$route['add-floor'] = 'Examples/add_floor';


$route['checkin-print-month/(:any)'] = 'CheckinController/checkin_print_month/$1';
$route['exit-save'] = 'CheckinController/exit_save';
$route['exit-month-save'] = 'CheckinController/exit_month_save';
$route['renew-save'] = 'CheckinController/renew_save';
$route['renew-month-save'] = 'CheckinController/renew_month_save';

$route['renew-month/(:any)'] = 'CheckinController/renew_month/$1';

$route['start-renew-day/(:any)'] = 'CheckinController/start_renew_day/$1';
$route['start-renew-month/(:any)'] = 'CheckinController/start_renew_month/$1';

$route['renew/(:any)'] = 'CheckinController/renew/$1';
$route['checkin-print/(:any)'] = 'CheckinController/checkin_print_day/$1';
$route['add-check-in'] = 'CheckinController/add_check_in';
$route['add-check-in-save'] = 'CheckinController/add_check_in_save';
$route['add-check-in-edit-save'] = 'CheckinController/add_check_in_edit_save';
$route['add-check-in-month-edit-save'] = 'CheckinController/add_check_in_month_edit_save';

$route['add-check-in-save-month'] = 'CheckinController/add_check_in_save_month';


$route['view-check-in'] = 'CheckinController/view_check_in_day';

$route['add-check-in-month'] = 'CheckinController/add_check_in_month';
$route['view-check-in-month'] = 'CheckinController/view_check_in_month';
$route['add-check-in-save'] = 'CheckinController/add_check_in_save';


$route['checkin-delete/(:any)'] = 'CheckinController/checkin_delete/$1';
$route['checkin-edit/(:any)'] = 'CheckinController/checkin_edit/$1';
$route['checkin-edit-month/(:any)'] = 'CheckinController/checkin_edit_month/$1';


$route['company-setting'] = 'SettingController/company_setting';
$route['company-setting-edit-save'] = 'SettingController/company_setting_edit_save';


$route['ark-gallery'] = 'Examples/ark_gallery';

$route['checkin-report'] = 'ReportController/checkin_report';
$route['admission-report'] = 'ReportController/admission_report';




$route['add-user'] = 'UserController/add_user';
$route['user-save'] = 'UserController/user_save';
$route['view-user'] = 'UserController/view_user';
$route['user-delete/(:any)'] = 'UserController/user_delete/$1';
$route['user-edit/(:any)'] = 'UserController/user_edit/$1';
$route['user-edit-save'] = 'UserController/user_edit_save';







