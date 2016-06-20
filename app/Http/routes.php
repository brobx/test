<?php

$locale = \Request::segment(1);

Route::group(['prefix' => $locale, 'middleware' => 'web'], function () {

    // Site Admin Routes
    Route::group(['prefix' => 'backend/admin', 'as' => 'backend.admin.', 'middleware' => 'role:admin'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Admin\PagesController@index'
        ]);

        Route::get('transactions', [
            'as' => 'transactions.index',
            'uses' => 'Admin\TransactionsController@index'
        ]);

        Route::resource('corporates', 'Admin\CorporatesController');
        Route::patch('corporates/{corporates}/suspend', [
            'as' => 'corporates.suspend',
            'uses' => 'Admin\CorporatesController@suspend'
        ]);
        Route::patch('corporates/{corporates}/discount', [
            'as' => 'corporates.discount',
            'uses' => 'Admin\CorporatesController@updateDiscount'
        ]);
        Route::patch('corporates/{corporates}/{services}/commission', [
            'as' => 'corporates.services.commission',
            'uses' => 'Admin\CorporatesController@updateCommission'
        ]);

        Route::resource('users', 'Admin\UsersController');
        Route::patch('users/{users}/suspend', [
            'as' => 'users.suspend',
            'uses' => 'Admin\UsersController@suspend'
        ]);

        Route::resource('posts', 'Admin\PostsController');
        Route::resource('faq-categories', 'Admin\FAQCategoriesController', ['except' => 'show']);
        Route::resource('faqs', 'Admin\FAQsController', ['except' => 'show']);

        Route::get('listings', [
            'as' => 'listings.index',
            'uses' => 'Admin\ListingsController@index'
        ]);
        Route::post('listings/{listings}/feature', [
            'as' => 'listings.feature',
            'uses' => 'Admin\ListingsController@feature'
        ]);

        Route::resource('advertisements', 'Admin\AdsController');
        Route::post('images', [
            'as' => 'images.add',
            'uses' => 'Admin\ImagesController@add'
        ]);
        Route::delete('images', [
            'as' => 'images.remove',
            'uses' => 'Admin\ImagesController@remove'
        ]);
        Route::post('images/slider', [
            'as' => 'images.slider',
            'uses' => 'Admin\ImagesController@addToSlider'
        ]);

        Route::get('learn', [
            'as' => 'learn',
            'uses' => 'Admin\PagesController@learn'
        ]);

        Route::patch('learn/{services}/video', [
            'as' => 'learn.services.video.update',
            'uses' => 'Admin\ServicesController@updateVideo'
        ]);

        Route::get('corporate-types', [
            'as' => 'corporate-types.index',
            'uses' => 'Admin\PagesController@corporateTypes'
        ]);

        Route::resource('learn/{services}/photos', 'Admin\SlidesController', ['as' => 'learn']);
        Route::resource('learn/{services}/topics', 'Admin\TopicsController', ['as' => 'learn']);
        Route::resource('corporate-types/{industries}/photos', 'Admin\CorporateTypeSlidesController', ['as' => 'corporate-types']);

        Route::get('invoices', [
            'as' => 'invoices.index',
            'uses' => 'Admin\InvoicesController@index'
        ]);
        Route::patch('invoices/{invoices}', [
            'as' => 'invoices.update',
            'uses' => 'Admin\InvoicesController@update'
        ]);
        Route::get('logs', [
            'as' => 'logs.index',
            'uses' => 'Admin\LogsController@index'
        ]);
        Route::delete('logs', [
            'as' => 'logs.destroy',
            'uses' => 'Admin\LogsController@destroy'
        ]);
        Route::get('billing', [
            'as' => 'billing.index',
            'uses' => 'Admin\BillingController@index'
        ]);
    });

    // Corporate Admin Routes.
    Route::group(['prefix' => 'backend/corporate', 'as' => 'backend.corporate.', 'middleware' => 'role:corporate-user'], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'Corporate\PagesController@index'
        ]);
        Route::get('transactions', [
            'as' => 'transactions.index',
            'uses' => 'Admin\TransactionsController@index'
        ]);
        Route::get('details', [
            'as' => 'details.index',
            'uses' => 'Corporate\DetailsController@getDetails'
        ]);
        Route::post('details', [
            'as' => 'details.save',
            'uses' => 'Corporate\DetailsController@save'
        ]);
        Route::resource('users', 'Corporate\UsersController');

        Route::patch('users/{users}/suspend', [
            'as' => 'users.suspend',
            'uses' => 'Corporate\UsersController@suspend'
        ]);

        Route::resource('branches', 'Corporate\BranchesController');

        Route::get('settings/profile', [
            'as' => 'settings.profile',
            'uses' => 'Corporate\SettingsController@getProfile'
        ]);
        Route::post('settings/profile', [
            'as' => 'settings.profile.save',
            'uses' => 'Corporate\SettingsController@postProfile'
        ]);
        Route::post('images', [
            'as' => 'images.add',
            'uses' => 'Corporate\ImagesController@add'
        ]);
        Route::delete('images/{name}', [
            'as' => 'images.remove',
            'uses' => 'Corporate\ImagesController@remove'
        ]);
        Route::post('images/slider', [
            'as' => 'images.slider',
            'uses' => 'Corporate\ImagesController@addToSlider'
        ]);
        Route::resource('sliders', 'Corporate\SliderController', ['except' => ['show']]);
        Route::resource('services/{services}/listings', 'Corporate\ListingsController', [
            'except' => ['show'],
            'names' => [
                'index' => 'listings.index',
                'create' => 'listings.create',
                'store' => 'listings.store',
                'edit' => 'listings.edit',
                'update' => 'listings.update',
                'destroy' => 'listings.destroy',
            ]
        ]);
        Route::get('services/{services}/listings/{listings}/duplicate', [
            'as' => 'listings.duplicate',
            'uses' => 'Corporate\ListingsController@duplicate'
        ]);
        Route::get('listings/sponsored', [
            'as' => 'listings.sponsored',
            'uses' => 'Corporate\ListingsController@sponsored'
        ]);

        Route::get('data/requests', [
            'as' => 'data.requests.index',
            'uses' => 'Corporate\DataController@index'
        ]);

        Route::get('data/requests/{pendingData}', [
            'as' => 'data.requests.show',
            'uses' => 'Corporate\DataController@show'
        ]);

        Route::post('data/requests/{pendingData}', [
            'as' => 'data.requests.approve',
            'uses' => 'Corporate\DataController@approve'
        ]);

        Route::delete('data/requests/{pendingData}', [
            'as' => 'data.requests.deny',
            'uses' => 'Corporate\DataController@deny'
        ]);

        Route::get('leads', [
            'as' => 'leads.index',
            'uses' => 'Corporate\LeadsController@index'
        ]);

        Route::get('advertisements', [
            'as' => 'advertisements.index',
            'uses' => 'Corporate\AdsController@index'
        ]);

        Route::get('notifications', [
            'as' => 'notifications.index',
            'uses' => 'Corporate\NotificationsController@index'
        ]);

        Route::patch('notifications/{notifications}/read', [
            'as' => 'notifications.read',
            'uses' => 'Corporate\NotificationsController@read'
        ]);
        Route::get('invoices', [
            'as' => 'invoices.index',
            'uses' => 'Corporate\InvoicesController@index'
        ]);
        Route::get('invoices/{invoices}', [
            'as' => 'invoices.show',
            'uses' => 'Corporate\InvoicesController@show'
        ]);
        Route::get('invoices/{invoices}/print', [
            'as' => 'invoices.print',
            'uses' => 'Corporate\InvoicesController@getPrint'
        ]);
        Route::group(['prefix' => 'api'], function () {

            Route::get('stats/types', [
                'as' => 'api.stats.types',
                'uses' => 'Corporate\API\StatsController@types'
            ]);

            Route::get('stats/leads', [
                'as' => 'api.stats.leads',
                'uses' => 'Corporate\API\StatsController@leads'
            ]);
        });
    });

    // Frontend
    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);

    Route::get('/login/facebook', [
        'uses' => 'Auth\AuthController@getSocialAuth',
        'as' => 'auth.getSocialAuth'
    ]);

    Route::get('/login/callback/facebook', [
        'uses' => 'Auth\AuthController@getSocialAuthCallback',
        'as' => 'auth.getSocialAuthCallback'
    ]);

    Route::auth();

    Route::get('corporates/{corporate}', [
        'as' => 'corporates.show',
        'uses' => 'CorporatesController@show'
    ]);

    Route::get('services/{services}/listings', [
        'as' => 'services.listings',
        'uses' => 'ServicesController@listings'
    ]);

    Route::get('services/{services}/comparison', [
        'middleware' => 'auth',
        'as' => 'services.comparison',
        'uses' => 'ServicesController@comparison'
    ]);

    Route::get('list', function () {
        return view('list');
    });

    Route::get('about', [
        'as' => 'about',
        'uses' => 'PagesController@about'
    ]);

    Route::get('contact', [
        'as' => 'contact',
        'uses' => 'PagesController@contact'
    ]);

    Route::post('contact/send', [
        'as' => 'contact.send',
        'uses' => 'PagesController@sendInquiry'
    ]);

    Route::get('travelBooking', function () {
        return view('travelBooking');
    });

    Route::get('thanks', function () {
        return view('thanks');
    });

    Route::get('tools', [
        'as' => 'tools.index',
        'uses' => 'ToolsController@index'
    ]);

    Route::get('tools/budget', [
        'as' => 'tools.budget.index',
        'uses' => 'ToolsController@getBudget'
    ]);

    Route::post('api/tools/budget', [
        'as' => 'api.tools.budget.calculate',
        'uses' => 'ToolsController@postBudget'
    ]);

    Route::get('tos', [
        'as' => 'tos',
        'uses' => 'PagesController@terms'
    ]);

    Route::get('privacy', [
        'as' => 'privacy',
        'uses' => 'PagesController@privacy'
    ]);

    Route::get('news', [
        'as' => 'news.index',
        'uses' => 'NewsController@index'
    ]);

    Route::get('news/categories/{categories}', [
        'as' => 'news.category.index',
        'uses' => 'NewsController@indexCategory'
    ]);

    Route::get('news/{id}', [
        'as' => 'news.show',
        'uses' => 'NewsController@show'
    ]);

    Route::get('learn', [
        'as' => 'learn.index',
        'uses' => 'LearnController@index'
    ]);

    Route::get('learn/{services}', [
        'as' => 'learn.show',
        'uses' => 'LearnController@show'
    ]);

    Route::get('partners', [
        'as' => 'partners.index',
        'uses' => 'PagesController@partners'
    ]);

    Route::get('how-it-works', [
        'as' => 'howitworks.index',
        'uses' => 'PagesController@howItWorks'
    ]);

    Route::get('help', [
        'as' => 'help.index',
        'uses' => 'FaqController@index'
    ]);

    Route::get('help/search', [
        'as' => 'help.search',
        'uses' => 'FaqController@search'
    ]);

    Route::get('help/{faqs}', [
        'as' => 'help.show',
        'uses' => 'FaqController@show'
    ]);

    Route::get('listings/{listings}', [
        'as' => 'listing.show',
        'uses' => 'ListingsController@show'
    ]);

    Route::get('listings/{listings}/apply', [
        'as' => 'listing.getApply',
        'uses' => 'ListingsController@getApply'
    ]);

    Route::post('listings/{listings}/apply', [
        'middleware' => 'auth',
        'as' => 'listing.apply',
        'uses' => 'ListingsController@postApply'
    ]);

    Route::get('listings/{listings}/buy', [
        'middleware' => 'auth',
        'as' => 'listing.buy',
        'uses' => 'PaymentController@buy'
    ]);

    Route::get('listings/{listings}/pay', [
        'middleware' => 'auth',
        'as' => 'listing.pay',
        'uses' => 'PaymentController@choice'
    ]);

    Route::post('listings/{listings}/pay', [
        'middleware' => 'auth',
        'as' => 'listing.pay',
        'uses' => 'PaymentController@agency'
    ]);

    Route::get('callback/payfort', [
        'middleware' => 'auth',
        'as' => 'listing.buy.charge',
        'uses' => 'PaymentController@callback'
    ]);

    Route::get('listings/{listings}/apply/completed', [
        'middleware' => 'auth',
        'as' => 'listing.apply.completed',
        'uses' => 'ListingsController@getCompleted'
    ]);

    Route::get('listings/{listings}/rate', [
        'middleware' => 'auth',
        'as' => 'listing.getRate',
        'uses' => 'ListingsController@getRate'
    ]);

    Route::post('listings/{listings}/rate', [
        'middleware' => 'auth',
        'as' => 'listing.postRate',
        'uses' => 'ListingsController@postRate'
    ]);

    Route::post('listings/{listings}/compare', [
        'middleware' => 'auth',
        'as' => 'listing.compare.add',
        'uses' => 'ListingsController@compareListing'
    ]);

    Route::delete('listings/{listings}/remove', [
        'middleware' => 'auth',
        'as' => 'listing.compare.remove',
        'uses' => 'ListingsController@removeFromComparison'
    ]);

    Route::get('out/{id}', [
        'as' => 'out',
        function (App\Advertisement $ad, $id) {
            return $ad->out($id);
        }
    ]);

    Route::get('account', [
        'as' => 'account.index',
        'uses' => 'AccountController@index'
    ]);

    Route::patch('account/profile', [
        'as' => 'account.profile.update',
        'uses' => 'AccountController@updateProfile'
    ]);

    Route::patch('account/interests', [
        'as' => 'account.interests.update',
        'uses' => 'AccountController@updateInterests'
    ]);

    Route::patch('account/preferences', [
        'as' => 'account.preferences.update',
        'uses' => 'AccountController@updatePreferences'
    ]);

    Route::get('account/applications/{leads}/cancel', [
        'as' => 'account.applications.cancel',
        'uses' => 'AccountController@cancelLead'
    ]);

    Route::get('account/change-password', [
        'as' => 'account.changePassword',
        'uses' => 'AccountController@security'
    ]);

    Route::patch('account/password/update', [
        'as' => 'account.password.update',
        'uses' => 'AccountController@changePassword'
    ]);

    Route::get('{industries}', [
        'as' => 'industries.show',
        'uses' => 'HomeController@industry'
    ]);
});
