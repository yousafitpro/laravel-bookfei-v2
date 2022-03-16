@extends('dashboard.layouts.master')
@section('content')
    <div class="padding">
<div class="card ">
<div class="container-fluid">
    <br>
    <div class="row box-header">
        @if($_GET['tab']=="Basic" && $tour_id==0 )
            <button onclick="document.getElementById('tourAddForm').submit()"
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
        @endif
            @if($_GET['tab']=="Basic" && $tour_id!=0 )
                <button onclick="document.getElementById('tourUpdateForm').submit()"
                        class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.update') }}</button>
            @endif


        <div class="col-md-12">
            <small>
                <a href="{{route('admin.tour.list')}}">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Go Back
                </a>
            </small>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <!-- Tab links -->
            <div class="mtab">
                <a href="{{route('admin.tour.editOrCreate',$tour_id).'?tab=Basic'}}">
                    <button class="mtablinks  {{$_GET['tab']=="Basic"?'active':''}}" >Basic</button>
                </a>
                <a href="{{route('admin.tourRate.list',$tour_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Rate Table</button>
                </a>
            </div>
            <br>
            <div>



            </div>
            <br>
<br>
            <!-- Tab content -->
            <div id="Basic" class="mtabcontent {{$_GET['tab']=="Basic"?'mtabActive':''}}">

                @if($tour_id==0)
                @include('dashboard.tour.add')
                @else
                @include('dashboard.tour.edit')
                @endif
            </div>



        </div>
    </div>
</div>

</div>
    </div>
@endsection

