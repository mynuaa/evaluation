<?php
/**
 * Created by PhpStorm.
 * User: usual
 * Date: 3/30/16
 * Time: 23:25
 */

namespace App\Providers;

use App\Services\HtmlAttributeFilter;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('HtmlAttributeFilter', function()
        {
            $filter = new HtmlAttributeFilter;

            $filter->setAllow(['style']);
            $filter->setException([
                'span' => ['style'],
                'img' => ['src', 'alt', 'title', 'width', 'height', 'border', 'vspace'],
            ]);

            return $filter;
        });
    }
}