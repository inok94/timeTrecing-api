<?php

namespace App\Http\Controllers;


use App\ProjectEmployee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Given a project, implement an operation that returns the number of hours that were tracked
     * on that project.
     *
     * @param Request $request
     * @param $id = project_id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function spentTime(Request $request, $id)
    {
        $time = ProjectEmployee::select('started_work', 'finished_work')->where([['project_id', '=', $id]]);
        if (!$time->exists()) {
            return abort('404');
        }

        $timeArray = $time->get()->toArray();
        foreach ($timeArray as $item) {
            $startTime = Carbon::parse($item['started_work']);
            $finishTime = Carbon::parse($item['finished_work']);
        }
        $totalDuration = $finishTime->diffInSeconds($startTime);

        $resultTime = gmdate('H:i:s', $totalDuration);
        return response()->json($resultTime, 200);

    }

    /**
     * Given a day and project, implement an operation that determines a time period (on the
     * given day) in which most people were working on the given project.
     *
     * @param Request $request
     * @param $day format = YYYY-MM-DD
     * @param $project_id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function peakTime(Request $request, $day, $project_id)
    {
        $countEmployeers = ProjectEmployee::select('employee_id')->distinct()->where([['project_id', '=', $project_id, 'and'],
            ['date', '=', $day]]);
        if (!$countEmployeers->exists()) {
            return abort('404');
        }

        $msg = 'On this day:' . $day . ' worked ' . $countEmployeers->count() . ' person';

        return response()->json($msg, 200);

    }
}