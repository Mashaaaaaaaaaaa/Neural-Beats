<?php
//Janko Kitanovic
defined('BASEPATH') OR exit('No direct script access allowed');

$route['korisnik/(:any)'] = 'korisnik/view';
$route['korisnik'] = 'korisnik/view';
$route['default_controller'] = 'gost/view';
$route['(:any)'] = 'gost/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
