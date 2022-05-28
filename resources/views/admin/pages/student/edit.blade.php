@extends('welcome')
@section('content')

<div class="container" style="width:80%; margin:10%; text-align:center;">
    <h2>Update Student Information</h2>
        <hr>
        <img src="{{url('/uploads/students/'.$students->image)}}">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="exampleInputname"> <b>Name:</b></label>
                    <select id="student" name="student_id" class="form-control">
                     
                            <option value="{{$students->id}}">{{$students->name}}</option>   
                     
                  </select>
                </div>
                <div class="form-group mt-2">
                        <label for="student_image"> <b>Picture:</b> </label>
                        <input type="file" name="student_image" required type="file" class="form-control mt-2" id="result_entry_image">
                </div>

                <div style="margin-top: 20px;">
                    <table class="table">
                        <thead>
                          <tr>
                            <th class="col-4"><h5>Subject</h5></th>
                            <th class="col-4"><h5>Number</h5></th>
                            <th class="col">
                              <a href="javascript:void(0);" class="add_button btn btn-info"  title="Add field">Add More</a>
                 
                   
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
      var fieldHTML = '<div class="siam row d-flex"><div class="col-4"><select id="subject" name="subject_id[]" class="form-control">@foreach ($subjects as $subject) <option value="{{$subject->id}}">{{$subject->subject_name}}</option> @endforeach</select></div><div class="col-4"><input type="text" name="number[]" class="form-control" value=""/></div><div class="col-4"><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a></div><hr class="row" style="height:1px; margin-left:0.5rem; margin-top: 1rem;"></div>'; //New input field html 
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
