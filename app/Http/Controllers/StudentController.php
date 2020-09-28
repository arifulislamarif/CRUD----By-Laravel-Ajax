<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{

       
       function index(){
           $student = Student::latest()->simplePaginate(5);
           return view('student',compact('student'));
        }

        function allData(){
            $student = Student::latest()->get();
            return response()->json($student);
        }
    
    
       function addData(){
            
            request()->validate([
                'name' => 'required',
                'roll' => 'required',
            ],[
                'name.required' => 'Name field is required',
                'roll.required' => 'Roll field is required',
            ]);

            $student = Student::create([
                'name' => request()->name,
                'roll' => request()->roll,
            ]);

            return response()->json($student);

       }

       function destroyData($id){
        //    return $id;
            $student = Student::find($id)->delete();
            return response()->json($student);
        }

       function editData($id){
            $student = Student::find($id);
            return response()->json($student);
        }

       function updateData(){

            request()->validate([
                'name' => 'required',
                'roll' => 'required',
            ],[
                'name.required' => 'Name field is required',
                'roll.required' => 'Roll field is required',
            ]);

            $student = Student::find(request()->id);
            $student->name = request()->name;
            $student->roll = request()->roll;
            $student->save();
            return response()->json($student);
            
        }



}
