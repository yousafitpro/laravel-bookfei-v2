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
            <a href="{{url('admin/travel-product/list')}}">
                <i class="fa fa-arrow-circle-left pull-left" aria-hidden="true"></i>
                Go Back
            </a>
        </small>

        @if($_GET['tab']=="Basic" && $product_id==0 )
            <button  onclick="addTour('{{url('admin/travel-product/list')}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="addTour('')"
                    class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
        @endif
            @if($_GET['tab']=="Basic" && $product_id!=0 )
            <button  onclick="editTour('{{url('admin/travel-product/list')}}')"
                     class="btn dark p-x-md pull-right  m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close </button>

            <button onclick="editTour('')"
                        class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
            @endif
<br>
        <div class="row">
            <div class="col-md-12 p-l-2">
                <h5 style="font-weight: bold">Travel Product </h5>


            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <!-- Tab links -->
            <div class="mtab">
                <a href="{{route('admin.travel_product.editOrCreate',$product_id).'?tab=Basic'}}">
                    <button class="mtablinks  {{$_GET['tab']=="Basic"?'active':''}}" >Basic</button>
                </a>
                <a href="{{route('admin.travel_product.editOrCreate',$product_id).'?tab=Offers'}}">
                    <button class="mtablinks {{$_GET['tab']=="Offers"?'active':''}} ">Offers</button>
                </a>
                <a href="{{route('admin.travel_product.list',$product_id)}}">
                    <button class="mtablinks {{$_GET['tab']=="Basic2"?'active':''}} ">Content</button>
                </a>
                <a href="{{route('admin.travel_product.editOrCreate',$product_id).'?tab=Image'}}">
                    <button class="mtablinks {{$_GET['tab']=="Image"?'active':''}} ">Image</button>
                </a>
            </div>
            <br>
            <div>



            </div>
            <!-- Tab content -->
            <div id="Basic" class="mtabcontent {{$_GET['tab']=="Offers"?'mtabActive':''}}">


                    @include('dashboard.travel_product.offers')

            </div>
            <!-- Tab content -->
            <div id="Basic" class="mtabcontent {{$_GET['tab']=="Basic"?'mtabActive':''}}">

                @if($product_id==0)
                @include('dashboard.travel_product.add')
                @else
                @include('dashboard.travel_product.edit')
                @endif
            </div>
            <div id="Basic" class="mtabcontent {{$_GET['tab']=="Image"?'mtabActive':''}}">
                @if($product_id==0)
                @include('fileUploader.image-card',['type'=>'travel_product','item_id'=>"temp"])
                @else
                    @include('fileUploader.image-card',['type'=>'travel_product','item_id'=>$product_id])

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

