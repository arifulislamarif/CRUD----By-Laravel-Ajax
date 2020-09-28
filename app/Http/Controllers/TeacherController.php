<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{

   function welcome(){
    return view('welcome'); 
   }
   
   function index(){
       return view('index');
   }

   function allData(){
      $teacher = Teacher::latest()->get();
      return response()->json($teacher);
   }

   function addData(){
      
    $teacher = Teacher::create([
        'name' => request()->name,
        'title' => request()->title,
        'institute' => request()->institute,
    ]);
    return response()->json(['success' => 'Teacher Added Successfully!']);
   }



















}
