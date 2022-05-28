@extends('welcome')
@section('content')

@if (session()->has('message'))
    <p class="alert alert-success">{{session()->get('message')}}</p>
@endif

<div class="container">
    <h2>Student List</h2>   
    <a  class="btn btn-info" href="{{route('students.create')}}">Add New</a>
        <table class="table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th class="col-2">Image</th>
                        <th>Student Name</th>
                        <th class="col-2">Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

            @foreach($students as $key=>$student)  
                <tbody>
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                            <td> 
                                <img src="{{url('/uploads/students/'.$student->image)}}">
                            </td>
                            <td>{{$student->name}}</td>
                            <td>
                                {{$student->result->sum('achieve_number')}}
                            </td>
                            <td style="display: flex; border-bottom-width: 0px;">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" style="margin-top: 5px; margin-right:4px;" data-bs-toggle="modal" data-bs-target="#modal{{$key}}">
                                        View
                                    </button>   
                                    <!-- Modal To Show Result -->
                                    <div class="modal fade" id="modal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                                    <div class="modal-header">
                                                        <img src="{{url('/uploads/students/'.$student->image)}}" alt="Image">
                                                    </div>
                                                    <div class="modal-body"><strong>Name:</strong>  {{$student->name}}</div>
                                                    <div class="modal-body"><strong>Subjects:</strong>
                                                        <table class="table">
                                                            <thead>
                                                                <th>Name</th>
                                                                <th>Number</th>
                                                            </thead>

                                                            @foreach($student->result as $data)
                                                            <tbody>
                                                                <td>{{$data->subject->subject_name}}</td>
                                                                <td>{{$data->achieve_number}}</td>
                                                            </tbody>
                                                            @endforeach
                                                        </table>
                                                        
                                                    </div>
                                                    <div class="modal-body"><strong>Total Number:</strong> {{$student->result->sum('achieve_number')}}</div>
                                                </div>
                                        </div>
                                    </div>                             
                                    <a class="btn btn-sm btn-warning" style="margin-top: 5px; margin-right:4px;" href="{{route('students.edit',$student->id)}}">Edit</a>
                                    <form action="{{ route('students.destroy', $student->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                                <button class="btn btn-sm btn-danger" style="margin-top: 5px; margin-right:4px;">Delete</button>
                                    </form>
                            </td> 
                            
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    {{$students->links('pagination::bootstrap-5')}}
</div>
@endsection
