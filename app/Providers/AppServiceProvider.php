<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
         //env('DB_HOST');
        //env('DB_PORT');
        View::composer('layout_view.sidebar_view', function($view){
            $ip = "www.w3schools.com";
            $portGwp = 80;
            $getSv = @fsockopen($ip, $portGwp, $errno, $errstr, 1);
            if ($getSv == false){
                $data['status'] = 'Offline';
            }
            else{
                $data['status'] = 'Online';
            }
            $getOnline = @DB::connection('sqlsrv1')->table('_ShardCurrentUser')->where('nUserCount','>', 0)
            ->where('nShardID', '64')->select('nUserCount')->orderBy('nID', 'desc')->limit(1)->first();
            $atm = DB::table('paypal')->where('service', 1)->get();
            $data['userCount'] = @$getOnline->nUserCount;
            $view->with('data', $data)->with('atm', $atm);
        });

        View::composer('layout_view.header_view', function($view){
            $getSupMem = DB::table('supmember')->where('service', 1)->where('code', '<>', 'index')->orWhere('id', '<>', 1)->get();
            $view->with('getSupMem', $getSupMem);
        });

        View::composer('layout_view.baner_view', function($view){
            $baner = Cache::rememberForever('baner', function(){
                return DB::table('banerinfo')->where('service', 1)->orderBy('id', 'desc')->get();
            });
            $view->with('baner', $baner);
        });

        View::composer('*', function($view){
            $config_ = DB::table('servertype')->where('type', '<>', 'store_img')->where('service', 1)
            ->select('type', 'value')->get();
            $configs = [];
            foreach ($config_ as $key => $value) {
                $configs[$config_[$key]->type] = $value->value;
            }
            $view->with('configs', $configs);
        });
    }
}
