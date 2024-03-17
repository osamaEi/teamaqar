@extends('admin.index')
@section('admin') 

<div class="filter-div d-flex justify-content-between" style="padding-bottom: 20px; padding-left: 32px; ">
  <div class="col-md-6">
    <form method="post" action="{{ route('requests.applyAction') }}" class="filter-form filter-form-left d-flex justify-content-start" id="clientForm" onclick="applyAction()">
      @csrf
      <input type="hidden" name="selectedIds" id="selectedIds" value="">
      <select name="traking_client" class="form-control" style="width: 250px;">
        <option value=""> {{ __('Choose Action')}} </option>
        @foreach(['لم يتم البدء فى الاجراءات', 'الاتصال بالعميل', 'جاري توفير عروض له', 'تم ارسال العروض له', 'تحديد موعد لمشاهده العروض', 'دفع عربون وحجز العرض', 'اغلاق طلب العميل'] as $option)
        @php
        // Assigning light background colors based on the option value
        $backgroundColor = '';
        switch($option) {
            case 'لم يتم البدء فى الاجراءات':
                $backgroundColor = '#FFCCCC'; // Light red
                break;
            case 'الاتصال بالعميل':
                $backgroundColor = '#CCCCFF'; // Light blue
                break;
            case 'جاري توفير عروض له':
                $backgroundColor = '#CCFFCC'; // Light green
                break;
            case 'تم ارسال العروض له':
                $backgroundColor = '#FFD699'; // Light orange
                break;
            case 'تحديد موعد لمشاهده العروض':
                $backgroundColor = '#E6CCFF'; // Light purple
                break;
            case 'دفع عربون وحجز العرض':
                $backgroundColor = '#FFFFCC'; // Light yellow
                break;
            case 'اغلاق طلب العميل':
                $backgroundColor = '#E6E6E6'; // Light gray
                break;
            default:
                $backgroundColor = ''; // Default background color if none matches
        }
    @endphp
            <option value="{{ $option }}" style="background-color: {{ $backgroundColor }}">{{ $option }}</option>
        @endforeach
    </select>
    
    
      <button class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit"   style="margin-right: 21px;">تغيير اجراء</button>
    </form>
  </div>
</div>
<br>
<div class="filter-div d-flex justify-content-between" style="padding-left: 32px;">
  <div class="col-md-6">
    <form method="post" action="{{ route('requests.applyTime') }}" class="filter-form filter-form-left d-flex justify-content-start" id="clientFormTime" onclick="applyTime()">
      @csrf
      <input type="hidden" name="selectedIds" id="selectedIdsTime" value="">
      <input type="datetime-local" name="contact_datetime" class="form-control"  style="  width: 250px;">
      <button class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit" style="margin-right: 20px;">تحديد موعد</button>
    </form>
  </div>
</div>

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="float:right;">{{ __('Clients Table')}}</h3>
    </div>
    <form action="" class="bravo-form-item">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width=""><input type="checkbox" class="check-all" onclick="toggleCheckboxes()"></th>
              <th class="title">{{ __('Name')}}</th>
              <th width="">{{ __('Phone')}}</th>
              <th width="">{{ __('Type')}}</th>
              <th width="">{{ __('Request')}}</th>
              <th width="">{{ __('Action')}}</th>
              <th width="">{{ __('Schedule Time')}}</th>
              <th width="">{{ __('Actions')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($requests as $request)


            @php
            // Assigning light background colors based on the option value
            $backgroundColor = '';
            switch($request->traking_client) {
                case 'لم يتم البدء فى الاجراءات':
                    $backgroundColor = '#FFCCCC'; // Light red
                    break;
                case 'الاتصال بالعميل':
                    $backgroundColor = '#CCCCFF'; // Light blue
                    break;
                case 'جاري توفير عروض له':
                    $backgroundColor = '#CCFFCC'; // Light green
                    break;
                case 'تم ارسال العروض له':
                    $backgroundColor = '#FFD699'; // Light orange
                    break;
                case 'تحديد موعد لمشاهده العروض':
                    $backgroundColor = '#E6CCFF'; // Light purple
                    break;
                case 'دفع عربون وحجز العرض':
                    $backgroundColor = '#FFFFCC'; // Light yellow
                    break;
                case 'اغلاق طلب العميل':
                    $backgroundColor = '#E6E6E6'; // Light gray
                    break;
                default:
                    $backgroundColor = ''; // Default background color if none matches
            }
        @endphp
            <tr>
              <td>
                <input type="checkbox" class="check-item" name="selectedIds[]" value="{{ $request->id }}">
              </td>
              <td class="title">
                <a href="{{ route('requests.show',$request->id)}}">{{ $request->client_name }}</a>
              </td>
              <td>{{ $request->client_phone }}</td>
              <td>{{ $request->client_type }}</td>
              <td>{{ $request->request_name }}</td>
              <td>
                <span class="badge badge-draft" style="background-color: {{ $backgroundColor }};">
                    {{ $request->traking_client }}
                </span>
            </td>
            
            <td>
              @php 
                  $event = \App\Models\Event::where('request_id', $request->id)->first();
              @endphp
             
                @if($event && isset($event->start))
                    {{ \Carbon\Carbon::parse($event->start)->locale('ar')->isoFormat('dddd DD/MM الساعة h a') }}
                @else
                    لم يتم تحديد وقت
                @endif
            </td>
              
          
          </td>
              <td> <form action="{{ route('requests.destroy', $request->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <button type="submit" class="close-btn">X</button>
            </form></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </form>
  </div>
</div>

{{ $requests->links() }}

<script>
  function applyAction() {
    var selectedIds = [];

    // Iterate over the checked checkboxes and push their values into the selectedIds array
    $('.check-item:checked').each(function () {
        selectedIds.push($(this).val());
    });

    // Set the value of the hidden input field with the selectedIds
    $('#selectedIds').val(selectedIds.join(','));
  }

  function applyTime() {
    var selectedIdsTime = [];

    // Iterate over the checked checkboxes and push their values into the selectedIdsTime array
    $('.check-item:checked').each(function () {
        selectedIdsTime.push($(this).val());
    });

    // Set the value of the hidden input field with the selectedIdsTime
    $('#selectedIdsTime').val(selectedIdsTime.join(','));
  }

  function toggleCheckboxes() {
    var checkAllCheckbox = document.querySelector('.check-all');
    var checkboxes = document.querySelectorAll('.check-item');

    checkboxes.forEach(function (checkbox) {
      checkbox.checked = checkAllCheckbox.checked;
    });
  }



  function displayMessage(message) {
                
                toastr.success(message, 'Event');
            
  } 
            

</script>



@endsection
