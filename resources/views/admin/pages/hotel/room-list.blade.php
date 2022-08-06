@extends('admin.layouts.my')
@section('content')

<div class="page-content">
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-md-12">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rooms List</li>
                    </ol>
                </nav>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"><h6 class="card-title">{{ __('Rooms List') }}</h6></div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-space-between float-right">
                                    <a href="{{ route('admin.hotel.room.form') }}" type="button" class="btn btn-primary ml-1"><i class="fa fa-pen"></i> {{  __('Create') }}</a>
                                    <button type="button" id="delete_btn" class="btn btn-danger ml-1"><i class="fa fa-trash-alt"></i> {{  __('Delete') }}</button>
                                    @include('layouts.filter')
                                </div>
                                
                            </div>
                        </div>    
                        <form class="form" method="post" id="form_assignee" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="assignee_row" id="assignee_row">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" onclick="$('input[name*=\'checkbox\']').prop('checked', this.checked);" /></th>                                            
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Price (per night)') }}</th>                                            
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Hotel') }}</th>
                                            <th>{{ __('Max Adult') }}</th>
                                            <th>{{ __('Max Child') }}</th>
                                            <th>{{ __('Booking Prefix') }}</th>
                                            <th>{{ __('Booking Expire') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Edit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $row)
                                                <tr>
                                                <td><input type="checkbox" name="checkbox[]" value="{{ $row->id }}" /></td>                                                
                                                <td>{{ $row->name }}</td>
                                                <td>₹ {{ $row->price }}</td>
                                                <td>{{ $row->quantity }}</td>
                                                <td>{{ $row->hotel_name }}</td>
                                                <td><i class="fas fa-male"></i> {{ $row->adult }}</td>
                                                <td><i class="fas fa-child"></i> {{ $row->child }}</td>                                                
                                                <td>{{ $row->booking_prefix }}</td>
                                                <td>{{date('d M, Y',strtotime($row->booking_till)) }}</td>
                                                <td>@if($row->status) {{ __('Enable') }} @else {{ __('Disable') }}@endif</td>                                                
                                                <td><a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('Edit')}}</a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                         <tr>
                                             <td colspan="11" class="text-center">{{ _('Oops! no result available') }}</td>
                                         </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-light p-4">
                        <div class="d-flex justify-content-end">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
@section('myscript')
<script>
    $(function(){
        $(document).on('click','#delete_btn',function(){
            $.confirm({
                title: 'Do you really want to delete?',
                content: 'All data maybe you lost.',
                type: 'danger',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'confirm',
                        btnClass: 'btn-danger',
                        action: function(){
                            $('#delete_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                            
                        }
                    },
                    close: function () {}
                }
            });
        });
});
</script>
@endsection