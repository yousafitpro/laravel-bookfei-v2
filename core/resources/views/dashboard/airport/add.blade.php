@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
    <form method="post" action="{{route('admin.airport.create')}}" enctype="multipart/form-data">
        @csrf

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <button type="submit"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
                    <small>
                        <a href="{{route('admin.airport.list')}}">
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
                            <input name="name" required class="form-control"><br>
                        </div>
                        <div class="col-md-6">
                            <label>English Name</label><br>
                            <input name="english_name" required class="form-control"><br>
                        </div>
                    </div>




                    <br>
                    <div class="row">

                        <div class="col-md-6 text-left">
                            <label>IATA Code</label><br>
                            <input name="IATA_code" required class="form-control"><br>
                        </div>
                        <div class="col-md-3 text-left">
                            <label>City</label><br>
                            <select class="form-control" name="city_id" required>
                                @foreach(\App\Helpers\Helper::Cities() as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-3 text-left">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1">active</option>
                                <option value="0">unactive</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6">

                        </div>

                    </div>
                    <br>
                </div>
            </div>
        </div>
    </form>
@endsection
