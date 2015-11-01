<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['statements/most_popular'] = "statements/most_popular";
$route['statements/most_recent'] = "statements/most_recent";
$route['statements/search'] = "statements/search_value";
$route['statements/search/(:any)'] = "statements/search_2";
$route['statements/vote']=	"statements/vote";
$route['statements/say'] = "statements/say";
$route['statements/search_2/(:any)'] = "statements/search_2";
$route['view_statements/(:any)'] = "statements/view_statements/$1";
$route['statements/about']	=	"statements/about";
$route['default_controller'] = "statements";
//$route['statements'] = "statements";

$route['post'] = "pages/post";
$route['pages/post'] = "pages/post";
$route['about'] = "pages/about";
$route['pages/search_2'] = "pages/search_value";
$route['pages/search_2/(:any)'] = "pages/search_2";
$route['pages/plus'] = "pages/plus";
$route['pages/(:any)'] = "pages/view/$1";
$route['pages'] = "pages";
//$route['default_controller'] = "pages/index";


/* End of file routes.php */
/* Location: ./application/config/routes.php */