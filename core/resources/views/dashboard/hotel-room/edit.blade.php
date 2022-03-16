@extends('dashboard.layouts.master')
@section('title', "Edit Room Type")
@section('content')
    <form method="post" action="{{route('admin.hotelRoom.update',$Banner->id)}}" enctype="multipart/form-data">
        @csrf
    <div class="padding">
        <div class="card ">
            <div class="box-header">
                <button type="submit"
                        class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.update') }}</button>

                <small>
                    <a href="{{route('admin.hotel.editOrCreate',$Banner->hotel_id).'?tab=RoomType'}}">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Go Back
                    </a>
                    <br>

                </small>
                <br>
                <h2 style="font-weight: bold">Hotel Room</h2>
                <br>
                <h6 style="color: grey">
                    <label>Hotel:  {{$hotel->name}}</label><small></small>

                </h6>
            </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label>Room Name</label><br>
                <input name="name" value="{{$Banner->name}}" required class="form-control">
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
                <label>Default Guest</label><br>

                <input type="number" name="default_guest" value="{{$Banner->default_guest}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Maximum Guest</label><br>
                <input type="number" name="max_guest" value="{{$Banner->max_guest}}" required class="form-control">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-2">
                <label>Maximum Extra Bed</label><br>
                <input type="number" name="max_extra_bed" value="{{$Banner->max_extra_bed}}" required class="form-control">
            </div>
            <div class="col-md-2">
                <label>Maximum Extra No Bed</label><br>
                <input type="number" name="max_extra_no_bed" value="{{$Banner->max_extra_no_bed}}" required class="form-control">
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-3">


                <label>Status</label><br>
                <select value="{{$Banner->status}}" class="form-control" name="status" required>

                    <option value="1">active</option>
                    <option value="0">unactive</option>
                </select>
            </div>
            <div class="col-md-3">



            </div>
        </div>



        <br>
        <label>No Extra Bed Age Group</label>
        <div class="row p-l-1">
            <div class="col-md-7 box box-body ">

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
                            <input class="form-control" readonly style="background-color: white" name="adult_age_start" value="{{$Banner->adult_age_start}}">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="adult_age_end" value="{{$Banner->adult_age_end}}">
                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_adult" {{$Banner->is_adult=="1"?'checked':""}} {{$hotel->is_adult=="0"?'disabled':""}}  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Child">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="child_age_start" value="{{$hotel->child_age_start}}">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" readonly style="background-color: white" name="child_age_end" value="{{$hotel->child_age_end}}">
                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_child" {{$Banner->is_child=="1"?'checked':""}} {{$hotel->is_child=="0"?'disabled':""}}   type="checkbox" style="zoom:1.6">
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

                            <input name="is_toddler" {{$Banner->is_toddler=="1"?'checked':""}} {{$hotel->is_toddler=="0"?'disabled':""}}  type="checkbox" style="zoom:1.6">
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

                            <input name="is_infant" {{$Banner->is_infant=="1"?'checked':""}} {{$hotel->is_infant=="0"?'disabled':""}} type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Senior">

                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="senior_age_start" readonly style="background-color: white" value="{{$hotel->senior_age_start}}">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="senior_age_end" readonly style="background-color: white" value="{{$hotel->senior_age_end}}">

                        </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input id="12w"  name="is_senior" {{$Banner->is_senior=="1"?'checked':""}} {{$hotel->is_senior=="0"?'disabled':""}}  class="mytoggle"  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>

                    <br>

                </div>


            </div>
            <div class="col-md-5">
                @include('fileUploader.image-card',['type'=>'roomType','item_id'=>$Banner->id])
            </div>



        </div>
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
