<?php
    namespace App\Providers;
    
    use Illuminate\Support\ServiceProvider;

    class ReponsitoresProvider extends ServiceProvider{
        public function register()
        {
            $this->app->singleton(
                \App\Repositories\Booking\BookingInterface::class,
                \App\Repositories\Booking\BookingRepository::class
            );
            // $this->app->bind(
            //     '\App\Repositories\Booking\BookingInterface',
            //     '\App\Repositories\Booking\BookingRepository'
            // );
        }
    }