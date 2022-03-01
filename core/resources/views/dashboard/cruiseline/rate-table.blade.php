@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

    <div class="padding">
        <div class="card" style="padding: 4px">
            <div class="box-header ">
                <h3>{{ __('backend.table') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{route('admin.cruiseLine.list')}}">{{ __('backend.cruiseLines') }}</a> /
                    <a href="{{route('admin.cruiseShip.list',$id)}}">{{ __('backend.ships') }}</a> /
                    <a href="javascript:void">{{ __('backend.table') }}</a>
                </small>
                <br>
                <div>
                    <a  class="btn btn-fw btn-outline-primary marginBottom5"
                        href="{{route("admin.tour.list")}}">{{ __('backend.all') }} {{ __('backend.tables') }}</a>
                    <a  class="btn btn-fw btn-outline-primary marginBottom5"
                        href="{{route("admin.tour.list")."?status=1"}}">{{ __('backend.active') }} {{ __('backend.tables') }}</a>
                    <a class="btn btn-fw btn-outline-primary marginBottom5"
                       href="{{route("admin.tour.list")."?status=0"}}">{{ __('backend.unactive') }} {{ __('backend.tables') }}</a>
                </div>
            </div>




            <div class="table-responsive">
                <table class="table table-bordered m-a-0" id="myTable">
                    <thead class="dker">
                    <tr>
                        {{--                            <th class="width20 dker">--}}
                        {{--                                <label class="ui-check m-a-0">--}}
                        {{--                                    <input id="checkAll" type="checkbox"><i></i>--}}
                        {{--                                </label>--}}
                        {{--                            </th>--}}

                        <th class="text-center width50">{{ __('backend.name') }}</th>
                        <th class="text-center width50">{{ __('backend.code') }}</th>
                        <th class="text-center width50">{{ __('backend.currency') }}</th>
                        <th class="text-center width50">{{ __('backend.supplier') }}</th>
                        <th class="text-center width50">{{ __('backend.status') }}</th>
                        <th class="text-center width200">{{ __('backend.options') }}</th>
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
                            {{--                                <td class="dker">--}}
                            {{--                                    <label class="ui-check m-a-0">--}}
                            {{--                                        <input type="checkbox" name="ids[]" value="{{ $Banner->id }}"><i--}}
                            {{--                                            class="dark-white"></i>--}}
                            {{--                                        {!! Form::hidden('row_ids[]',$Banner->id, array('class' => 'form-control row_no')) !!}--}}
                            {{--                                    </label>--}}
                            {{--                                </td>--}}

                            <td class="text-center">
                                <label>{{$Banner->name}}</label>
                            </td>
                            <td class="text-center">
                                <label>{{$Banner->code}}</label>
                            </td>
                            <td class="text-center">
                                <label>{{\App\Helpers\Helper::get_Currency($Banner->currency_id)->name}}</label>
                            </td>
                            <td class="text-center">
                                <label>{{\App\Helpers\Helper::get_Supplier($Banner->supplier_id)->name}}</label>
                            </td>

                            <td class="text-center">
                                <i class="fa {{ ($Banner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                            </td>
                            <td class="text-center">
                                @if(@Auth::user()->permissionsGroup->edit_status)
                                    <a class="btn btn-sm success" data-toggle="modal"
                                       data-target="#u-{{ $Banner->id }}" ui-toggle-class="bounce"
                                       ui-target="#animate">
                                        <small><i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}
                                        </small>
                                    </a>
                                @endif

                                @if(@Auth::user()->permissionsGroup->delete_status)
                                    <button class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#m-{{ $Banner->id }}" ui-toggle-class="bounce"
                                            ui-target="#animate">
                                        <small><i class="material-icons">&#xe872;</i> {{ __('backend.delete') }}
                                        </small>
                                    </button>
                                @endif

                            </td>
                        </tr>
                        <div id="u-{{$Banner->id}}" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog modal-lg" id="animate">
                                <form method="post" action="{{route('admin.cruiseRateTable.update',$Banner->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.update') }}</h5>
                                        </div>
                                        <div class="modal-body  p-lg">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Table Name</label><br>
                                                        <input name="name" value="{{$Banner->name}}" required class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Table Code</label><br>
                                                        <input name="code" value="{{$Banner->code}}" required class="form-control">
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Currency</label><br>
                                                        <select class="form-control" name="currency_id">
                                                            <option value="{{\App\Helpers\Helper::get_Currency($Banner->currency_id)->id}}" >{{\App\Helpers\Helper::get_Currency($Banner->currency_id)->name}}</option>
                                                            @foreach(\App\Helpers\Helper::Currencies() as $c)
                                                                <option value="{{$c->id}}" >{{$c->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Supplier</label><br>
                                                        <select class="form-control" name="supplier_id">
                                                            <option value="{{\App\Helpers\Helper::get_Supplier($Banner->supplier_id)->id}}" >{{\App\Helpers\Helper::get_Supplier($Banner->supplier_id)->name}}</option>
                                                            @foreach(\App\Helpers\Helper::Suppliers() as $c)
                                                                <option value="{{$c->id}}" >{{$c->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Effective Date (start)</label><br>
                                                        <input name="effective_start_date" type="date" value="{{$Banner->effective_start_date}}" required class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Effective Date (start)</label><br>
                                                        <input name="effective_end_date" value="{{$Banner->effective_end_date}}" required type="date" class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <small>Special Offer Type</small><br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="pull-left m-l-2">
                                                        <input {{$Banner->early_bird=="1"?'checked':""}} name="early_bird" type="checkbox" style="zoom:1"   >
                                                        <label>Early Bird</label>
                                                        </div>
                                                        <div class="pull-left m-l-2">
                                                            <input {{$Banner->bonus_night=="1"?'checked':""}} name="bonus_night" type="checkbox" style="zoom:1"   >
                                                            <label>Bonus Night</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Early Bird Before Chek in Date</label><br>
                                                        <input name="early_bird_before_departure_date" value="{{$Banner->early_bird_before_departure_date}}" required type="number" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">

                                                        <label>Status</label><br>
                                                        <select class="form-control" name="status" required>
                                                            @if($Banner->status=="1")
                                                                <option value="1">active</option>
                                                            @else
                                                                <option value="0">unactive</option>
                                                            @endif
                                                            <option value="1">active</option>
                                                            <option value="0">unactive</option>
                                                        </select>

                                                    </div>

                                                </div>


                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">

                                                        <label>Nights</label><br>
                                                        <input name="nights" value="{{$Banner->nights}}" required type="number" class="form-control">


                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Buy X Nights</label><br>
                                                        <input name="x_nights" value="{{$Banner->x_nights}}" required type="number" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Get Y Free Nights</label><br>
                                                        <input name="y_nights" value="{{$Banner->y_nights}}" required type="number" class="form-control">
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">


                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Minimum Nights</label><br>
                                                        <input name="min_nights"  value="{{$Banner->min_nights}}" required type="number" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Maximum Nights</label><br>
                                                        <input name="max_nights" value="{{$Banner->max_nights}}" required type="number" class="form-control">
                                                    </div>

                                                </div>
                                                <br>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white p-x-md"
                                                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                                                <button type="submit"
                                                        class="btn success p-x-md">{{ __('backend.update') }}</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div>
                                </form>
                            </div>
                        </div>

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
                                        <a href="{{ route("admin.cruiseRateTable.delete",["id"=>$Banner->id]) }}"
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
    <div id="m-add-cruise-rate-table" class="modal fade" data-backdrop="true">
        <div class="modal-dialog modal-lg" id="animate">
            <form method="post" action="{{route('admin.cruiseRateTable.create')}}" enctype="multipart/form-data">
                @csrf
                <input name="cruise_ship_id" type="number" hidden value="{{$id}}" required class="form-control">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.addnew') }}</h5>
                    </div>
                    <div class="modal-body  p-lg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Table Name</label><br>
                                    <input name="name" value="{{old('name')}}" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Table Code</label><br>
                                    <input name="code" value="{{old('code')}}" required class="form-control">
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Currency</label><br>
                                    <select class="form-control" name="currency_id">
                                        @foreach(\App\Helpers\Helper::Currencies() as $c)
                                            <option value="{{$c->id}}" >{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Supplier</label><br>
                                    <select class="form-control" name="supplier_id">
                                        @foreach(\App\Helpers\Helper::Suppliers() as $c)
                                            <option value="{{$c->id}}" >{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Effective Date (start)</label><br>
                                    <input name="effective_start_date" type="date" value="{{old('effective_start_date')}}" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Effective Date (start)</label><br>
                                    <input name="effective_end_date" value="{{old('effective_end_date')}}" required type="date" class="form-control">
                                </div>
                            </div>
                            <br>
                            <small>Special Offer Type</small><br>
                            <br>
                            <div class="row">
                                <div class="col-md-4">

                                  <div class="pull-left">
                                      <input name="early_bird" type="checkbox" style="zoom:1"   >
                                      <label>Early Bird</label>
                                  </div>

                                    <div class="pull-left m-l-2">
                                        <input name="bonus_night" type="checkbox" style="zoom:1"   >
                                        <label>Bonus Night</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Early Bird Before Chek in Date</label><br>
                                    <input name="early_bird_before_departure_date" value="{{old('early_bird_before_departure_date')}}" required type="number" class="form-control">
                                </div>
                                <div class="col-md-4">

                                    <label>Status</label><br>
                                    <select class="form-control" name="status" required>
                                        <option value="1">active</option>
                                        <option value="0">unactive</option>
                                    </select>

                                </div>

                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-4">

                                    <label>Nights</label><br>

                                    <input name="nights" value="{{old('nights')}}" required type="number" class="form-control">

                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <label>Buy X Nights</label><br>
                                    <input name="x_nights" value="{{old('x_nights')}}" required type="number" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Get Y Free Nights</label><br>
                                    <input name="y_nights" value="{{old('y_nights')}}" required type="number" class="form-control">
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">


                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <label>Minimum Nights</label><br>
                                    <input name="min_nights" value="{{old('min_nights')}}" required type="number" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Maximum Nights</label><br>
                                    <input name="max_nights" value="{{old('max_nights')}}" required type="number" class="form-control">
                                </div>

                            </div>
                            <br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark-white p-x-md"
                                    data-dismiss="modal">{{ __('backend.cancel') }}</button>
                            <button type="submit"
                                    class="btn success p-x-md">{{ __('backend.create') }}</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </form>
        </div>
    </div>

@endsection
@push("after-scripts")

    <script type="text/javascript">

        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });
    </script>
@endpush
