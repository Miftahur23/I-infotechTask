@extends('welcome')
@section('content')

<div class="container" style="width:80%; margin:10%; text-align:center;">
    <h2>Add Student</h2>
        <hr>
        <form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: flex;">
                <div class="col-6 form-group">
                    <label for="exampleInputname">Name</label>
                    <input name="student_name" required type="text" class="form-control" id="exampleInputname"  placeholder="Enter Student Name">
                </div>
                <div class="col-6 form-group">
                        <label for="student_image">Image</label>
                        <input type="file" name="student_image" required type="file" class="form-control" id="student_image">
                </div>

            </div>
            
            <button type="submit" class="btn btn-success" style="margin-top: 2%;">Submit</button>
        </form>
</div>

@endsection