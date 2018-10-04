<?php

use Lava\Http\Controllers\Admin\FileController     as AdminFile;
use Lava\Http\Controllers\Admin\UserController     as AdminUser;
use Lava\Http\Controllers\Admin\ErrorController    as AdminError;
use Lava\Http\Controllers\Admin\HomeController     as AdminHome;
use Lava\Http\Controllers\Admin\PostController     as AdminPost;
use Lava\Http\Controllers\Admin\CategoryController as AdminCategory;
use Lava\Http\Controllers\Admin\ServiceController  as AdminService;
use Lava\Http\Controllers\Admin\ProductController  as AdminProduct;
use Lava\Http\Controllers\Admin\OrderController    as AdminOrder;
use Lava\Http\Controllers\User\HomeController      as UserHome;
use Lava\Http\Controllers\User\ProfileController   as UserProfile;
use Lava\Http\Controllers\Site\PageController      as SitePage;
use Lava\Http\Controllers\Site\PostController      as SiteBlog;
use Lava\Http\Controllers\Site\ProductController   as SiteProduct;
use Lava\Http\Controllers\User\CartController      as UserCart;


Route::get( '/', 'Site\PageController@getHomepage')->name('home');
/**
 * Lava\Http\Controllers\Auth
 */
Auth::routes();

/**
 * Lava\Http\Controllers\Admin\HomeController
 */
AdminHome::routes();

/**
 * Lava\Http\Controllers\Admin\ErrorController
 */
AdminError::routes();
/**
 * Lava\Http\Controllers\Admin\FileController
 */
AdminFile::routes();

/**
 * Lava\Http\Controllers\Admin\UserController
 */
AdminUser::routes();

/**
 * Lava\Http\Controllers\Admin\PostController
 */
AdminPost::routes();

/**
 * Lava\Http\Controllers\Admin\CategoryController
 */
AdminCategory::routes();

/**
 * Lava\Http\Controllers\Admin\ServiceController
 */
AdminService::routes();

/**
 * Lava\Http\Controllers\Admin\ProductController
 */
AdminProduct::routes();
/**
 * Lava\Http\Controllers\Admin\OrderController
 */
AdminOrder::routes();

/**
 * Lava\Http\Controllers\User\HomeController
 */
UserHome::routes();

/**
 * Lava\Http\Controllers\User\ProfileController
 */
UserProfile::routes();

/**
 * Lava\Http\Controllers\Site\PageController
 */
SitePage::routes();

/**
 * Lava\Http\Controllers\Site\PostController
 */
SiteBlog::routes();

/**
 * Lava\Http\Controllers\Site\ProductController
 */
SiteProduct::routes();

/**
 * Lava\Http\Controllers\User\CartController
 */
UserCart::routes();
