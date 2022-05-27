@extends('welcome')
@section('content')

<div class="container">

    <h2>Student List</h2>
    {{-- <form action="#" method="GET">
    <input name="search" class="search-input" type="text" placeholder="Brand Name" aria-label="Search">
    <button style="background-color:rgb(39, 166, 168);" type="submit"><i class='fas fa-search'></i></button>
    </form> --}}
    <hr>

    <a class="btn btn-info" style="margin-bottom: 5px;" href="{{route('students.create')}}">Add New</a>

        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Student Name</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

            @foreach($students as $key=>$student)  
                <tbody>
                    <tr>
                    <th scope="row">{{$key+1}}</th>
                        <td> 
                            <img src="{{url('/uploads/students/'.$student->image)}}" width="100px" alt="Image">
                        </td>
                        <td>{{$student->name}}</td>
                        <td>
                            {{$results}}
                        </td>
                        <td>
                                <a class="btn btn-sm btn-success" href="{{route('students.show',$student->id)}}">View</a>
                                <a class="btn btn-sm btn-warning" href="{{route('students.edit',$student->id)}}">Edit</a>
                                <form action="{{ route('students.destroy', $student->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
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
