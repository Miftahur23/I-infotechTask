<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Student_result;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group=Student_result::select('student_id','achieve_number')->groupBy('student_id','achieve_number')->get();
        dd($group);
        $students=Student::paginate(10);
        $student_id=Student::all()->pluck('id');
        dd($student_id);
        foreach($student_id as $data)
        {
            $results=Student_result::select('achieve_number')->where('student_id',$data)->sum('achieve_number');
        }
        //dd($results);
        return view ('admin.pages.student.index',compact('students','results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.pages.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $image_name=null;
        if($request->hasfile('student_image'))
        {
            $image_name=date('Ymdhis').'.'.$request->file('student_image')->getClientOriginalExtension();
            // dd($image_name);
            $request->file('student_image')->storeAs('/uploads/students',$image_name);
    
        }

        Student::create([
            'name'=>$request->student_name,
            'image'=>$image_name,
           ]);

           return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students=Student::find($id);
        return view ('admin.pages.student.show',compact('students'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students=Student::find($id);
        return view('admin.pages.student.edit',compact('students'));
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
        $students=Student::find($id);
        //dd($students);

        $image_name=$students->image;
        //              step 1: check image exist in this request.
        if($request->hasfile('student_image'))
        {
            $image_name=date('Ymdhis').'.'.$request->file('student_image')->getClientOriginalExtension();
            // dd($image_name);
            $request->file('student_image')->storeAs('/uploads/students',$image_name);
    
        }

        $students->update([
            'name'=>$request->student_name,
            'image'=>$image_name,
        ]);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students=Student::find($id)->delete();
        return redirect()->back();
    }
}
