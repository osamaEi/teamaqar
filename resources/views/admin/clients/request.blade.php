@extends('admin.index')
@section('admin') 



<div class="col-md-12">

    <div class="card card-success">
                  <div class="card-header" style="background: rgb(122, 165, 122)">
                    <h3 class="card-title" style="float: right;">{{ __('Make A New Request')}}</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('client.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                  
              <!--<div class="col-sm-8">
    
                        

                    <label>Property Name</label>

                     <select class="form-control select2" style="width: 100%;" name="status">
                       <option selected="selected">Property Status</option>
                       @foreach( $properties as $property)
                       
                       <option value="{{$property->id}}"> {{$property->name}} </option>
                       @endforeach
                     </select>
                    </div>

                -->
    
                    
                <div class="col-sm-8">
                  <label for="exampleInputEmail1">{{ __('Name')}}</label>
                  <input type="text" name="client_name" class="form-control">
                </div>




                <div class="col-sm-8">

                  <label>{{ __('Client Type')}}</label>

                     <select class="form-control select2" style="width: 100%;" name="client_type">
                       
                       <option value=" عميل"> عميل</option>
                       <option value="وسيط عقاري">وسيط عقاري</option>
                       <option value="مالك">مالك</option>
                       <option value="وكيل">وكيل</option>
                     </select>
                    </div>


                
              <div class="col-sm-8">
                  <label for="exampleInputEmail1">الجوال </label>
                  <input type="text" name="client_phone" class="form-control">
                </div> 
                    <div class="col-sm-8">
    
                        

                        <label>{{ __('Offer Type')}}</label>
    
                         <select class="form-control select2" style="width: 100%;" name="request_name">
                           
                           <option value="أرض ايجار زراعية"> أرض ايجار زراعية </option>
                           <option value="أرض شراء زراعية"> أرض شراء زراعية </option>
                           <option value="أرض سكنية"> أرض سكنية </option>
                           <option value="أرض استثمار"> أرض استثمار </option>
                         </select>
                        </div>
              <!--

                    <div class="col-sm-8">
                        <label for="exampleInputEmail1">Other Request</label>
                        <input type="text" name="owner" class="form-control">
                      </div>
                    -->
                    
    

                    <div class="col-sm-8">
                      <label for="exampleInputEmail1">مواصفات اضافية</label>
                      <textarea name="other_request" class="form-control" style="height: 100px; width: 100%;"></textarea>
                  </div>
                  
    
    

                
    
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success" style="background: rgb(122, 165, 122)">{{ __('Add New Request')}}</button>
                    </div>
                  </form>
                </div>
    
                
    
    </div>
    
    
</div>








@endsection