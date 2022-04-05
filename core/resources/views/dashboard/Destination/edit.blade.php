@extends('dashboard.layouts.master')
@section('title', "Update Currency")
@section('content')
    <form method="post" action="{{route('admin.destination.update',$Banner->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <button type="submit"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.update') }}</button>
                    <small>
                        <a href="{{route('admin.destination.list')}}">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Go Back
                        </a>
                    </small>
                    <br>


                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label><br>
                            <input name="name" value="{{$Banner->name}}" required class="form-control"><br>
                        </div>
                        <div class="col-md-6 text-left">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1" {{$Banner->status=='1'?'selected':''}}>active</option>
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
