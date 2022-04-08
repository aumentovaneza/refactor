<?php

namespace DTApi\Http\Controllers;

use DTApi\Repository\BookingRepository;
use Illuminate\Http\Request;

class CustomerController
{
    /**
     * @var BookingRepository
     */
    protected $repository;

    /**
     * BookingController constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->repository = $bookingRepository;
    }

    /**
     * customerNotCall
     * @return mixed
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $response = $this->repository->customerNotCall($data);

        return response($response);
    }
}
