<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student_classroom;
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
        
        $data['classrooms'] = Classroom::all(); // take all classroom
        
        // original SQL query:
        //              select S.*,  count(1) as total_days, sum(A.Attended) as total_asistencias, sum(A.Excused) as total_Excused from attendances A left join students S on S.id = A.StudentID WHERE S.ClassName = '7c' group by S.id 

        $data['filteredStudents'] = Attendance::join('students','attendances.Student_id','=','students.id')
                                            ->select('students.*',Attendance::raw('Count(1) as total_days,  sum(attendances.Attended) as total_Attended, 
                                            sum(attendances.Excused) as total_Excused', 'attendances.id'))
                                            ->groupBy('students.id')
                                            ->where('attendances.classroom_id','=',$id)
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
