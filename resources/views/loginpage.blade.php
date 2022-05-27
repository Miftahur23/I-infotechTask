<link href="{{url('/css/style.css')}}" rel="stylesheet" />

<div class="container" style="width: 500px; margin-top: 200px;">
    
                        <form  class="form" action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group" style="margin-bottom: 10px;">
                                <label for="email" class="text"><b>Username</b></label><br>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group" style="margin-bottom: 10px;">
                                <label for="password" class="text"><b>Password</b></label><br>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="row">
                                <button class="btn btn-success" type="submit">Login</button> 
                            </div>                          
                        </form>
                        
</div>

