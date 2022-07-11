<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = new Carbon();
        $date = $dt->toDateString();
        $attendances = Attendance::where('date', $date)->get();

        // $attendances = Attendance::with(['users','rests'])->get();
        return response()->json([
            'attendances' => $attendances
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $dt = new Carbon();
        $date = $dt->toDateString();

        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $param = [
            'user_id' => $user_id,
            'start_time' => $time,
            'date' => $date,
        ];
        $attendance = Attendance::create($param);
        if ($attendance) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $dt = new Carbon();
        $time = $dt->toTimeString();
        $attendance = Attendance::where('id', $attendance->id)->update(['end_time' => $time]);
        if ($attendance) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
