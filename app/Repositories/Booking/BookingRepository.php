<?php
namespace App\Repositories\Booking;

use App\Repositories\BaseRepository;
use App\Repositories\Booking\BookingInterface;

class BookingRepository extends BaseRepository implements BookingInterface
{
    public function getModel()
    {
        return \App\Models\Booking::class;
    }

    public function getBooking()
    {
        return $this->model->select('*')->take(5)->get();
    }
}
