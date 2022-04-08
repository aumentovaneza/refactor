<?php

namespace DTApi\Http\Controllers;

use DTApi\Repository\BookingRepository;
use DTApi\Repository\DistanceRepository;
use Illuminate\Http\Request;

class DistanceController
{
    /**
     * @var BookingRepository
     */
    protected $repository;

    /**
     * BookingController constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(DistanceRepository $distanceRepository)
    {
        $this->repository = $distanceRepository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        return $this->repository->distanceFeed($request);
    }
}
