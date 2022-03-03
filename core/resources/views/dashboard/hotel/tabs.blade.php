@extends('dashboard.layouts.master')
@section('content')
    <div class="padding">
<div class="card ">
<div class="container-fluid">
    <br>
    <div class="row box-header">
        @if($_GET['tab']=="RoomType")
        <a href="#">
            <button href="javascript:void"
                    data-toggle="modal"
                    data-target="#m-add-room" ui-toggle-class="bounce" class="btn btn-dark pull-right">Add Room Type</button>
        </a>
        @endif
            @if($_GET['tab']=="RateTable")
                <a href="{{route('admin.hotelRateTable.editOrCreate',$hotel_id).'?tab=Basic&table_id=0'}}">
                    <button class="btn btn-dark pull-right" >Add Rate Table</button>
                </a>
            @endif
        <div class="col-md-12">
            <small>
                <a href="{{route('admin.hotel.list')}}">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Go Back
                </a>
            </small>
        </div>
    </div>
    @if($hotel_id!=0)
    <div class="row">
        <div class="col-md-12 p-l-2">
            <h6 style="color: grey">{{$hotel->name}}</h6>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <!-- Tab links -->
            <div class="mtab">
                <a href="{{route('admin.hotel.editOrCreate',$hotel_id).'?tab=Basic'}}">
                    <button class="mtablinks  {{$_GET['tab']=="Basic"?'active':''}}" >Basic</button>
                </a>
                <a href="{{route('admin.hotel.editOrCreate',$hotel_id).'?tab=RoomType'}}">
                    <button class="mtablinks {{$_GET['tab']=="RoomType"?'active':''}}">Room Type</button>
                </a>
                <a href="{{route('admin.hotel.editOrCreate',$hotel_id).'?tab=RateTable'}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Rate Table</button>
                </a>
            </div>
<br>
            <!-- Tab content -->
            <div id="Basic" class="mtabcontent {{$_GET['tab']=="Basic"?'mtabActive':''}}">

                @if($hotel_id==0)
                @include('dashboard.hotel.add-hotel')
                @else
                @include('dashboard.hotel.edit-hotel')
                @endif
            </div>

            <div id="RoomType" class="mtabcontent {{$_GET['tab']=="RoomType"?'mtabActive':''}}">
             @include('dashboard.hotel-room.list')

            </div>

            <div id="RateTable" class="mtabcontent {{$_GET['tab']=="RateTable"?'mtabActive':''}}">
           @include('dashboard.hotel.rate-table')
            </div>

        </div>
    </div>
</div>

</div>
    </div>
@endsection
