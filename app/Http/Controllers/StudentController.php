<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentPaginated()
    {
       if($students = Student::paginate(10)){
        return response()->json(['students' => $students], 200);
       }else{
        return response()->json(['error' => 'student not found'], 404);
       }

        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
       if($students = Student::all()){
        return response()->json(['students' => $students], 200);
       }else{
        return response()->json(['error' => 'student not found'], 404);
       }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'rut' => 'required|unique:students|max:12|regex:/^(\d{1,3}(?:\.\d{1,3}){2}-[\dkK])$/i',
            'name' => 'required|max:20',
            'lastName' => 'required|max:20',
            'age' => 'required|max:2',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $student = new Student();

        $student->rut = $request->input('rut');
        $student->name = $request->input('name');
        $student->lastName = $request->input('lastName');
        $student->age = $request->input('age');
        $student->course_id = $request->input('course_id');

        $student->save();

        return response()->json(['done' => 'student inserted'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\$id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $student =  Student::find($id);
        if($student){
            return response()->json(['students' => $student], 200);
           }else{
            return response()->json(['error' => 'student not found'], 404);
           }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\$id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rut' => 'required|unique:students|max:12|regex:/^(\d{1,3}(?:\.\d{1,3}){2}-[\dkK])$/i',
            'name' => 'required|max:20',
            'lastName' => 'required|max:20',
            'age' => 'required|max:2',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $student =  Student::find($id);

        $student->rut = $request->input('rut');
        $student->name = $request->input('name');
        $student->lastName = $request->input('lastName');
        $student->age = $request->input('age');
        $student->course_id = $request->input('course_id');

        $student->save();

     return response()->json(['students' => $student], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student =  Student::find($id);
        if($student){
            Student::destroy($id);
            return response(['message'=>'Student Deleted'],200);
        }else{
            return response()->json(['error' => 'Dont Exists'], 400);
        }
        
    }
}
