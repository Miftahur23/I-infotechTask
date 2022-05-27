@extends('welcome')
@section('content')

<div class="container" style="width:80%; margin:10%; text-align:center;">
    <h2>Update Student Information</h2>
        <hr>
        <div>
            <img src="{{url('/uploads/students/'.$students->image)}}" width="200px" alt="Student Image"></td>
        </div>
        <br>
        <form action="{{route('students.update',$students->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display: flex;">
                <div class="col-6 form-group">
                    <label for="exampleInputname">Name</label>
                    <input name="student_name" required type="text" value="{{$students->name}}" class="form-control" id="exampleInputname"  placeholder="Enter Student Name">
                </div>
                <div class="col-6 form-group">
                        <label for="student_image">Image</label>
                        <input type="file" name="student_image" class="form-control" id="student_image">
                </div>

            </div>
            
            <button type="submit" class="btn btn-success" style="margin-top: 2%;">Submit</button>
        </form>
</div>

@endsection