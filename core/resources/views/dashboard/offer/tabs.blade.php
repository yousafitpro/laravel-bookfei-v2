@extends('dashboard.layouts.master')
@section('title')
@section('title', 'Tour')
@endsection
@section('content')
    <div class="padding">
<div class="card ">
<div class="container-fluid">

    <div class="row box-header">

        <small>
            <a href="{{route('admin.tour.list')}}">
                <i class="fa fa-arrow-circle-left pull-left" aria-hidden="true"></i>
                Go Back
            </a>
        </small>
        @if($_GET['tab']=="Basic" && $offer_id==0 )
            <button  onclick="addTour('{{route('admin.tour.list')}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="addTour('')"
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
        @endif
            @if($_GET['tab']=="Basic" && $offer_id!=0 )
            <button  onclick="editTour('{{route('admin.tour.list')}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="editTour('')"
                        class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
            @endif

        <div class="row">
            <div class="col-md-12 p-l-2">
                <h5 style="font-weight: bold">Promotion Offer </h5>


            </div>
        </div>

    </div>
{{--//sdsd--}}

    <div class="row">
        <div class="col-md-12">
            <!-- Tab links -->
            <div class="mtab">
                <a href="{{route('admin.tour.editOrCreate',$offer_id).'?tab=Basic'}}">
                    <button class="mtablinks  {{$_GET['tab']=="Basic"?'active':''}}" >Basic</button>
                </a>
                <a href="{{route('admin.tourRate.list',$offer_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Hotel</button>
                </a>
                <a href="{{route('admin.tourRate.list',$offer_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Flight</button>
                </a>
                <a href="{{route('admin.tourRate.list',$offer_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Cruise</button>
                </a>
                <a href="{{route('admin.tourRate.list',$offer_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Tour</button>
                </a>
                <a href="{{route('admin.tourRate.list',$offer_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Content</button>
                </a>     <a href="{{route('admin.tourRate.list',$offer_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="RateTable"?'active':''}} ">Image</button>
                </a>

            </div>
            <br>
            <div>



            </div>

            <!-- Tab content -->
            <div id="Basic" class="mtabcontent {{$_GET['tab']=="Basic"?'mtabActive':''}}">

                @if($offer_id==0)
                @include('dashboard.offer.add')
                @else
                @include('dashboard.offer.edit')
                @endif
            </div>



        </div>
    </div>
</div>

</div>
    </div>
    <script>
        function editTour(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('tourUpdateForm').submit()
        }
        function addTour(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('tourAddForm').submit()
        }
    </script>
@endsection

