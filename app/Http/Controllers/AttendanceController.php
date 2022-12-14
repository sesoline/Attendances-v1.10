<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Inertia\Inertia;  

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Attendances/Index', [
            'classrooms' => Classroom::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['classrooms'] = Classroom::all(); // take all classroom
        $data['filteredStudents'] = Attendance::join('students','attendances.StudentID','=','students.id')
                                            ->select('students.*',Attendance::raw('Count(1) as total_days,  sum(attendances.Attended) as total_Attended, 
                                            sum(attendances.Excused) as total_Excused', 'attendances.id'))
                                            ->groupBy('students.id')
                                            ->where('attendances.id','=',$id)
                                            ->get();

        return Inertia::render('Attendances/Index', $data);
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
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
        //
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
