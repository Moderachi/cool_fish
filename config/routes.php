<?php

return array(

    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
    'product/delProductAjax/([0-9]+)' => 'product/delProductAjax/$1',
    'product/editProductAjax/([0-9]+)' => 'admin/editProductAjax/$1',
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // actionIndex в CatalogController
    'catalog' => 'catalog/index', // actionIndex в CatalogController


    'category/delCategoryAjax/([0-9]+)' => 'admin/delCategoryAjax/$1',
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController   

    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/register' => 'user/register',
    'user/delFeedbackAjax/([0-9]+)' => 'user/delFeedbackAjax/$1',

    'cabinet/changePassword' => 'user/changePassword',
    'cabinet/history' => 'user/history',
    'cabinet/delUser' => 'user/delUser',
    'cabinet' => 'user/cabinet',

    'feedback' => 'user/feedback', // actionFeedback в UserController

    'cart/del/([0-9]+)' => 'cart/delProductOutCart/$1',
    'cart/reduce/([0-9]+)' => 'cart/reduceAjax/$1',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/checkout' => 'cart/checkout',
    'cart' => 'cart/index',
    
    'admin/historyItem/([0-9]+)' => 'admin/historyItem/$1',
    'admin/history' => 'admin/history',
    'admin/changePassword' => 'admin/changePassword',
    'admin/addAdmin' => 'admin/addAdmin',
    'admin/delAdmin' => 'admin/delAdmin',
    'admin/delAdminAjax/([0-9]+)' => 'admin/delAdminAjax/$1',
    'admin/addAdminAjax/([0-9]+)' => 'admin/addAdminAjax/$1',
    'admin/addProduct' => 'admin/addProduct',
    'admin/editProduct' => 'admin/editProduct',
    'admin/addCategory' => 'admin/addCategory',
    'admin/editCategory' => 'admin/editCategory',
    'admin' => 'admin/index',


    'about_us' => 'site/about', // actionAbout в SiteController
	'contacts' => 'site/contacts', // actionDelivery в SiteController




    '' => 'site/index', // actionIndex в SiteController
    
);