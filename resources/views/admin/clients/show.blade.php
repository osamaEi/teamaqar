@extends('admin.index')
@section('admin') 





    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-7">
            <h3 class="d-inline-block d-sm-none">{{ $property->name}}</h3>
            <div class="col-12">
              <img id="mainImage" src="{{ asset('upload/property/multi_img/' . $multiImage[0]->images) }}" class="product-image" alt="Product Image">
          </div>
          
          <div class="col-12 product-image-thumbs">
              @foreach($multiImage as $image)
                  <div class="product-image-thumb">
                      <img class="thumbnail" src="{{ asset('upload/property/multi_img/' . $image->images) }}" >
                  </div>
              @endforeach
          </div>
          
          
          <script>
              // Get all thumbnail images
              var thumbnails = document.querySelectorAll('.thumbnail');
          
              // Get the main image element
              var mainImage = document.getElementById('mainImage');
          
              // Add click event listener to each thumbnail
              thumbnails.forEach(function(thumbnail) {
                  thumbnail.addEventListener('click', function() {
                      // Update main image source with clicked thumbnail's source
                      mainImage.src = thumbnail.src;
                  });
              });
          </script>
          



      
          </div>
          <div class=" col-sm-5">

    
            

            <div class="table-responsive">
              <table class="table table-hover">       
                
          
                  <tr>
                      <th style="font-size: 15px; color: dodgerblue;"><b>{{ __('Location')}}</b></th>
                      <td colspan="3">{{$property->location}}</td>
                  </tr>
                  <tr>
                      <th colspan="4">
                          <i class="{{ $property->status === 'Sold' ? 'bi bi-exclamation-triangle-fill text-danger' : 'bi bi-check-circle-fill text-success' }}" style="font-size: 16px; padding-right: 5px;"></i>
                          <b>{{ __($property->name)}}</b>
                          <span class="btn {{ $property->status === 'Sold' ? 'btn-danger' : 'btn-success' }}" style="font-size: 13px; padding: 0px;">
                            {{ __($property->status)}}
                          </span>
                      </th>
                  </tr>
                  <tr>
                      <th><b>{{ __('Area')}}</b></th>
                      <td colspan="3">{{ $property->area}}</td>
                  </tr>

                  <tr>
                    <th><b>{{ __('رقم العقار / الارض')}}</b></th>
                    <td colspan="3">{{ $property->number}}</td>
                </tr>
                  <tr>
                      <th><b>{{ __('Status')}}</b></th>
                      <td colspan="3">{{ $property->propery_cat}}</td>
                  </tr>
              
          
        
     
               
                  <tr>
                    <th><b>{{ __('Description')}}</b></th>
                    <td colspan="3">{{ $property->description}}</td>
                </tr>
                <tr>
                  <th><b>{{ __('notes')}}</b></th>
                  <td colspan="3">{{ $property->notes}}</td>
              </tr>

              
                  <tr>
                      <td colspan="4" class="bg-lightgreen py-2 px-3 mt-4">
                          <h4 class="mb-0">
                              <b>{{ __('Price')}}: </b>{{$property->price}} ريال       
                              <br><hr>  
                              <a class="btn btn-success" data-toggle="modal" data-target="#requestModal">{{ __('Send A Request')}}</a>
                          </h4>
                      </td>
                  </tr>

            
              </table>
              
            
              <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Send A Request')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="col-md-12">

                            <div class="card card-success">
                                          <div class="card-header">
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form action="{{ route('requests.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="card-body">
                                          
                            
                            
                                            
                                            <div class="">
                            
                                                
                        
                                                <label>{{ __('Offer Type')}}</label>
                            
                                                 <select class="form-control select2" name="request_name">
                                                   
                                                   <option value="أرض ايجار زراعية"> أرض ايجار زراعية </option>
                                                   <option value="أرض شراء زراعية"> أرض شراء زراعية </option>
                                                   <option value="أرض سكنية"> أرض سكنية </option>
                                                   <option value="أرض استثمار"> أرض استثمار </option>
                                                 </select>
                                                </div>


                                                <label>{{ __('Client Type')}}</label>
    
                                                <select class="form-control select2" style="width: 100%;" name="client_type">
                                                  
                                                  <option value=" عميل"> عميل</option>
                                                  <option value="وسيط عقاري">وسيط عقاري</option>
                                                  <option value="مالك">مالك</option>
                                                  <option value="وكيل">وكيل</option>
                                                </select>
                                      <!--
                        
                                            <div class="col-sm-8">
                                                <label for="exampleInputEmail1">{{ __('Other Request')}}</label>
                                                <input type="text" name="owner" class="form-control">
                                              </div>
                                            -->
                                            <input type="hidden" id="hiddenInput" name="property_id" value="{{$property->id}}">
                                                <label for="exampleInputEmail1">{{ __('Name')}}</label>
                                                <input type="text" name="client_name" class="form-control">
                            
                            
                            
                            
                                          
                            
                          
                                              
                                                <label for="exampleInputEmail1">{{ __('phone')}}</label>
                                                <input type="text" name="client_phone" class="form-control">
                            
                            
                            
                                            <!-- /.card-body -->
                            
                                    
                                        </div>
                            
                                        
                            
                            </div>
                            
                            
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                            <!-- Add a button to submit the request or perform any other action -->
                            <button type="submit" class="btn btn-success">{{ __('Add New Request')}}</button>
                          </div>
                        </form>

                    </div>
                </div>
            </div>
        
            </div>

        

          </div>
        </div>
 
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  <script>
    $(document).ready(function() {
      $('.product-image-thumb').on('click', function () {
        var $image_element = $(this).find('img')
        $('.product-image').prop('src', $image_element.attr('src'))
        $('.product-image-thumb.active').removeClass('active
      })
    })
  </script>
  @endsection