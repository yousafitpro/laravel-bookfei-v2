@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

    <div class="padding">
        <div class="card" style="padding: 4px">
            <div class="box-header ">
                <h2 style="color: grey">Travel Product Listing</h2>
                <br>
                <a href="{{route('admin.travel_product.editOrCreate',0).'?tab=Basic'}}">
                    <button class="btn dark pull-left">Add Travel Product</button>
                </a>
                <a href="javascrip:void" onclick="hotelBulkDelete()">
                    <button class="btn btn-danger pull-right" id="btnHotelRemove">Remove</button>
                </a>




            </div>
            <br>
            <br>
            <br>



            <div class="container-fluid">
                <form method="get" action="{{route('admin.travel_product.list')}}">
                    <div class="row">
                        <div class="col-md-2">
                            <input name="searchWord" placeholder="Travel Product Name" class="form-control" value="{{session('searchWord','')}}">
                        </div>
                        <div class="col-md-1">
                            <input name="searchCode" placeholder="Code" class="form-control" value="{{session('searchCode','')}}">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control dark" name="searchType">
                                <option value="none" >Product Type</option>
                                @foreach(['Multi Offers','Single Offer'] as $c)
                                    <option value="{{$c}}" {{session('searchType','')==$c?'selected':''}} >{{$c}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control dark" name="searchCategory">
                                <option value="none" >Category</option>
                                @foreach(\App\Helpers\Helper::Categories() as $c)
                                    <option value="{{$c->id}}" {{session('searchCategory','')==$c->id?'selected':''}} >{{$c->name}}</option>
                                @endforeach

                            </select>                        </div>
                        <div class="col-md-2">
                            <select class="form-control dark" name="searchDestination">
                                <option value="none" >Destination</option>
                                @foreach(\App\Helpers\Helper::Destinations() as $c)
                                    <option value="{{$c->id}}" {{session('searchDestination','')==$c->id?'selected':''}} >{{$c->name}}</option>
                                @endforeach

                            </select>                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn dark btn-block">Filter</button>
                        </div>
                        <div class="col-md-1">
                            <a href="{{route('admin.travel_product.clear_filter')}}" class="btn dark btn-block">Clear</a>
                        </div>
                    </div>
                </form>
                <br>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered m-a-0">
                    <thead class="dker">
                    <tr>

                        <th class=" width50"></th>
                        <th class="text-center width50">Travel Product Name</th>
                        <th class="text-center width50">{{ __('backend.code') }}</th>
                        <th class="text-center width50">{{ __('backend.product_type') }}</th>
                        <th class="text-center width50">{{ __('backend.category') }}</th>
                        <th class="text-center width50">{{ __('backend.destination') }}</th>
{{--                        <th class="text-center width50">{{ __('backend.code') }}</th>--}}
{{--                        <th class="text-center width50">{{ __('backend.currency') }}</th>--}}
{{--                        <th class="text-center width50">{{ __('backend.supplier') }}</th>--}}
                        <th class="text-center width50">{{ __('backend.status') }}</th>
                        <th class="text-center width200">{{ __('backend.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $title_var = "title_" . @Helper::currentLanguage()->code;
                    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                    ?>
                    @foreach($list as $Banner)
                        <?php
                        if ($Banner->$title_var != "") {
                            $title = $Banner->$title_var;
                        } else {
                            $title = $Banner->$title_var2;
                        }
                        ?>
                        <tr>

                            <td class="">
                                <input type="checkbox"  data-id="{{$Banner->id}}" id="hotelCheckBox" style="zoom:1.2">
                            </td>
                            <td class="text-left">
                                <label>{{$Banner->name}}</label>
                            </td>
                            <td class="text-center">
                                <label>{{$Banner->code}}</label>
                            </td>
                            <td class="text-center">
                                <label>{{$Banner->type}}</label>
                            </td>
                            <td class="text-center">
                                @foreach($Banner->category as $c)
                                <label>{{\App\Helpers\Helper::get_Category($c)->name}}</label>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach($Banner->destination as $c)

                                <label>{{\App\Helpers\Helper::get_Destination($c)->name}}</label>
                                @endforeach
                            </td>
{{--                            <td class="text-center">--}}
{{--                                <label>{{$Banner->code}}</label>--}}
{{--                            </td>--}}
{{--                            <td class="text-center">--}}
{{--                                <label>{{\App\Helpers\Helper::get_Currency($Banner->currency_id)->name}}</label>--}}
{{--                            </td>--}}
{{--                            <td class="text-center">--}}
{{--                                <label>{{\App\Helpers\Helper::get_Supplier($Banner->supplier_id)->name}}</label>--}}
{{--                            </td>--}}

                            <td class="text-center">
                                <i class="fa {{ ($Banner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                            </td>
                            <td class="text-center">
                                @if(@Auth::user()->permissionsGroup->edit_status)

                                    <a href="{{route('admin.travel_product.editOrCreate',$Banner->id).'?tab=Basic'}}">

                                        <button class="btn btn-sm dark" >
                                            <small><i class="fa fa-edit" aria-hidden="true"></i> {{ __('backend.edit') }}
                                            </small>
                                        </button>
                                    </a>
                                @endif


{{--                                @if(@Auth::user()->permissionsGroup->delete_status)--}}
{{--                                    <button class="btn btn-sm warning" data-toggle="modal"--}}
{{--                                            data-target="#m-{{ $Banner->id }}" ui-toggle-class="bounce"--}}
{{--                                            ui-target="#animate">--}}
{{--                                        <small><i class="material-icons">&#xe872;</i> {{ __('backend.delete') }}--}}
{{--                                        </small>--}}
{{--                                    </button>--}}
{{--                                @endif--}}

                            </td>
                        </tr>

                        <!-- .modal -->
                        <div id="m-{{ $Banner->id }}" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog" id="animate">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                    </div>
                                    <div class="modal-body text-center p-lg">
                                        <p>
                                            {{ __('backend.confirmationDeleteMsg') }}
                                            <br>
                                            <strong> {{ $Banner->name }} </strong>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn dark-white p-x-md"
                                                data-dismiss="modal">{{ __('backend.no') }}</button>
                                        <a href="{{ route("admin.travel_product.delete",["id"=>$Banner->id]) }}"
                                           class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div>
                        </div>
                        <!-- / .modal -->
                    @endforeach
                    <!-- .modal -->

                    <!-- / .modal -->
                    </tbody>
                </table>

            </div>




        </div>
    </div>


@endsection
@push("after-scripts")

    <script type="text/javascript">

        function hotelBulkDelete() {
            var checkboxes = document.querySelectorAll('input[id="hotelCheckBox"]');
            var tempArray=[];
            for (var checkbox of checkboxes) {

                if (checkbox.checked)
                {
                    tempArray.push(checkbox.getAttribute('data-id'))
                }

            }

            console.log(tempArray)
            if (tempArray.length>0)
            {
                $("#btnHotelRemove").text("Removing...")
                $.ajax({
                    type:'post',
                    url:'{{route('admin.travel_product.deleteBulk')}}',
                    data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                    success:function(data){
                        console.log(data)
                        window.location.reload()
                    }})
            }
        }

    </script>
@endpush
