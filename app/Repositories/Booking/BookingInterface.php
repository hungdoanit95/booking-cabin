<?php
namespace App\Repositories\Booking;

use App\Repositories\RepositoryInterface;

interface BookingInterface extends RepositoryInterface
{
    public function getBooking();
    public function getModel();
}
