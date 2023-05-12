<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_classroom;
use App\Models\Student;
use Inertia\Inertia;  

class ClassroomDescriptorController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        // I have to get from DB each student descriptor
        //      query -> select s.id , s.FirstName , s.LastName , s.FaceDescriptor from students s left join student_classrooms sc on s.id = sc.student_id where sc.classroom_id =1

        $members = Student::join('student_classrooms','student_classrooms.student_id','=','students.id')
                          ->select('students.id','students.FirstName','students.LastName','students.FaceDescriptor')
                          ->where('student_classrooms.classroom_id','=',$id)
                          ->get();
        
        return Inertia::render('Photo/Recognition', [ 'members' => $members ]);
                            
          
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
