<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Torann\GeoIP\GeoIPFacade as GeoIP;
use App\Page;
use App\City;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pages = Page::all();
        $cities = City::all();

        view()->share('pages', $pages);
        view()->share('cities', $cities);

        $user_location = GeoIP::getLocation();
        $city = City::where('slug', $user_location['city'])->get();

        if( empty($city[0]) ) {
            $city[0] = $cities[0];
        }

        view()->share('user_city', $city[0]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
