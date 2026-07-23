<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

Route::get('/', function () {
    $databaseConnected = false;
    $cacheConnected = false;
    $horizonStatus = 'inactive';

    try {
        DB::connection()->getPdo();
        $databaseConnected = true;
    } catch (Throwable) {
        // The status is displayed on the welcome page.
    }

    $cacheStore = config('cache.default');
    $cacheDriver = config("cache.stores.{$cacheStore}.driver", $cacheStore);

    try {
        $key = 'health-check:'.str()->uuid();
        $cache = Cache::store($cacheStore);
        $cache->put($key, true, 10);
        $cacheConnected = $cache->get($key) === true;
        $cache->forget($key);
    } catch (Throwable) {
        // The status is displayed on the welcome page.
    }

    try {
        $masters = app(MasterSupervisorRepository::class)->all();

        if ($masters !== []) {
            $horizonStatus = collect($masters)->every(
                fn ($master) => $master->status === 'paused'
            ) ? 'paused' : 'running';
        }
    } catch (Throwable) {
        // Horizon remains inactive when its Redis connection is unavailable.
    }

    return view('welcome', compact(
        'databaseConnected',
        'cacheConnected',
        'cacheDriver',
        'horizonStatus',
    ));
});
