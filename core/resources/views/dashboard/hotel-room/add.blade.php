@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
    <form method="post" action="{{route('admin.hotelRoom.create')}}" enctype="multipart/form-data">
        @csrf
        <input hidden name="hotel_id" value="{{$hotel->id}}" required class="form-control">
    <div class="padding">
        <div class="card ">
            <div class="box-header">
                <small>
                    <a href="{{route('admin.hotel.editOrCreate',$hotel->id).'?tab=RoomType'}}">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Go Back
                    </a>
                </small>
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
            <div class="col-md-2">
                <label>Maximum Extra Bed</label><br>
                <input type="number" name="max_extra_bed" value="{{old('max_extra_bed')}}" required class="form-control">
            </div>
            <div class="col-md-2">
                <label>Maximum Extra No Bed</label><br>
                <input type="number" name="max_extra_no_bed" value="{{old('max_extra_no_bed')}}" required class="form-control">
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">


                <label>Status</label><br>
                <select class="form-control" name="status" required>
                    <option value="1">active</option>
                    <option value="0">unactive</option>
                </select>


            </div>
        </div>



        <br>

        <div class="row p-l-1">
            <div class="col-md-7 box box-body  ">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Age Group">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Age From">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Age To">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Status">
                        </div>
                    </div>

                    <div class="row " style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Adult">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly  style="background-color: white" name="adult_age_start" value="{{$hotel->adult_age_start}}">

                        </div>

                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="adult_age_end" value="{{$hotel->adult_age_end}}">


                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >


                            <input name="is_adult" {{$hotel->is_adult=="1"?'checked':""}}  {{$hotel->is_adult=="0"?'disabled':""}}   type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Child">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control"  readonly style="background-color: white" name="child_age_start" value="{{$hotel->child_age_start}}">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="child_age_end" value="{{$hotel->child_age_end}}">

                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_child" {{$hotel->is_child=="1"?'checked':""}} {{$hotel->is_child=="0"?'disabled':""}}  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Toddler">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="toddler_age_start" value="{{$hotel->toddler_age_start}}">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="toddler_age_end" value="{{$hotel->toddler_age_end}}">

                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_toddler" {{$hotel->is_toddler=="1"?'checked':""}} {{$hotel->is_toddler=="0"?'disabled':""}}  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control"  readonly value="Infant">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="infant_age_start" value="{{$hotel->infant_age_start}}">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="infant_age_end" value="{{$hotel->infant_age_end}}">

                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_infant" {{$hotel->is_infant=="1"?'checked':""}} {{$hotel->infant=="0"?'disabled':""}}  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Senior">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="senior_age_start" value="{{$hotel->senior_age_start}}">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="senior_age_end" value="{{$hotel->senior_age_end}}">

                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input id="12w"  name="is_senior" {{$hotel->is_senior=="1"?'checked':""}} {{$hotel->is_senior=="0"?'disabled':""}}  class="mytoggle"  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>

                    <br>

                </div>


            </div>
            <div class="col-md-5">
                @include('fileUploader.image-card',['type'=>'roomType','item_id'=>"temp"])
            </div>



        </div>

<br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit"
                        class="btn dark p-x-md pull-right">{{ __('backend.create') }}</button>
            </div>
        </div>
        <br><br>

    </div>
        </div>
    </div>
    </form>
@endsection
