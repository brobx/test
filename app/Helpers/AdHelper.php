<?php

namespace App\Helpers;

use App\Advertisement;
use App\AdvertisementSpot;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdHelper
{
    /**
     * Advertisable General Pages.
     *
     * @var array
     */
    protected static $views = [
        'news' => ['news', 'post'],
    ];

    /**
     * Advertisable Pages that require a service, keys are pages/page group names.
     * Values must contain the pages names which specifies the path name of the related view.
     *
     * @var array
     */
    protected static $serviceBoundViews = [
        'apply' => ['apply'],
        'comparison' => ['listing'],
    ];

    /**
     * @return array
     */
    public static function getViews()
    {
        return self::$views;
    }

    /**
     * @return array
     */
    public static function getServiceBoundViews()
    {
        return self::$serviceBoundViews;
    }

    /**
     * @param $pageName
     * @param bool $serviceBound
     */
    public static function addSpot($pageName, $serviceBound = false)
    {
        AdvertisementSpot::firstOrCreate(['page' => $pageName, 'service_bound' => $serviceBound]);
    }

    /**
     * Initializes available spots.
     */
    public static function initializeSpots()
    {
        foreach (static::getViews() as $page => $views) {
            static::addSpot($page);
        }

        foreach (static::getServiceBoundViews() as $page => $views) {
            static::addSpot($page, true);
        }
    }

    /**
     * Randomly pick a single ad.
     *
     * @param $pageName
     * @param null $serviceId
     * @return null|Advertisement
     */
    public static function pickAd($pageName, $serviceId = null)
    {
        // Get the spot.
        $spot = AdvertisementSpot::where(['page' => $pageName, 'service_bound' => !! $serviceId])->first();

        // Get the query.
        $query = $spot->advertisements()->whereRaw('impressions < target_impressions');

        // If service id was specified.
        if($serviceId) {
            $query->wherePivot('service_id', $serviceId);
        }

        // order them randomly then get the first one.
        $ad = $query->orderBy(DB::raw('RAND()'))->first();

        if(! $ad) {
            return null;
        }

        $ad->increment('impressions');
        
        return $ad;
    }

    /**
     */
    public static function injectAdsToViews()
    {
        $service = request()->route('services');
        $pages = !! $service ? static::getServiceBoundViews() : static::getViews();

        foreach ($pages as $page => $names) {
            static::injectAd($page, $names, $service);
        }
    }

    /**
     * @param $names
     * @param $page
     * @param null $service
     */
    protected static function injectAd($page, $names, $service = null)
    {
        foreach ($names as $name) {
            view()->composer($name, function($view) use ($page, $service) {
                $view->with('ad', static::pickAd($page, $service ?  $service->id : null));
            });
        }
    }
}
