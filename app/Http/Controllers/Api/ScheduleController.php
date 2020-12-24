<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function hours(Request $request)
    {
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];
    	$this->validate($request, $rules);

    	$date = $request->input('date');
    	$dateCarbon = new Carbon($date);

    	//dayOfWeek
    	//Carbon: 0 = sunday - 6 = saturday
    	//apliacion: 0 = monday - 6 = sunday
		$i =$dateCarbon->dayOfWeek;
    	$day = ($i==0 ? 6 : $i - 1);//dia de la semana

    	$doctorId = $request->input('doctor_id');

    	$workDay = WorkDay::where('active', '1')
    		->where('day', $day)
    		->where('user_id', $doctorId)
    		->first([
    			'morning_start', 'morning_end',
    			'afternoon_start', 'afternoon_end'
    		]);

    	if(!$workDay){
			return [];
    	}

    	$morningIntervals = $this->getInterval($workDay->morning_start, $workDay->morning_end);
    	$afternoonIntervals = $this->getInterval($workDay->afternoon_start, $workDay->afternoon_end);

    	$data = [];
    	$data['morning'] = $morningIntervals;
    	$data['afternoon'] = $afternoonIntervals;

    	return $data;
    }

    private function getInterval($start, $end)
    {
    	$start = new Carbon($start);
		$end = new Carbon($end);

		$intervals = [];
		while($start < $end){
			$interval = [];
			$interval['start'] = $start->format('g:i A');
			$start->addMinutes(30);
			$interval['end'] = $start->format('g:i A');

			$intervals []= $interval;
		}
		return $intervals;
    }
}
