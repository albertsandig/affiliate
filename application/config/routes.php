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
$route['default_controller'] = 'Raffle';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['home'] = 'Welcome';



/*	ERROR PAGE */
$route['admin/error'] = 'admin/User/adBlock_error';
$route['admin/access_error'] = 'admin/User/access_error';
$route['error'] = 'Raffle/adblock';


/* Credential Routes */
$route['register'] = 'Credential/register';
$route['register/(:num)'] = 'Credential/register/$1';
$route['register/create'] = 'Credential/insert';
$route['register/send_verification'] = 'Credential/send_verification';
$route['verify/(:num)/(:any)'] = 'Credential/verify_user/$1/$2';

$route['login'] = 'Credential/login';
$route['check_login'] = 'Credential/login_user';

/*	USER PAGES Routes */
$route['admin'] = 'admin/User/index';
$route['admin/guide'] = 'admin/User/guide';
$route['admin/account'] = 'admin/User/account';
$route['admin/update'] = 'admin/User/update_account';
$route['admin/withdraw'] = 'admin/User/withdraw';
$route['admin/converter'] = 'admin/User/converter';
$route['admin/payment_request'] = 'admin/User/user_payment_request';


/* USER PROCESS */
$route['admin/update_credential'] = 'admin/Process/update_credential';
$route['admin/request_w'] = 'admin/Process/request_withdrawal';
$route['admin/approve_withdrawal'] = 'admin/Process/approve_withdrawal';


/*	DASHBOARD DATA */
$route['admin/data_occ'] = 'admin/User/data_occ';
$route['admin/data_dcc'] = 'admin/User/data_dcc';

/******************************************************
	Module Routes
	Default : 
	$route['admin/mod/$module_name']  = 'admin/modules/mod_folderName/class';
	OR
	$route['admin/mod/$module_name']  = 'admin/modules/mod_folderName/class/function';
*******************************************************/
/*  REWARD MODULE ROUTE */
$route['admin/mod/reward'] = 'admin/modules/mod_reward/reward';
$route['admin/mod/reward/claim_points'] = 'admin/modules/mod_reward/reward/points';
$route['admin/mod/reward/claim_money'] = 'admin/modules/mod_reward/reward/money';

/*  CLICK ADS MODULE ROUTE */
$route['admin/mod/ads'] = 'admin/modules/mod_click_ads/Click_ads';
$route['admin/mod/ads/contribute/(:any)'] = 'admin/modules/mod_click_ads/Click_ads/click_ads/$1';
$route['admin/mod/ads/miner_ads'] = 'admin/modules/mod_click_ads/Click_ads/miner_ads';
$route['admin/mod/ads/xsa_ytysa'] = 'admin/modules/mod_click_ads/Click_ads/xsa_ytysa';

$route['admin/mod/ads/list'] = 'admin/modules/mod_click_ads/Click_ads_admin';
$route['admin/mod/ads/create'] = 'admin/modules/mod_click_ads/Click_ads_admin/create';
$route['admin/mod/ads/update/(:num)'] = 'admin/modules/mod_click_ads/Click_ads_admin/update/$1';
$route['admin/mod/ads/process'] = 'admin/modules/mod_click_ads/Click_ads_admin/process';

/*  QUIZ MODULE ROUTE */
$route['admin/mod/quiz'] = 'admin/modules/mod_quiz/quiz';
$route['admin/mod/quiz/create'] = 'admin/modules/mod_quiz/quiz/create';
$route['admin/mod/quiz/participate'] = 'admin/modules/mod_quiz/quiz/participate';
$route['admin/mod/quiz/question/(:num)'] = 'admin/modules/mod_quiz/quiz/question/$1';


/*   RAFFLE MODULE */
$route['raffle'] = 'Raffle';
$route['raffle/view/(:num)'] = 'Raffle/raffle/$1';
$route['raffle/participate'] = 'Raffle/participate';
$route['admin/mod/raffle/list'] = 'admin/modules/mod_raffle/raffle/index';
$route['admin/mod/raffle/create'] = 'admin/modules/mod_raffle/raffle/create';
$route['admin/mod/raffle/update/(:num)'] = 'admin/modules/mod_raffle/raffle/update/$1';
$route['admin/mod/raffle/save'] = 'admin/modules/mod_raffle/raffle/save';

