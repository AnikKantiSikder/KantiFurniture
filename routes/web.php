<?php

use Illuminate\Support\Facades\Route;



//Frontend routes---------------------------------------------------------------------------------

Route::get('/', 'Frontend\FrontendController@index');

Route::get('/about-us', 'Frontend\FrontendController@aboutUs')->name('about.us');
Route::get('/contact-us', 'Frontend\FrontendController@contactUs')->name('contact.us');
Route::post('/contact-store', 'Frontend\FrontendController@storeContact')->name('contact.store');
Route::get('/shopping-cart', 'Frontend\FrontendController@shoppingCart')->name('shopping.cart');
Route::get('/product-list', 'Frontend\FrontendController@productList')->name('product.list');
Route::get('/product-category/{category_id}', 'Frontend\FrontendController@categoryWiseProduct')
		   ->name('category.wise.product');
Route::get('/product-brand/{brand_id}', 'Frontend\FrontendController@brandWiseProduct')
		   ->name('brand.wise.product');
Route::get('/product-details/{slug}', 'Frontend\FrontendController@productDetails')->name('product.details.info');
Route::post('/find-product', 'Frontend\FrontendController@findProduct')->name('find.product');
Route::get('/get-product', 'Frontend\FrontendController@getProduct')->name('get.product');

//Shopping cart
Route::post('/add-to-cart', 'Frontend\CartController@addToCart')->name('cart.insert');
Route::get('/show-cart', 'Frontend\CartController@showCart')->name('cart.show');
Route::post('/update-cart', 'Frontend\CartController@updateCart')->name('cart.update');
Route::get('/delete-cart/{rowId}', 'Frontend\CartController@deleteCart')->name('cart.delete');

//Customer(log in/signup/billing system)
Route::get('/customer-login', 'Frontend\CheckoutController@customerLogin')->name('customer.login');
Route::get('/customer-signup', 'Frontend\CheckoutController@customerSignup')->name('customer.signup');
Route::post('/customer-signup-store', 'Frontend\CheckoutController@signupStore')->name('signup.store');
Route::get('/customer-email-verify', 'Frontend\CheckoutController@emailVerify')->name('email.verify');
Route::post('/verification-store', 'Frontend\CheckoutController@storeVerification')->name('store.verification');
Route::get('/checkout', 'Frontend\CheckoutController@checkOut')->name('customer.checkout');
Route::post('/checkout-store', 'Frontend\CheckoutController@checkoutStore')->name('customer.checkout.store');

Auth::routes();

//Customer dashboard
Route::group(['middleware'=> ['auth','customer']], function(){

	Route::get('/dashboard', 'Frontend\DashboardController@dashboard')->name('dashboard');

	Route::get('/customer-edit-profile', 'Frontend\DashboardController@editProfile')->name('customer.edit.profile');
	Route::post('/customer-update-profile', 'Frontend\DashboardController@updateProfile')
	           ->name('customer.update.profile');
	Route::get('/customer-password-change', 'Frontend\DashboardController@passwordChange')
	           ->name('customer.password.change');
	Route::post('/customer-password-update', 'Frontend\DashboardController@passwordUpdate')
	           ->name('customer.password.update');
	Route::get('/payment', 'Frontend\DashboardController@payment')->name('customer.payment');
	Route::post('/payment-store', 'Frontend\DashboardController@paymentStore')->name('customer.payment.store');
	Route::get('/order-list', 'Frontend\DashboardController@orderList')->name('customer.order.list');
	Route::get('/order-details/{id}', 'Frontend\DashboardController@orderDetails')->name('customer.order.details');
	Route::get('/order-print/{id}', 'Frontend\DashboardController@orderPrint')->name('customer.order.print');
});








//Backend routes
Route::group(['middleware'=> ['auth','admin'] ], function(){

	//Admin login form
    Route::get('/home', 'HomeController@index')->name('home');

    //Manage user routes
	Route::prefix('users')->group(function(){

		Route::get('/view','Backend\UserController@view')->name('users.view');
		Route::get('/add','Backend\UserController@add')->name('users.add');
		Route::post('/store','Backend\UserController@store')->name('users.store');
		Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
		Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
		Route::get('/delete/{id}','Backend\UserController@delete')->name('users.delete');
	});

	//Manage profile routes
	Route::prefix('profiles')->group(function(){

		Route::get('/view','Backend\ProfileController@view')->name('profiles.view');
		Route::get('/edit','Backend\ProfileController@edit')->name('profiles.edit');
		Route::post('/update','Backend\ProfileController@update')->name('profiles.update');
		Route::get('/change/password','Backend\ProfileController@changePassword')->name('profiles.password.change');
		Route::post('/update/password','Backend\ProfileController@updatePassword')->name('profiles.password.update');
	});

	//Logo management routes
	Route::prefix('logos')->group(function(){

		Route::get('/view','Backend\LogoController@view')->name('logos.view');
		Route::get('/add','Backend\LogoController@add')->name('logos.add');
		Route::post('/store','Backend\LogoController@store')->name('logos.store');
		Route::get('/edit/{id}','Backend\LogoController@edit')->name('logos.edit');
		Route::post('/update/{id}','Backend\LogoController@update')->name('logos.update');
		Route::get('/delete/{id}','Backend\LogoController@delete')->name('logos.delete');
	});

	//Slider management routes
	Route::prefix('sliders')->group(function(){

		Route::get('/view','Backend\SliderController@view')->name('sliders.view');
		Route::get('/add','Backend\SliderController@add')->name('sliders.add');
		Route::post('/store','Backend\SliderController@store')->name('sliders.store');
		Route::get('/edit/{id}','Backend\SliderController@edit')->name('sliders.edit');
		Route::post('/update/{id}','Backend\SliderController@update')->name('sliders.update');
		Route::get('/delete/{id}','Backend\SliderController@delete')->name('sliders.delete');
	});

	//Contact routes
	Route::prefix('contacts')->group(function(){

		Route::get('/view','Backend\ContactController@view')->name('contacts.view');
		Route::get('/add','Backend\ContactController@add')->name('contacts.add');
		Route::post('/store','Backend\ContactController@store')->name('contacts.store');
		Route::get('/edit/{id}','Backend\ContactController@edit')->name('contacts.edit');
		Route::post('/update/{id}','Backend\ContactController@update')->name('contacts.update');
		Route::get('/delete/{id}','Backend\ContactController@delete')->name('contacts.delete');
		Route::get('/view/communicate','Backend\ContactController@viewCommunicate')->name('contacts.communicate');
		Route::get('/delete/communicate/{id}','Backend\ContactController@deleteCommunicate')->name('communicates.delete');
	});

	//About us routes
	Route::prefix('abouts')->group(function(){

		Route::get('/view','Backend\AboutController@view')->name('abouts.view');
		Route::get('/add','Backend\AboutController@add')->name('abouts.add');
		Route::post('/store','Backend\AboutController@store')->name('abouts.store');
		Route::get('/edit/{id}','Backend\AboutController@edit')->name('abouts.edit');
		Route::post('/update/{id}','Backend\AboutController@update')->name('abouts.update');
		Route::get('/delete/{id}','Backend\AboutController@delete')->name('abouts.delete');
	});

	//Manage category routes
	Route::prefix('categories')->group(function(){

		Route::get('/view','Backend\CategoryController@view')->name('categories.view');
		Route::get('/add','Backend\CategoryController@add')->name('categories.add');
		Route::post('/store','Backend\CategoryController@store')->name('categories.store');
		Route::get('/edit/{id}','Backend\CategoryController@edit')->name('categories.edit');
		Route::post('/update/{id}','Backend\CategoryController@update')->name('categories.update');
		Route::get('/delete/{id}','Backend\CategoryController@delete')->name('categories.delete');
	});

	//Manage brand routes
	Route::prefix('brands')->group(function(){

		Route::get('/view','Backend\BrandController@view')->name('brands.view');
		Route::get('/add','Backend\BrandController@add')->name('brands.add');
		Route::post('/store','Backend\BrandController@store')->name('brands.store');
		Route::get('/edit/{id}','Backend\BrandController@edit')->name('brands.edit');
		Route::post('/update/{id}','Backend\BrandController@update')->name('brands.update');
		Route::get('/delete/{id}','Backend\BrandController@delete')->name('brands.delete');	
	});

	//Manage color routes
	Route::prefix('colors')->group(function(){

		Route::get('/view','Backend\ColorController@view')->name('colors.view');
		Route::get('/add','Backend\ColorController@add')->name('colors.add');
		Route::post('/store','Backend\ColorController@store')->name('colors.store');
		Route::get('/edit/{id}','Backend\ColorController@edit')->name('colors.edit');
		Route::post('/update/{id}','Backend\ColorController@update')->name('colors.update');
		Route::get('/delete/{id}','Backend\ColorController@delete')->name('colors.delete');
	});

	//Manage size routes
	Route::prefix('sizes')->group(function(){

		Route::get('/view','Backend\SizeController@view')->name('sizes.view');
		Route::get('/add','Backend\SizeController@add')->name('sizes.add');
		Route::post('/store','Backend\SizeController@store')->name('sizes.store');
		Route::get('/edit/{id}','Backend\SizeController@edit')->name('sizes.edit');
		Route::post('/update/{id}','Backend\SizeController@update')->name('sizes.update');
		Route::get('/delete/{id}','Backend\SizeController@delete')->name('sizes.delete');
	});

	//Manage product routes
	Route::prefix('products')->group(function(){

		Route::get('/view','Backend\ProductController@view')->name('products.view');
		Route::get('/add','Backend\ProductController@add')->name('products.add');
		Route::post('/store','Backend\ProductController@store')->name('products.store');
		Route::get('/edit/{id}','Backend\ProductController@edit')->name('products.edit');
		Route::post('/update/{id}','Backend\ProductController@update')->name('products.update');
		Route::get('/delete/{id}','Backend\ProductController@delete')->name('products.delete');
		Route::get('/details/{id}','Backend\ProductController@details')->name('products.details');
	});

	//Manage product routes
	Route::prefix('customers')->group(function(){

		Route::get('/view','Backend\CustomerController@view')->name('customers.view');
		Route::get('/draft/view','Backend\CustomerController@draftView')->name('customers.draft.view');
		Route::get('/delete/{id}','Backend\CustomerController@delete')->name('customers.delete');
	});

	//Manage orders routes
	Route::prefix('orders')->group(function(){

		Route::get('/pending/list','Backend\OrderController@pendingList')->name('orders.pending.list');
		Route::get('/approved/list','Backend\OrderController@approvedList')->name('orders.approved.list');
        Route::get('/order/details/{id}','Backend\OrderController@details')->name('orders.details');
        Route::get('/approve/{id}','Backend\OrderController@approveOrder')->name('orders.approve');
	});

});




