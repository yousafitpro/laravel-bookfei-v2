@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
    <form method="post" action="{{route('admin.currency.update',$Banner->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <button type="submit"
                            class="btn dark p-x-md pull-right">{{ __('backend.update') }}</button>
                    <small>
                        <a href="{{route('admin.currency.list')}}">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Go Back
                        </a>
                    </small>
                    <br>


                </div>
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6 text-left">
                            <label>Name</label><br>
                            <input name="name" value="{{$Banner->name}}" required class="form-control"><br>

                        </div>
                        <div class="col-md-6">
                            <label>Exchange Rate</label><br>
                            <input type="number" step="any" name="exchange_rate" value="{{$Banner->exchange_rate}}" required class="form-control"><br>
                        </div>

                    </div>



                    <br>
                    <div class="row">

                        <div class="col-md-6">

                            <label>Base</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1" {{$Banner->status=='Yes'?'selected':''}} >Yes</option>
                                <option value="0" {{$Banner->status=='No'?'selected':''}}>No</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1" {{$Banner->status=='1'?'selected':''}} >active</option>
                                <option value="0" {{$Banner->status=='0'?'selected':''}}>unactive</option>
                            </select>
                        </div>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </form>
@endsection
