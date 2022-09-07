<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;  
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

 

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Students/Index',['students' => Student::all() ]);


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
        $fullFormData = request();      // I have to use request() cuz data from $request is truncked
        //dd($fullFormData);
        
        $fullFormData->validate([
            'FirstName' => 'required',
            'LastName'  => 'required',
            'ClassName' => 'required',
            'Telephone' => 'required',
            'Address'   => 'required',
        ]);

        if(request()->hasFile('Photo')){
            $fullFormData['Photo'] = $fullFormData->file('Photo')->store('uploads','public'); // it s the same that store('public/uploads')
        };

        $student = Student::create($fullFormData->request->all());    // save into DB and create a new student in order to go to the edit page 

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $request->validate([
            'FirstName' => 'required',
            'LastName'  => 'required',
            'ClassName' => 'required',
            'Telephone' => 'required',
            'Address'   => 'required',
        ]
        );

        if(request()->hasFile('Photo')){
            if($student['Photo']!= 'images/defaultUser.png'){       // Only delete uploaded pics
                Storage::delete('public/' . $student['Photo']);     // Deleting old photo
            }
            
            $request['Photo'] = $request->file('Photo')->store('uploads','public'); // Saving new pic on server
        };

        
        $student->update($request->request->all());

        return redirect()->route('students.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //    
        Storage::delete('public/' . $student['Photo']);
        $student->delete();

        return Redirect::route('students.index');
    }
}
