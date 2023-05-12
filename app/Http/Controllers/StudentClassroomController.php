<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_classroom;

class StudentClassroomController extends Controller
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

        ////////////     SAVING CLASSROOM'S STUDENTS IN DB    ////////////

        
        // oldMembers are the members to delete in DB
        $oldMembers = Student_classroom::where('classroom_id',$id)->get()->toArray();

        // newMembers are the new members to save in DB
        $newMembers = $request->toArray();

       
        // Filtering arrays
        $oldIndex = 0;
        foreach($oldMembers as $oldValue){
            foreach($newMembers as $newIndex=>$newValue){
                if($oldValue['student_id'] == (string) $newValue['id']){
                    array_splice($oldMembers,$oldIndex,1);               
                    array_splice($newMembers,$newIndex,1);
                    $oldIndex--;
                    break;
                };          
            };
        $oldIndex++;   
        };

        // Delete old members registers in DB
        foreach($oldMembers as $element){
            Student_classroom::where('student_id', $element['student_id'])->where('classroom_id',$id)->delete();          
        }
        

        // Adding new members to the classroom in DB
        foreach($newMembers as $element){            
            Student_classroom::create([
                    'student_id'=>$element['id'],
                    'classroom_id'=>$id,
            ]);
        };


        return redirect()->route('classrooms.index');
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
