@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

    <?php


    ?>
    <div class="padding">
        <div class="card" style="padding: 4px">
            <div class="box-header ">
                <h3>{{ __('backend.room') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{route('admin.cruiseShip.list',$id)}}">{{ __('backend.ships') }}</a> /
                    <a href="javascript:void">{{ __('backend.rooms') }}</a>
                </small>
                <br>
                <div>
                    <a  class="btn btn-fw btn-outline-primary marginBottom5"
                        href="{{route("admin.hotel.list")}}">{{ __('backend.all') }} {{ __('backend.rooms') }}</a>
                    <a  class="btn btn-fw btn-outline-primary marginBottom5"
                       href="{{route("admin.hotel.list")."?status=1"}}">{{ __('backend.active') }} {{ __('backend.rooms') }}</a>
                    <a class="btn btn-fw btn-outline-primary marginBottom5"
                       href="{{route("admin.hotel.list")."?status=0"}}">{{ __('backend.unactive') }} {{ __('backend.rooms') }}</a>
                </div>
            </div>

{{--            @if($list->total() >0)--}}
{{--                @if(@Auth::user()->permissionsGroup->add_status)--}}
{{--                    <div class="row p-a">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            @foreach($WebmasterBanners as $WebmasterBanner)--}}
{{--                                <a class="btn btn-fw primary marginBottom5"--}}
{{--                                   href="{{route("BannersCreate",$WebmasterBanner->id)}}">--}}
{{--                                    <i class="material-icons">&#xe02e;</i>--}}
{{--                                    &nbsp; {!! $WebmasterBanner->{'title_'.@Helper::currentLanguage()->code} !!}</a>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}
{{--            @if($Banners->total() == 0)--}}
{{--                <div class="row p-a">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <div class=" p-a text-center ">--}}
{{--                            {{ __('backend.noData') }}--}}
{{--                            <br>--}}
{{--                            <br>--}}
{{--                            @if(@Auth::user()->permissionsGroup->add_status)--}}
{{--                                @foreach($WebmasterBanners as $WebmasterBanner)--}}
{{--                                    <a class="btn btn-fw primary marginBottom5"--}}
{{--                                       href="{{route("BannersCreate",$WebmasterBanner->id)}}">--}}
{{--                                        <i class="material-icons">&#xe02e;</i>--}}
{{--                                        &nbsp; {!! $WebmasterBanner->{'title_'.@Helper::currentLanguage()->code} !!}</a>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}



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
                            <th class="text-center width50">{{ __('backend.default_guest') }}</th>
                            <th class="text-center width50">{{ __('backend.max_guest') }}</th>
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
                                    {{$Banner->default_guest}}                                </td>
                                <td class="text-center">
                                    {{$Banner->max_guest}}                                </td>

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
                                            <a href="{{route('admin.hotelRoom.list',$Banner->id)}}">
                                                <button class="btn btn-sm warning" >
                                                    <small><i class="fa fa-table" aria-hidden="true"></i> {{ __('backend.table') }}
                                                    </small>
                                                </button>
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
                                    <form method="post" action="{{route('admin.shipRoom.update',$Banner->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        <input hidden name="cruise_ship_id" value="{{$id}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('backend.update') }}</h5>
                                            </div>
                                            <div class="modal-body  p-lg">
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

                                                            <input name="default_guest" value="{{$Banner->default_guest}}" required class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Maximum Guest</label><br>
                                                            <input name="max_guest" value="{{$Banner->max_guest}}" required class="form-control">
                                                        </div>
                                                    </div><br>
                                                    <div class="row">

                                                        <div class="col-md-3">


                                                            <label>Status</label><br>
                                                            <select class="form-control" name="status" required>
                                                                @if($Banner->status=='1')
                                                                    <option value="1">active</option>
                                                                @else
                                                                    <option value="0">active</option>
                                                                    @endif
                                                                <option value="1">active</option>
                                                                <option value="0">unactive</option>
                                                            </select>


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
                                            <a href="{{ route("admin.hotelRoom.delete",["id"=>$Banner->id]) }}"
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
    <div id="m-add-ship-room" class="modal fade" data-backdrop="true">
        <div class="modal-dialog modal-lg" id="animate">
            <form method="post" action="{{route('admin.shipRoom.create')}}" enctype="multipart/form-data">
                @csrf
                <input hidden name="cruise_ship_id" value="{{$id}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.addnew') }}</h5>
                    </div>
                    <div class="modal-body  p-lg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Room Name</label><br>
                                    <input name="name" value="{{old('name')}}" required class="form-control">
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <label>Default Guest</label><br>

                                    <input name="default_guest" value="{{old('code')}}" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Maximum Guest</label><br>
                                    <input name="max_guest" value="{{old('code')}}" required class="form-control">
                                </div>
                            </div><br>
                            <div class="row">

                                <div class="col-md-3">


                                        <label>Status</label><br>
                                        <select class="form-control" name="status" required>
                                            <option value="1">active</option>
                                            <option value="0">unactive</option>
                                        </select>


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
