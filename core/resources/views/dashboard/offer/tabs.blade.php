@extends('dashboard.layouts.master')
@section('title')
@section('title', 'Offer')
@endsection
@section('content')
    <div class="padding">
<div class="card ">
<div class="container-fluid">

    <div class="row box-header">

        <small>
            <a href="{{route('admin.offer.list')}}">
                <i class="fa fa-arrow-circle-left pull-left" aria-hidden="true"></i>
                Go Back
            </a>
        </small>
        @if($_GET['tab']=="Content" && $offer_id!=0 )
            <button
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>

        @endif
        @if($_GET['tab']=="Hotel" && $offer_id!=0 )
            <button  onclick="HotelRedirect('{{url("admin/offer/list")}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="HotelRedirect('{{route('admin.offer.editOrCreate',$offer_id).'?tab=Hotel'}}')"
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>

        @endif
        @if($_GET['tab']=="Flight" && $offer_id!=0 )
            <button  onclick="flightRedirect('{{url("admin/offer/list")}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="flightRedirect('{{route('admin.offer.editOrCreate',$offer_id).'?tab=Flight'}}')"
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>

        @endif
            @if($_GET['tab']=="Basic" && $offer_id!=0 )
            <button  onclick="editOffer('{{url("admin/offer/list")}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="editOffer('{{route('admin.offer.editOrCreate',$offer_id).'?tab=Basic'}}')"
                        class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
            @endif
        @if($_GET['tab']=="Basic" && $offer_id==0 )
            <button  onclick="addOffer('{{url("admin/offer/list")}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="addOffer('')"
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
        @endif
<br>
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
                <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Basic'}}">
                    <button class="mtablinks  {{$_GET['tab']=="Basic"?'active':''}}" >Basic</button>
                </a>
                <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Hotel'}}">
                    <button class="mtablinks {{$_GET['tab']=="Hotel"?'active':''}} ">Hotel</button>
                </a>
                <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Flight'}}">
                    <button class="mtablinks {{$_GET['tab']=="Flight"?'active':''}} ">Flight</button>
                </a>
                <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Cruise'}}">
                    <button class="mtablinks {{$_GET['tab']=="Cruise"?'active':''}} ">Cruise</button>
                </a>
                <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Tour'}}">
                    <button class="mtablinks {{$_GET['tab']=="Tour"?'active':''}} ">Tour</button>
                </a>
                <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Content'}}">
                    <button class="mtablinks {{$_GET['tab']=="Content"?'active':''}} ">Content</button>
                </a>     <a href="{{route('admin.offer.editOrCreate',$offer_id).'?tab=Image'}}">
                    <button class="mtablinks {{$_GET['tab']=="Image"?'active':''}} ">Image</button>
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
            <div id="Image" class="mtabcontent {{$_GET['tab']=="Image"?'mtabActive':''}}">
                @if($offer_id==0)
                    @include('fileUploader.image-card',['type'=>'offer','item_id'=>"temp"])
                @else
                    @include('fileUploader.image-card',['type'=>'offer','item_id'=>$offer_id])

                @endif
            </div>
            <div id="Hotel" class="mtabcontent {{$_GET['tab']=="Hotel"?'mtabActive':''}}">
             @include('dashboard.offer.hotel')
                <br>
                <br>
            </div>
            <div id="Hotel" class="mtabcontent {{$_GET['tab']=="Flight"?'mtabActive':''}}">
                @include('dashboard.offer.flight')
                <br>
                <br>
            </div>
            <div id="Hotel" class="mtabcontent {{$_GET['tab']=="Tour"?'mtabActive':''}}">
                @include('dashboard.offer.tour')
                <br>
                <br>
            </div>
            <div id="Hotel" class="mtabcontent {{$_GET['tab']=="Content"?'mtabActive':''}}">
                @include('dashboard.offer.content')
                <br>
                <br>
            </div>



        </div>
    </div>
</div>

</div>
    </div>
    <script>

        function addOffer(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('tourAddForm').submit()
        }
        function editOffer(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('tourUpdateForm').submit()
        }

        function HotelRedirect(url)
        {


            $("#redirectUrlforHotel").val(url)

            document.getElementById('hotelForm').submit()
        }
        function flightRedirect(url)
        {


            $("#redirectUrlforFlight").val(url)

            document.getElementById('flightForm').submit()
        }
    </script>
@endsection

