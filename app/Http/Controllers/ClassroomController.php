<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Inertia\Inertia;  

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Classrooms/Index', [
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
        return Inertia::render('Classrooms/Form',['classroom' => [] , 'create' => true]);

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
        $fullFormData = request();      // I have to use request() cuz data from $request is truncked
        
        $fullFormData->validate([
            'ClassName' => 'required',
            'Details'  => 'required',
            'Year' => 'required',
            'Owner' => 'required',
            'OwnerEmail'   => 'required',
            'OwnerTel' => 'required',
            'Active' => 'required',
        ]);

        Classroom::create($fullFormData->request->all());    // save into DB and create a new student in order to go to the edit page 

        return redirect()->route('classrooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
        return Inertia::render('Classrooms/Form',['classroom' => $classroom, 'create' => false ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
        $fullFormData = request();      // I have to use request() cuz data from $request is truncked
        
        $fullFormData->validate([
            'ClassName' => 'required',
            'Details'  => 'required',
            'Year' => 'required',
            'Owner' => 'required',
            'OwnerEmail'   => 'required',
            'OwnerTel' => 'required',
            'Active' => 'required',
        ]);

        Classroom::create($fullFormData->request->all());    // save into DB and create a new student in order to go to the edit page 

        $classroom->update($request->request->all());

        return redirect()->route('classrooms.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //

        $classroom->delete();

        return redirect()->route('classrooms.index');
    }
}
