<?php

$route['feedworld'] = 'feedworld/admin/dashboard';
$route['feedworld/summary'] = 'feedworld/admin/dashboard';
$route['feedworld/summary/permissions'] = 'feedworld/admin/dashboard/permissions';
$route['admin'] = 'feedworld/admin/dashboard';
$route['admin/site'] = 'feedworld/admin/site';
$route['admin/dashboard'] = 'feedworld/admin/dashboard';
$route['admin/dashboard/(.*)'] = 'feedworld/admin/dashboard/$1';
$route['admin/login'] = 'feedworld/admin/login';
$route['admin/login/(.*)'] = 'feedworld/admin/login/$1';
$route['admin/logout'] = 'feedworld/admin/logout';
$route['admin/logout/(.*)'] = 'feedworld/admin/logout/$1';
$route['admin/stats'] = 'feedworld/admin/stats';
$route['admin/stats/(:num)'] = 'feedworld/admin/stats/$1';
$route['admin/tracking'] = 'feedworld/admin/tracking';
$route['admin/tracking_ajax'] = 'feedworld/admin/tracking_ajax';
$route['admin/activity'] = 'feedworld/admin/activity';
$route['admin/activity_ajax'] = 'feedworld/admin/activity_ajax';
$route['admin/backup'] = 'feedworld/admin/backup';

?>