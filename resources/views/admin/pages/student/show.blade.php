@extends('welcome')
@section('content')

<div class="container" style="width:80%; margin:10%; text-align:center;">
    <h2>Student Information</h2>
        <hr>
        <div style="display: flex;">
            <div>
                <img src="{{url('/uploads/students/'.$students->image)}}" width="200px" alt="Student Image"></td>
            </div>
            <br>
            <div class="col-6" style="margin-top: 10%;">
                        <h3>Name: {{$students->name}}</h3>
            </div>
        </div>
        

</div>

@endsection