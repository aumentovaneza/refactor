<?php

namespace DTApi\Repository;

use Illuminate\Http\Request;

class DistanceRepository
{
    // Constant variables
     const YES = "yes";
     const NO = "no";

    /**
     * Distance feed
     * @param Request $request
     * @return string
     */
    public function distanceFeed(Request $request)
    {
        $data = $request->all();

        if (isset($data['distance']) && $data['distance'] !== "") {
            $distance = $data['distance'];
        } else {
            $distance = "";
        }
        if (isset($data['time']) && $data['time'] !== "") {
            $time = $data['time'];
        } else {
            $time = "";
        }
        if (isset($data['jobid']) && $data['jobid'] !== "") {
            $jobid = $data['jobid'];
        }

        if (isset($data['session_time']) && $data['session_time'] !== "") {
            $session = $data['session_time'];
        } else {
            $session = "";
        }

        if ($data['flagged']) {
            if ($data['admincomment'] === '') {
                return "Please, add comment";
            }
            $flagged = self::YES;
        } else {
            $flagged = self::NO;
        }

        if ($data['manually_handled']) {
            $manually_handled = self::YES;
        } else {
            $manually_handled = self::NO;
        }

        if ($data['by_admin']) {
            $by_admin = self::YES;
        } else {
            $by_admin = self::NO;
        }

        if (isset($data['admincomment']) && $data['admincomment'] != "") {
            $admincomment = $data['admincomment'];
        } else {
            $admincomment = "";
        }
        if ($time || $distance) {
            $affectedRows = Distance::where('job_id', '=', $jobid)->update(array(
                'distance' => $distance,
                'time' => $time
            ));
        }

        if ($admincomment || $session || $flagged || $manually_handled || $by_admin) {
            $affectedRows1 = Job::where('id', $jobid)->update(array(
                'admin_comments' => $admincomment,
                'flagged' => $flagged,
                'session_time' => $session,
                'manually_handled' => $manually_handled,
                'by_admin' => $by_admin
            ));
        }

        return response('Record updated!');
    }
}
