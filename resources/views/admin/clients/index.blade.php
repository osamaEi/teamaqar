@extends('admin.index')
@section('admin') 

<style>
.action-buttons {
    position: absolute;
    top: 0;
    right: 0;
    padding: 5px;
    display: flex;
    flex-direction: row;
}

.close-btn, .btn-warning {
    margin-left: 5px;
}


</style>



    @foreach($properties as $property)
    <div class="col-md-3">
        <div class="card position-relative" >
            @if(isset($multiImages[$property->id]) && $multiImages[$property->id]->isNotEmpty())
            <img src="{{ asset('upload/property/multi_img/' . $multiImages[$property->id]->first()->images) }}" class="card-img-top" alt="Property Image" style="height: 198px;">
        @else
            <!-- Provide a default image or alternative content -->
            <img src="{{ asset('path_to_default_image.jpg') }}" class="card-img-top" alt="Default Image" style="height: 198px;">
        @endif            <div class="card-body">
                <h4 class="" style="font-size: 20px;">
                    <b>{{ $property->name }}</b>
                    <span class="btn {{ $property->status === 'Sold' ? 'btn-danger' : 'btn-success' }}" style="font-size: 13px; padding: 0px;">
                        {{ __($property->status) }}
                    </span>


                                    </h4>

                
                                    <span style=" font-size:15px;  color: dodgerblue;"  ><b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                      </svg>{{$property->location}}</b></span>
                
                <p style="padding-top:25px;"class="card-text">{{ __('Price')}}:{{$property->price}} $ </p>
                <a href="{{ route('clients.show',$property->id)}}" class="btn btn-success outline">{{ __('Read More')}}</a>
                <div class="action-buttons">
                    <form action="{{ route('property.destroy', $property->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="close-btn">X</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endforeach

{{ $properties->links() }}




@endsection
