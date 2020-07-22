 @extends('layouts.master')
 @section('css')


   
 @endsection
 @section('content')
 
     <br>
      

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          

            
          <h2 style="color: black"><i class="fa fa-search"></i> Search Medicine</h2>
          <hr>
          
            
         
               <form  action="{{route('medicine.index')}}" method="get">
                            @csrf
                           <div class="form-group">

                              <label for="name" style="color: black">Search Medicine By Generic Name /Class Name</label>
                              <div class="row">
                                <div class="col-lg-6">
                                   <input type="text" class="form-control" name="generic_name">       
                                  
                                </div>
                              
                            </div>   
                          </div>
                          <input type="submit" class="btn btn-primary" value="Search medicine">           
                                
                            
                </form> 
          
          
         <br>
 </div>
           
          </div><!-- bd -->
        
      @endsection

      @section('js')
  

  
      @endsection