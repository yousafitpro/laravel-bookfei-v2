@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
    <form method="post" action="{{route('admin.airline.update',$Banner->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <button type="submit"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.update') }}</button>
                    <small>
                        <a href="{{route('admin.airline.list')}}">
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
                        <div class="col-md-6 ">
                            <label>English Name</label><br>
                            <input name="english_name" value="{{$Banner->english_name}}" required class="form-control"><br>

                        </div>

                    </div>



                    <br>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Image</label><br>
                            <input name="file" type="file"  class="form-control"><br>

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
