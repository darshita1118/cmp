<?php

use CodeIgniter\Router\RouteCollection;

$routes->set404Override(static function () {
    return view('error_404');
});
/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('error_404', 'Home::error_404');
// $routes->get('signin', 'Home::signin');
// $routes->get('dashboard', 'Home::dashboard');
// $routes->get('allleads', 'Home::allleads');
// $routes->get('createleads', 'Home::createleads');
// $routes->get('bulkuplead', 'Home::bulkuplead');
// $routes->get('allocatedleads', 'Home::allocatedleads');
// $routes->get('unallocatedleads', 'Home::unallocatedleads');
// $routes->get('selfassignleads', 'Home::selfassignleads');
// $routes->get('allcounselor', 'Home::allcounselor');
// $routes->get('createcounselor', 'Home::createcounselor');
// $routes->get('allstatus', 'Home::allstatus');
// $routes->get('createstatus', 'Home::createstatus');
// $routes->get('allsource', 'Home::allsource');
// $routes->get('createsource', 'Home::createsource');
// $routes->get('processapp', 'Home::processapp');
// $routes->get('loghiscou', 'Home::loghiscou');
// $routes->get('loghisadm', 'Home::loghisadm');
// $routes->get('reportstats', 'Home::reportstats');

// $routes->get('test', 'Home::test');

// login route admin and Handler
$routes->match(['get', 'post'], '/', 'Login::index');
$routes->match(['get', 'post'], '/super-login', 'Login::admin');

$routes->match(['get', 'post'], '/forget-password', 'Login::forget_password');
$routes->match(['get', 'post'], '/forget-password/success', 'Login::forget_password');
$routes->match(['get', 'post'], '/reset-password/(:any)', 'Login::reset_password/$1');


$routes->match(['get', 'post'], '/apply-now', 'Student::apply_now');
$routes->group('api', function ($routes) {
    $routes->match(['get', 'post'], 'apply-now', 'Student::apply_now');
    //$routes->add('blog', 'Admin\Blog::index');
});

$routes->match(['post'], '/payment-initiated/(:num)/(:num)', 'Payment::index/$1/$2');
$routes->match(['get', 'post'], '/payment/response', 'Payment::response');
$routes->match(['get', 'post'], '/payment/request', 'Payment::request');
$routes->match(['get', 'post'], '/payment/success', 'Payment::success');
$routes->match(['get', 'post'], '/payment/fail', 'Payment::fail');
