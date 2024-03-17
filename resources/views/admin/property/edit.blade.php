@extends('admin.index')
@section('admin') 

<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header" style="background: rgb(122, 165, 122)">
            <h3 class="card-title" style="float:right;">{{ __('Edit Offer')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('properties.update',$property->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- Property Name -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="name">{{ __('Property Name')}}</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $property->name }}">
                    </div>

                    <!-- Property No -->
                    <div class="col-sm-4">
                        <label for="number">{{ __('Property No')}}</label>
                        <input type="text" name="number" class="form-control" id="number" value="{{ $property->number }}">
                    </div>

                    <!-- Property Area -->
                    <div class="col-sm-4">
                        <label for="area">{{ __('Property Area')}}</label>
                        <input type="text" name="area" class="form-control" id="area" value="{{ $property->area }}">
                    </div>
                </div>

                <!-- Owner, Phone Owner, Owner Status -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="owner">{{ __('Owner')}}</label>
                        <input type="text" name="owner" class="form-control" id="owner" value="{{ $property->owner }}">
                    </div>

                    <div class="col-sm-4">
                        <label for="ophone">{{ __('Phone Owner')}}</label>
                        <input type="text" name="ophone" class="form-control" id="ophone" value="{{ $property->ophone }}">
                    </div>

                    <div class="col-sm-4">
                        <label>{{ __('Owner Status')}}</label>
                        <select class="form-control select2" style="width: 100%;" name="owner_status">
                            <option value="مالك" {{ $property->owner_status == 'مالك' ? 'selected' : '' }}>مالك</option>
                            <option value="وكيل" {{ $property->owner_status == 'وكيل' ? 'selected' : '' }}>وكيل</option>
                        </select>
                    </div>
                </div>

                <!-- Mediator 1, Phone 1, Mediator 2, Phone 2 -->
                <div class="row mb-3">

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('mediator1')}}</label>
                    <input type="text" name="mediator1" class="form-control" value="{{ $property->mediator1 }}">
                  </div>

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('phone1')}}</label>
                    <input type="text" name="phone1" class="form-control" value="{{ $property->phone1 }}">
                  </div>

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('mediator2')}}</label>
                    <input type="text" name="mediator2" class="form-control" value="{{ $property->mediator2 }}">
                  </div>

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('phone2')}}</label>
                    <input type="text" name="phone2" class="form-control" value="{{ $property->phone2 }}">
                  </div>
                </div>               

                <!-- Location -->
                <div class="form-group">
                    <label for="location">{{ __('Location')}}</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ $property->location }}">
                </div>

                <div class="row mb-3">

                    <div class="col-sm-4">
                      <label>{{ __('Property Type')}}</label>
                      <select class="form-control select2" style="width: 100%;" name="property_type">
                          <option value="أرض زراعية" {{ $property->property_type == 'أرض زراعية' ? 'selected' : '' }}>أرض زراعية</option>
                          <option value="حوش" {{ $property->property_type == 'حوش' ? 'selected' : '' }}>حوش</option>
                          <option value="بيت شعبي" {{ $property->property_type == 'بيت شعبي' ? 'selected' : '' }}>بيت شعبي</option>
                      </select>
                  </div>
                  
                  <div class="col-sm-4">
                      <label>{{ __('Property Category')}}</label>
                      <select class="form-control select2" style="width: 100%;" name="propery_cat">
                          <option value="بيع اراضى" {{ $property->propery_cat == 'بيع اراضى' ? 'selected' : '' }}>بيع أراضى</option>
                          <option value="بيع منازل" {{ $property->propery_cat == 'بيع منازل' ? 'selected' : '' }}>بيع منازل</option>
                          <option value="تأجير أراضى" {{ $property->propery_cat == 'تأجير أراضى' ? 'selected' : '' }}>تأجير أراضى</option>
                      </select>
                  </div>
                  
                  <div class="col-sm-4">
                      <label>{{ __('Property Status')}}</label>
                      <select class="form-control select2" style="width: 100%;" name="status">
                          <option value="Available" {{ $property->status == 'Available' ? 'selected' : '' }}>{{ __('Available')}}</option>
                          <option value="Reserved" {{ $property->status == 'Reserved' ? 'selected' : '' }}>{{ __('Reserved')}}</option>
                          <option value="Sold" {{ $property->status == 'Sold' ? 'selected' : '' }}>{{ __('Sold')}}</option>
                      </select>
                  </div>
                  

                </div>

                <!-- Property Type, Property Category, Property Status -->
                <div class="row mb-3">
                    <!-- Populate these fields similarly -->
                </div>

                <!-- Property Description -->
                <div class="form-group">
                    <label for="description">{{ __('Property Description')}}</label>
                    <textarea class="form-control" name="description" id="description">{{ $property->description }}</textarea>
                </div>

                <!-- Notes -->
                <div class="form-group">
                    <label for="notes">{{ __('Notes')}}</label>
                    <textarea class="form-control" name="notes" id="notes">{{ $property->notes }}</textarea>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">{{ __('Price')}}</label>
                    <input type="text" name="price" class="form-control" id="price" value="{{ $property->price }}">
                </div>
  
                
              
              <div class="form-group">
                <label for="exampleInputFile">{{ __('Other Images')}}</label>
                <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg" accept="image/jpeg, image/jpg, image/gif, image/png" onchange="previewMultiImages(this)">
                <div id="multiPreview">

                  @php 


                  @endphp


@foreach($multiImages as $image)

                        <div class="preview-container">

                            <img src="{{ asset('upload/property/multi_img/' . $image->images) }}" class="preview-image" alt="Other Image" style="width:100px;">
                            <span class="delete-button" onclick="deleteImage(this)">❌</span>
                            

                        </div>
                        @endforeach
                </div>
            </div>
            
            <script>
                function previewMultiImages(input) {
                    var multiPreview = document.getElementById('multiPreview');
                    multiPreview.innerHTML = '';
                    if (input.files && input.files.length > 0) {
                        for (var i = 0; i < input.files.length; i++) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var container = document.createElement('div');
                                container.classList.add('preview-container');
                                
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.classList.add('preview-image');
                                container.appendChild(img);
                                
                                var deleteButton = document.createElement('span');
                                deleteButton.classList.add('delete-button');
                                deleteButton.innerHTML = '❌';
                                deleteButton.onclick = function() {
                                    container.remove();
                                };
                                container.appendChild(deleteButton);
                                
                                multiPreview.appendChild(container);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                }
            
                function deleteImage(element) {
    // Traverse up the DOM to find the parent container of the delete button
    var container = element.closest('.preview-container');
    if (container) {
        container.remove();
    }
}

            </script>
            
                <!-- Other Images -->
              
            </div> 

            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">{{ __('Update Offer')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
