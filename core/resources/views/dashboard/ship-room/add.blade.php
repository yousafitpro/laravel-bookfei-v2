@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
    <form method="post" action="{{route('admin.shipRoom.create')}}" enctype="multipart/form-data">
        @csrf
        <input hidden name="cruise_ship_id" value="{{$ship->id}}" required class="form-control">
    <div class="padding">
        <div class="card ">
            <div class="box-header">
                <button type="submit"
                        class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
                <small>
                    <a href="{{route('admin.cruiseShip.editOrCreate',$ship->id).'?tab=RoomType'}}">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Go Back
                    </a>
                </small>
                <br>
                        <h6 style="color: grey">
                            <label>Ship:  {{$ship->name}}</label><small></small>

                        </h6>

            </div>
    <div class="container-fluid">
        {{--                            <div class="row">--}}
        {{--                                <div class="col-md-6 offset-md-3 text-center">--}}
        {{--                                    <h3>{{\App\Helpers\Helper::get_Hotel($hotel_id)->name}}</h3>--}}
        {{--                                    <hr>--}}
        {{--                                    <br>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        <div class="row">
            <div class="col-md-4">
                <label>Room Name</label><br>
                <input name="name" value="{{old('name')}}" required class="form-control">
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
                <label>Default Guest</label><br>

                <input type="number" name="default_guest" value="{{old('default_guest')}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Maximum Guest</label><br>
                <input type="number" name="max_guest" value="{{old('max_guest')}}" required class="form-control">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                @include('fileUploader.image-card',['type'=>'shipRoomType','item_id'=>"temp"])
            </div>


            <div class="col-md-6">
                <label>Status</label><br>
                <select class="form-control" name="status" required>
                    <option value="1">active</option>
                    <option value="0">unactive</option>
                </select>
            </div>
            <div class="col-md-3">





            </div>
        </div>



        <br>



<br>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <br><br>

    </div>
        </div>
    </div>
    </form>
@endsection
