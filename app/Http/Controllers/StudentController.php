<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Student_result;
use App\Http\Requests\ResultRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Student_result::all();
        $students=Student::with('result')->paginate(10);
        //dd($students);
        return view ('admin.pages.student.index',compact('students','results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects=Subject::all();
        $students=Student::all();
        return view('admin.pages.student.create',compact('subjects','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            'student_image'=>'required|mimes:jpeg,png,jpg,gif,svg|dimensions:width=100,height=100',
            'subject_id'=>'required',
            'number'=>'required',
        ],

        [
            'name.required'=>'Please insert student name',
            'student_image.required'=>'Image size must be 100x100',
            'subject_id.required'=>'Please insert subject name',
            'number.required'=>'Please insert marks'
        ]
    
    );

        //dd($request->all());
        $subjects=$request->subject_id;
        //dd($subjects);

        $numbers=$request->number;
        //dd($numbers);

        //dd($subjects ,$numbers);
        $results=array_combine($subjects,$numbers);
        //dd($results);

        $image_name=null;
        if($request->hasfile('student_image'))
        {
            $image_name=date('Ymdhis').'.'.$request->file('student_image')->getClientOriginalExtension();
            // dd($image_name);
            $request->file('student_image')->storeAs('/uploads/students',$image_name);
        }

        $student=Student::create([
            'name'=>$request->name,
            'image'=>$image_name
        ]);
        //dd($student);

        $match=Student::where('name',$request->name)->first();

        foreach($results as $key=>$result)
        {
            Student_result::insert([
                'student_id'=>$match->id,
                'subject_id'=>$key,
                'achieve_number'=>$result,
            ]);
        }
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
        $subjects=Subject::all();
        $students=Student::find($id);
        //dd($students);
        return view('admin.pages.student.edit',compact('students','subjects'));
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
        $result=Student_result::where('student_id',$id)->delete();
        return redirect()->back();
    }
}
