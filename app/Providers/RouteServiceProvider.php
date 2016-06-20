<?php

namespace App\Providers;

use App\Advertisement;
use App\Corporate;
use App\CorporateBranch;
use App\CorporateSlider;
use App\CorporateType;
use App\FAQ;
use App\FAQCategory;
use App\Invoice;
use App\Lead;
use App\Listing;
use App\Notification;
use App\PendingData;
use App\Photo;
use App\Post;
use App\PostCategory;
use App\Service;
use App\Topic;
use App\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->model('corporates', Corporate::class);
        $router->model('users', User::class);
        $router->model('branches', CorporateBranch::class);
        $router->model('sliders', CorporateSlider::class);
        $router->model('services', Service::class);
        $router->model('listings', Listing::class);
        $router->model('pendingData', PendingData::class);
        $router->model('posts', Post::class);
        $router->model('faqs', FAQ::class);
        $router->model('faq-categories', FAQCategory::class);
        $router->model('advertisements', Advertisement::class);
        $router->model('photos', Photo::class);
        $router->model('topics', Topic::class);
        $router->model('notifications', Notification::class);
        $router->model('leads', Lead::class);
        $router->model('invoices', Invoice::class);
        $router->model('categories', PostCategory::class);

        $router->bind('industries', function ($slug) {
            return CorporateType::where('slug', $slug)->firstOrFail();
        });

        $router->bind('corporate', function ($id) {
            return Corporate::active()->findOrFail($id);
        });

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
