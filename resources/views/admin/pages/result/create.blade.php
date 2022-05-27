@extends('welcome')
@section('content')

<div class="container" style="">
    <h2>Student Result Entry</h2>
        <hr>
        <form action="{{route('results.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="exampleInputname"> <b>Name:</b></label>
                    <select id="student" name="student_id" class="form-control">
                      @foreach ($students as $student)
                            <option value="{{$student->id}}">{{$student->name}}</option>   
                      @endforeach
                  </select>
                </div>
                <div class="form-group mt-2">
                        <label for="student_image"> <b>Picture:</b> </label>
                        <input type="file" name="student_image" required type="file" class="form-control mt-2" id="student_image">
                </div>

                <div style="margin-top: 20px;">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><h5>Subject</h5></th>
                            <th scope="col"><h5>Number</h5></th>
                            <th scope="col">
                              <a href="javascript:void(0);" class="add_button btn btn-success"  title="Add field">Add new</a>
                 
                   
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            
                          </tr>
                        </tbody>
                      </table>
                </div>
                  {{-- @dd($subjects) --}}
                <div class="row field_wrapper" style="display: flex;">
                  {{-- <div class="col-4">
                    <select id="subject" name="subject_id" class="form-control">
                      @foreach ($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>   
                      @endforeach
                  </select>
                  </div>
                  <div class="col-4">
                        <input type="text" name="number" value=""/>
                      </div>

                      <div class="col-4">
                        <a href="" class="btn btn-danger">Remove</a>
                      </div> --}}
              </div>
            <button type="submit" class="btn btn-success" style="margin-top: 2%;">Submit</button>
        </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      var maxField = 10; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.field_wrapper'); //Input field wrapper
      var fieldHTML = '<div class="siam row d-flex"><div class="col-4"><select id="subject" name="subject_id[]" class="form-control">@foreach ($subjects as $subject) <option value="{{$subject->id}}">{{$subject->subject_name}}</option> @endforeach</select></div><div class="col-4"><input type="text" name="number[]" value=""/></div><div class="col-4"><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a></div></div>'; //New input field html 
      var x = 1; //Initial field counter is 1
      
      //Once add button is clicked
      $(addButton).click(function(){
          //Check maximum number of input fields
          if(x < maxField){ 
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });
      
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e){
          e.preventDefault();
          $(this).closest('.siam').remove(); //Remove field html
          //$('.siam').remove(); //Remove field html
          x--; //Decrement field counter
      });
  });
  </script>
@endsection
