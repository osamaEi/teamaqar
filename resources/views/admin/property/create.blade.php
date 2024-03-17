@extends('admin.index')
@section('admin') 




<div class="col-md-12">

<div class="card card-success">
              <div class="card-header"  style="background: rgb(122, 165, 122)">
                <h3 class="card-title" style="  float: right;">{{ __('Create New Offer')}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('property.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-sm-4">
                      <label for="exampleInputEmail1">{{ __('Property Name')}}</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                
                    <div class="col-sm-4">
                      <label for="exampleInputPassword1">{{ __('Property No')}}</label>
                        <input type="number" name="number" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="col-sm-4">

                    
                 <label for="exampleInputEmail1">{{ __('Property Area')}}</label>

      <input type="text" name="area" class="form-control" id="exampleInputEmail1">

        </div>

                </div> 

                <div class="row mb-3">
                  
                  <div class="col-sm-4">

                  <label>{{ __('Property Type')}}</label>
                        <select class="form-control select2" style="width: 100%;" name="property_type">
                          <option value="أرض زراعية">أرض زراعية </option>
                          <option value="حوش">حوش </option>
                          <option value=" بيت شعبي  "> بيت شعبي  </option>
                        </select>
                      </div>

                      <div class="col-sm-4">

                        <label>{{ __('حالة تملك الارض')}}</label>
                              <select class="form-control select2" style="width: 100%;" name="land_situation">
                                <option value="أرض بصك">أرض بصك </option>
                                <option value="أرض باحكام">أرض باحكام </option>
                                <option value="أرض استثمار"> أرض استثمار  </option>
                                <option value="أرض بدون"> أرض بدون  </option>
                              </select>
                            </div>

                            <div class="col-sm-4">
                              <label for="exampleInputEmail1">{{ __('Location')}}</label>
                              <input type="text" name="location" class="form-control" id="exampleInputEmail1">
                          </div>
                          

                </div>

                   

                      <div class="form-group">
                        <label for="exampleInputFile">{{ __('Property Describtion')}}</label>
    
                
         
                  <textarea class="form-control"name="description">
                  </textarea>
             
          </div>
    
    
          
          <div class="form-group">
            <label for="exampleInputFile">{{ __('notes')}}</label>
    
    
    
            <textarea class="form-control"name="notes">
            </textarea>
    
    </div>
                
                <div class="row mb-3">
                
                  <div class="col-sm-4">
                    <label for="exampleInputEmail1">{{ __('Owner')}}</label>
                    <input type="text" name="owner" class="form-control" id="exampleInputEmail1">
                  </div>


                  <div class="col-sm-4">
                    <label for="exampleInputEmail1">{{ __('phone Owner')}}</label> 
                    <input type="text" name="ophone" class="form-control" id="exampleInputEmail1">
                  </div> 


                  <div class="col-sm-4">
                    <label>{{ __('Owner Status')}}</label>
                    <select class="form-control select2" style="width: 100%;" name="owner_status">
                      <option selected="مالك">مالك </option>
                      <option value="وكيل"> وكيل </option>
           
                    </select>
                  </div>

                </div>
                <div class="row mb-3">

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('mediator1')}}</label>
                    <input type="text" name="mediator1" class="form-control">
                  </div>

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('phone1')}}</label>
                    <input type="text" name="phone1" class="form-control" >
                  </div>

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('mediator2')}}</label>
                    <input type="text" name="mediator2" class="form-control">
                  </div>

                  <div class="col-sm-6">
                    <label for="exampleInputEmail1">{{ __('phone2')}}</label>
                    <input type="text" name="phone2" class="form-control" >
                  </div>
                </div>
                 
                    
                    <!-- In your view -->



                  





                    <div class="row mb-3">

                    


                            <div class="col-sm-4">
                              <label>{{ __('Property Category')}}</label>
                              <select class="form-control select2" style="width: 100%;" name="propery_cat">
                                <option value="أرض للبيع">أرض للبيع   </option>
                                <option value="منازل للبيع">منازل للبيع  </option>
                                <option value="استثمار للتقبيل"> استثمار للتقبيل  </option>
                              </select>
                            </div>

                            <div class="col-sm-4">
                              <label>{{ __('Property Status')}}</label>
                                <select class="form-control select2" style="width: 100%;" name="status">
                                  <option value="Available"> {{ __('Available')}} </option>
                                  <option value="Reserved">{{ __('Reserved')}} </option>
                                  <option value="Sold"> {{ __('Sold')}} </option>
                                </select>
                              </div>


                              
                    <div class="col-sm-4">
                      <label for="exampleInputEmail1">{{ __('Price')}}</label>
                       <input type="number" name="price" class="form-control" id="exampleInputEmail1">
                     </div>
                 
  
                    </div>


              



      


    <div class="form-group">
      <label for="exampleInputFile">{{ __('Other Images')}}</label>
      <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg" accept="image/jpeg, image/jpg, image/gif, image/png" onchange="previewMultiImages(this)">
      <div id="multiPreview"></div>
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
                      container.style.position = 'relative';
                      container.style.display = 'inline-block';
                      
                      var img = document.createElement('img');
                      img.src = e.target.result;
                      img.style.width = '300px';
                      img.style.height = '220px';
                      container.appendChild(img);
                      
                      var deleteButton = document.createElement('span');
                      deleteButton.style.position = 'absolute';
                      deleteButton.style.top = '5px';
                      deleteButton.style.right = '5px';
                      deleteButton.style.cursor = 'pointer';
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
  </script>
  
  

                </div> 







               













                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" style="background: rgb(122, 165, 122)">{{ __('Add New Offer +')}}</button>
                </div>
              </form>
            </div>


</div>












@endsection