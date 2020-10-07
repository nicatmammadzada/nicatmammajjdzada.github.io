<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'front'], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/sunipeyktedqiqati', 'PageController@sunipeyk')->name('satellite');
    Route::get('/dtmgenerasiya', 'PageController@dtmgenerasiya')->name('dtm');
    Route::get('/xeriteler', 'PageController@xeriteler')->name('topographic');
    Route::get('/yukseklikardicilligi', 'PageController@yukseklikardicilligi')->name('advanced-elevation');
    Route::get('/qidroqrafiya', 'PageController@qidroqrafiya')->name('qidroqrafiya');
    Route::get('/mark-sheyderskaya', 'PageController@marksheyderskaya')->name('mark-sheyderskaya');

    Route::get('/xidmetler/{slug}', 'PageController@servisDetail')->name('servisDetail');
    Route::get('/mehsullar/{slug}', 'PageController@productDetail')->name('productDetail');
    Route::get('/saheler/{slug}', 'PageController@professionDetail')->name('professionDetail');
    Route::get('/Layiheler/{slug}', 'PageController@projectDetail')->name('projectDetail');



    Route::get('/dannie-raz1', 'PageController@dannieraz1')->name('dannie-raz1');
    Route::get('/dannie-raz2', 'PageController@dannieraz2')->name('dannie-raz2');
    Route::get('/dannie-raz3', 'PageController@dannieraz3')->name('dannie-raz3');
    Route::get('/dannie-raz4', 'PageController@dannieraz4')->name('dannie-raz4');
    Route::get('/dannie-raz5', 'PageController@dannieraz5')->name('dannie-raz5');
    Route::get('/dannie-raz6', 'PageController@dannieraz6')->name('dannie-raz6');

    Route::get('/kaptoqrafiya1', 'PageController@kaptoqrafiya1')->name('kaptoqrafiya1');
    Route::get('/kaptoqrafiya2', 'PageController@kaptoqrafiya2')->name('kaptoqrafiya2');
    Route::get('/kaptoqrafiya3', 'PageController@kaptoqrafiya3')->name('kaptoqrafiya3');
    Route::get('/kaptoqrafiya4', 'PageController@kaptoqrafiya4')->name('kaptoqrafiya4');
    Route::get('/kaptoqrafiya5', 'PageController@kaptoqrafiya5')->name('kaptoqrafiya5');
    Route::get('/kaptoqrafiya6', 'PageController@kaptoqrafiya6')->name('kaptoqrafiya6');

    Route::get('/fotoqrafiya1', 'PageController@fotoqrafiya1')->name('fotoqrafiya1');
    Route::get('/fotoqrafiya2', 'PageController@fotoqrafiya2')->name('fotoqrafiya2');
    Route::get('/fotoqrafiya3', 'PageController@fotoqrafiya3')->name('fotoqrafiya3');

    Route::get('/saheler1', 'PageController@saheler1')->name('saheler1');
    Route::get('/saheler2', 'PageController@saheler2')->name('saheler2');
    Route::get('/saheler3', 'PageController@saheler3')->name('saheler3');
    Route::get('/saheler4', 'PageController@saheler4')->name('saheler4');
    Route::get('/saheler5', 'PageController@saheler5')->name('saheler5');
    Route::get('/saheler6', 'PageController@saheler6')->name('saheler6');
    Route::get('/saheler7', 'PageController@saheler7')->name('saheler7');

    Route::get('/other3d', 'PageController@other3d')->name('other3d');

    Route::get('about', 'PageController@about')->name('about');
    Route::get('team', 'PageController@team')->name('team');
    Route::get('certificates', 'PageController@certificates')->name('certificate');

    Route::get('contact', 'PageController@contact')->name('contact');


});


//Cache clear
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return redirect()->back();
})->name('clear.cache');


//////////


//Back
Route::group(['prefix' => 'admin', 'namespace' => 'back'], function () {

    Route::redirect('/', '/admin/login');

    Route::get('/login', 'AuthController@index')->name('admin.login');
    Route::post('/login', 'AuthController@login')->name('admin.login');
    Route::get('/logout', 'AuthController@logout')->name('admin.logout');


    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', 'HomeController@index')->name('admin');
        /*Dil deyismek*/
        Route::get('/lang/{lang}', 'HomeController@lang')->name('choose.lang');



        /*settings*/


        /*users*/
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index')->name('admin.user');
            Route::get('/create', 'UserController@create')->name('admin.user.create');
            Route::post('/store', 'UserController@store')->name('admin.user.store');
            Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
            Route::post('/{id}/update', 'UserController@update')->name('admin.user.update');
            Route::get('/destroy/{id}', 'UserController@destroy')->name('admin.user.destroy');
            // Route::get('/activation/{activation}', 'UserController@activation')->name('activation');
        });

        /*dil*/
        Route::group(['prefix' => 'dil'], function () {
            Route::get('/', 'DilController@index')->name('dil.list');
            Route::get('/new', 'DilController@new')->name('dil.new');
            Route::post('/add', 'DilController@add')->name('dil.add');
            Route::get('/edit/{id}', 'DilController@edit')->name('dil.edit');
            Route::post('/editor/{id}', 'DilController@editor')->name('dil.editor');
            Route::get('/sil/{id}', 'DilController@sil')->name('dil.sil');
        });

        /*Language lines*/
        Route::group(['prefix' => 'll'], function () {
            Route::get('/', 'LL_Controller@index')->name('ll.list');
            Route::get('/new', 'LL_Controller@new')->name('ll.new');
            Route::post('/add', 'LL_Controller@add')->name('ll.add');
            Route::get('/edit/{id}', 'LL_Controller@edit')->name('ll.edit');
            Route::post('/editor/{id}', 'LL_Controller@editor')->name('ll.editor');
            Route::get('/destroy/{id}', 'LL_Controller@destroy')->name('ll.destroy');
            Route::get('/filter/', 'LL_Controller@filter')->name('ll.filter');
        });


        /*slider*/
        Route::group(['prefix' => 'slider', 'as' => 'admin.'], function () {
            Route::get('/', 'SliderController@index')->name('slider.index');
            Route::post('/add/', 'SliderController@add')->name('slider.add');
            Route::get('/delete/{id}', 'SliderController@delete')->name('slider.delete');
        });


        // PostController with resource
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', 'PostController@index')->name('admin.post');
            Route::get('/create', 'PostController@create')->name('admin.post.create');
            Route::post('/store', 'PostController@store')->name('admin.post.store');
            Route::get('/destroy/{slug}', 'PostController@destroy')->name('admin.post.destroy');
            Route::get('/edit/{slug}', 'PostController@edit')->name('admin.post.edit');
            Route::post('/{slug}/update', 'PostController@update')->name('admin.post.update');
            Route::post('/choose1', 'PostController@choose1')->name('admin.post.choose1');
            Route::post('/choose2', 'PostController@choose2')->name('admin.post.choose2');
            Route::post('/event', 'PostController@event')->name('admin.post.event');
            Route::post('/analitika1', 'PostController@analitika1')->name('admin.post.analitika1');
            Route::post('/analitika2', 'PostController@analitika2')->name('admin.post.analitika2');
            Route::post('/mobile', 'PostController@mobile')->name('admin.post.mobile');
            Route::post('/sem', 'PostController@sem')->name('admin.post.sem');

        });

        Route::group(['prefix' => 'product', 'as' => 'admin.product.'], function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('/create', 'ProductController@create')->name('create');
            Route::post('/store', 'ProductController@store')->name('store');
            Route::get('/promo/{id}', 'ProductController@promo')->name('promo');
            Route::post('/promokod/{id}', 'ProductController@promokod')->name('promokod');
            Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
            Route::post('/update/{id}', 'ProductController@update')->name('update');
            Route::get('/destroy/{id}', 'ProductController@destroy')->name('destroy');
            Route::get('/remove/promo/{id}', 'ProductController@promoDestroy')->name('promoDestroy');
            Route::post('/row', 'ProductController@row')->name('row');
        });


        Route::group(['prefix' => 'team', 'as' => 'admin.team.'], function () {
            Route::get('/', 'TeamController@index')->name('index');
            Route::get('/create', 'TeamController@create')->name('create');
            Route::post('/store', 'TeamController@store')->name('store');
            Route::get('/edit/{id}', 'TeamController@edit')->name('edit');
            Route::post('/update/{id}', 'TeamController@update')->name('update');
            Route::get('/destroy/{id}', 'TeamController@destroy')->name('destroy');
        });



        Route::group(['prefix' => 'profession', 'as' => 'admin.profession.'], function () {
            Route::get('/', 'ProfessionController@index')->name('index');
            Route::get('/create', 'ProfessionController@create')->name('create');
            Route::post('/store', 'ProfessionController@store')->name('store');
            Route::get('/edit/{id}', 'ProfessionController@edit')->name('edit');
            Route::post('/update/{id}', 'ProfessionController@update')->name('update');
            Route::get('/destroy/{id}', 'ProfessionController@destroy')->name('destroy');
        });


        Route::group(['prefix' => 'project', 'as' => 'admin.project.'], function () {
            Route::get('/', 'ProjectController@index')->name('index');
            Route::get('/create', 'ProjectController@create')->name('create');
            Route::post('/store', 'ProjectController@store')->name('store');
            Route::get('/edit/{id}', 'ProjectController@edit')->name('edit');
            Route::post('/update/{id}', 'ProjectController@update')->name('update');
            Route::get('/destroy/{id}', 'ProjectController@destroy')->name('destroy');
        });



        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', 'ContactController@index')->name('admin.contact');
            Route::get('/destroy/{slug}', 'ContactController@destroy')->name('admin.contact.destroy');
        });

        // SubscribeController with resource
        Route::group(['prefix' => 'subscribe'], function () {
            Route::get('/', 'SubscribeController@index')->name('admin.subscribe');
            Route::get('/destroy/{slug}', 'SubscribeController@destroy')->name('admin.subscribe.destroy');
        });


        // AboutController with resource
        Route::group(['prefix' => 'about'], function () {
            Route::get('/', 'AboutController@edit')->name('admin.about');
            Route::post('/update', 'AboutController@store')->name('admin.about.store');
        });

        // DELIVERYController with resource
        Route::group(['prefix' => 'delivery'], function () {
            Route::get('/', 'DeliveryController@edit')->name('admin.delivery');
            Route::post('/update', 'DeliveryController@store')->name('admin.delivery.store');
        });

        // ConfigController with resource
        Route::group(['prefix' => 'config'], function () {
            Route::get('/', 'ConfigController@index')->name('admin.config');
            Route::post('/{id}/update', 'ConfigController@update')->name('admin.config.update');
        });


        Route::group(['prefix' => 'photos', 'as' => 'admin.photo.'], function () {
            Route::get('/', 'PhotoController@index')->name('index');
            Route::get('/edit/{id}', 'PhotoController@edit')->name('edit');
            Route::post('/create', 'PhotoController@create')->name('create');
            Route::get('/remove/{id}', 'PhotoController@remove')->name('remove');
            Route::post('/store/{id}', 'PhotoController@store')->name('store');
        });

        Route::group(['prefix' => 'order', 'as' => 'admin.order.'], function () {
            Route::get('/', 'OrderController@index')->name('index');
            Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
            Route::get('/show/{uid}', 'OrderController@show')->name('show');
            Route::post('/create', 'OrderController@create')->name('create');
            Route::get('/remove/{id}', 'OrderController@remove')->name('remove');
            Route::post('/store/{id}', 'OrderController@store')->name('store');
        });


        Route::group(['prefix' => 'clients', 'as' => 'admin.client.'], function () {
            Route::get('/', 'ClientController@index')->name('index');
            Route::get('/edit/{id}', 'ClientController@edit')->name('edit');
            Route::get('/show/{uid}', 'ClientController@show')->name('show');
            Route::post('/create', 'ClientController@create')->name('create');
            Route::get('/remove/{id}', 'ClientController@remove')->name('remove');
            Route::post('/store/{id}', 'ClientController@store')->name('store');
            Route::post('/mail', 'ClientController@mail')->name('mail');
            Route::get('/filter', 'ClientController@filter')->name('filter');

        });


        Route::group(['prefix' => 'services', 'as' => 'admin.services.'], function () {
            Route::get('/', 'ServicesController@index')->name('index');
            Route::get('/edit/{id}', 'ServicesController@edit')->name('edit');
            Route::get('/create', 'ServicesController@create')->name('create');
            Route::get('/remove/{id}', 'ServicesController@remove')->name('remove');
            Route::post('/store', 'ServicesController@store')->name('store');
            Route::post('/update/{id}', 'ServicesController@update')->name('update');
        });


        Route::group(['prefix' => 'profession', 'as' => 'admin.profession.'], function () {
            Route::get('/', 'ProfessionController@index')->name('index');
            Route::get('/edit/{id}', 'ProfessionController@edit')->name('edit');
            Route::get('/create', 'ProfessionController@create')->name('create');
            Route::get('/remove/{id}', 'ProfessionController@remove')->name('remove');
            Route::post('/store', 'ProfessionController@store')->name('store');
            Route::post('/update/{id}', 'ProfessionController@update')->name('update');
        });


        Route::group(['prefix' => 'category', 'as' => 'admin.category.'], function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::post('/store', 'CategoryController@store')->name('store');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('/update/{id}', 'CategoryController@update')->name('update');
            Route::get('/destroy/{id}', 'CategoryController@destroy')->name('destroy');
        });








    });

});
