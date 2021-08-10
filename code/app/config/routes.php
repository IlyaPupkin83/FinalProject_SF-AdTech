<?php

use Core\Router;

//admin GET routes
Router::get('/admin/system', ['Admin'], 'Admin', 'System');
Router::get('/admin/users', ['Admin'], 'Admin', 'Users');
Router::get('/admin/tematic', ['Admin'], 'Admin', 'Tematic');

//advertiser GET routes
Router::get('/advertiser/myoffers', ['Advertiser'], 'Advertiser', 'MyOffers');
Router::get('/advertiser/newoffer', ['Advertiser'], 'Advertiser', 'NewOffer');
Router::get('/advertiser/stats', ['Advertiser'], 'Advertiser', 'Stats');

//webmaster GET routes
Router::get('/webmaster/subscriptions', ['Webmaster'], 'Webmaster', 'Subscriptions');
Router::get('/webmaster/subscribe', ['Webmaster'], 'Webmaster', 'Subscribe');
Router::get('/webmaster/stats', ['Webmaster'], 'Webmaster', 'Stats');

// other
Router::get('/auth', ['Guest'], 'Auth');
Router::get('/registry', ['Guest'], 'Registry');
Router::get('/.*', ['Guest', 'Admin', 'Advertiser', 'Webmaster'], 'Main');

//authorization POST routes
Router::post('signin', ['Guest'], 'Sign', 'In');
Router::post('signup', ['Guest'], 'Sign', 'Up');
Router::post('signout', ['Admin', 'Advertiser', 'Webmaster'], 'Sign', 'Out');
Router::post('RefreshAuth', ['Admin', 'Advertiser', 'Webmaster'], 'RefreshAuth', '');

//admin POST routes
Router::post('admin/users/Ban', ['Admin'], 'Admin/Users', 'Ban');
Router::post('admin/users/Auth', ['Admin'], 'Admin/Users', 'Auth');
Router::post('admin/tematic/New', ['Admin'], 'Admin/Tematic', 'New');
Router::post('admin/tematic/Del', ['Admin'], 'Admin/Tematic', 'Del');
Router::post('admin/system/Stats', ['Admin'], 'Admin/System', 'Stats');

//advertiser POST routes
Router::post('advertiser/offers/enable', ['Advertiser'], 'Advertiser/Offers', 'Enable');
Router::post('advertiser/offers/disable', ['Advertiser'], 'Advertiser/Offers', 'Disable');
Router::post('advertiser/offers/new', ['Advertiser'], 'Advertiser/Offers', 'New');
Router::post('advertiser/stats/show', ['Advertiser'], 'Advertiser/Stats', 'Show');

//webmaster POST routes
Router::post('webmaster/offers/subscribe', ['Webmaster'], 'Webmaster/Offers', 'Subscribe');
Router::post('webmaster/offers/unsubscribe', ['Webmaster'], 'Webmaster/Offers', 'Unsubscribe');
Router::post('webmaster/stats', ['Webmaster'], 'Webmaster/Stats', 'Show');
