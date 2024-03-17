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
                    <th><b>{{ __('Land Situation')}}</b></th>
                    <td colspan="3">{{ $property->land_situation }}</td>
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
                      <th><b>{{ __('Owner Name')}}</b></th>
                      <td colspan="3">{{ $property->owner}}</td>
                  </tr>
                  <tr>
                    <th><b>{{ __('mediator1')}}</b></th>
                    <td colspan="3">{{ $property->mediator1}}  {{ __('phone')}}  {{$property->phone1}}</td>
                </tr>
                <tr>
                  <th><b>{{ __('mediator2')}} </b></th>
                  <td colspan="3">{{ $property->mediator2}}   {{ __('phone')}} {{$property->phone2}}</td>
              </tr>
                <tr>
                  <th><b>{{ __('Owner Name')}}</b></th>
                  <td colspan="3">{{ $property->owner}}</td>
              </tr>
                  <tr>
                      <th><b>{{ __('Tel')}}</b></th>
                      <td colspan="3">{{ $property->ophone}}</td>
                  </tr>
                  <tr>
                      <th><b>{{ __('Status')}}</b></th>
                      <td colspan="3">{{ $property->owner_status}}</td>
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
                <th><b>{{ __('Actions')}}</b></th>
                <td colspan="3"><a href="{{ route('property.edit',$property->id)}}" class="btn btn-success">{{ __('Edit')}}</a>
                  <form action="{{ route('property.destroy', $property->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete')}}</button>
                </form>            
          </td>
            </tr>
                  <tr>
                      <td colspan="4" class="bg-lightgreen py-2 px-3 mt-4">
                          <h4 class="mb-0">
                              <b>{{ __('Price')}}: </b>${{$property->price}}       
                          </h4>
                      </td>
                  </tr>

            
              </table>
              
     
        

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