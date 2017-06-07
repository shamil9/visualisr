<?php

namespace App\Providers;

use App\Observers\SupportTicketObserver;
use App\Observers\UserObserver;
use App\SupportTicket;
use App\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        SupportTicket::observe(SupportTicketObserver::class);

        Blade::directive('activeClass', function ($path) {
            return "<?php if (Request::url() == route($path)) echo 'is-active'; ?>";
        });

        Blade::directive('randomColor', function ($path) {
            return "<?php echo '#' . substr(md5(rand()), 0, 6); ?>";
        });

        Blade::directive('breadcrumbs', function ($routes) {
            $collection = collect(preg_split("/'/", $routes))->nth(2, 1);
            $linkNames = $collection->nth(2);
            $routeNames = $collection->nth(2, 1);
            $output = '';

            $linkNames->each(function ($linkName, $index) use ($routeNames, &$output) {
                $url = route($routeNames[ $index ]);
                $output .= "<span class='breadcrumbs__link'><a href='$url'>$linkName</a></span>";
            });

            return '<?php echo "' . $output . '" ?>';
        });
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
