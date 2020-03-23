<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCoursePaginated()
    {
       if($courses = Course::paginate(10)){
        return response()->json(['courses' => $courses], 200);
       }else{
        return response()->json(['error' => 'course not found'], 404);
       }

        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
       if($courses = Course::all()){
        return response()->json(['courses' => $courses], 200);
       }else{
        return response()->json(['error' => 'course not found'], 404);
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
            'name' => 'required|max:50',
            'code' => 'required|max:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $course = new Course();

        $course->name = $request->input('name');
        $course->code = $request->input('code');

        $course->save();

        return response()->json(['done' => 'course inserted'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\$id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $course =  Course::find($id)->course->name;
        if($course){
            return response()->json(['courses' => $course], 200);
           }else{
            return response()->json(['error' => 'course not found'], 404);
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
            'name' => 'required|max:50',
            'code' => 'required|max:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $course =  Course::find($id);

        $course->name = $request->input('name');
        $course->code = $request->input('code');

        $course->save();

     return response()->json(['courses' => $course], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course =  Course::find($id);
        if($course){
            Course::destroy($id);
            return response(['message'=>'Course Deleted'],200);
        }else{
            return response()->json(['error' => 'Dont Exists'], 400);
        }
        
    }
}
