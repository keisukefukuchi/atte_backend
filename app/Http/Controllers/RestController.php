<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Http\Request;


class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $time = $dt->toTimeString();
        $attendance = Attendance::where('user_id', $user_id)->where('date', $date)->first();
        $rest = Rest::create([
            'attendance_id' => $attendance->id,
            'start_time' => $time,
        ]);
        if ($rest) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rest  $rest
     * @return \Illuminate\Http\Response
     */
    public function show(Rest $rest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rest  $rest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rest $rest)
    {
        $dt = new Carbon();
        $time = $dt->toTimeString();
        $rest = Rest::where('id', $rest->id)->update(['end_time' => $time]);
        if ($rest) {
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
     * @param  \App\Models\Rest  $rest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rest $rest)
    {
        //
    }
}
