@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ __('backend.adsBanners') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.adsBanners') }}</a>
                </small>
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
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
{{--                            <th class="width20 dker">--}}
{{--                                <label class="ui-check m-a-0">--}}
{{--                                    <input id="checkAll" type="checkbox"><i></i>--}}
{{--                                </label>--}}
{{--                            </th>--}}
                            <th class="text-center width50">{{ __('backend.image') }}</th>
                            <th class="text-center width50">{{ __('backend.name') }}</th>
                            <th class="text-center width50">{{ __('backend.country') }}</th>
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
                                 <img src=" {{$Banner->image}}" style="height: 50px">
                                </td>
                                <td class="text-center">
                                    <label>{{$Banner->name}}</label>
                               </td>
                                <td class="text-center">
                                    <label>{{$Banner->country->title_en}}</label>
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
                                <div class="modal-dialog" id="animate">
                                    <form method="post" action="{{route('admin.city.update',$Banner->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('backend.update') }}</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Name</label><br>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input name="name" value="{{$Banner->name}}" required class="form-control"><br>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>English Name</label><br>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input name="english_name" value="{{$Banner->english_name}}" required class="form-control"><br>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Image</label><br>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input name="file"  type="file"  class="form-control"><br>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Country</label><br>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select name="country_id" class="form-control js-select-basic-single" required>
                                                                <?php
                                                                $country=App\Helpers\Helper::get_Country($Banner->id);
                                                                ?>
                                                                <option value="{{$country->id}}">{{$country->title_en}}</option>
                                                                @foreach(\App\Helpers\Helper::Countries() as $c)
                                                                    <option value="{{$c->id}}">{{$c->title_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Status</label><br>
                                                        </div>
                                                        <div class="col-md-8">
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
                                            <a href="{{ route("admin.city.delete",["id"=>$Banner->id]) }}"
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

{{--                <footer class="dker p-a">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-3 hidden-xs">--}}
{{--                            <!-- .modal -->--}}
{{--                            <div id="m-all" class="modal fade" data-backdrop="true">--}}
{{--                                <div class="modal-dialog" id="animate">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body text-center p-lg">--}}
{{--                                            <p>--}}
{{--                                                {{ __('backend.confirmationDeleteMsg') }}--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="button" class="btn dark-white p-x-md"--}}
{{--                                                    data-dismiss="modal">{{ __('backend.no') }}</button>--}}
{{--                                            <button type="submit"--}}
{{--                                                    class="btn danger p-x-md">{{ __('backend.yes') }}</button>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- /.modal-content -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- / .modal -->--}}
{{--                            @if(@Auth::user()->permissionsGroup->edit_status)--}}
{{--                                <select name="action" id="action" class="form-control c-select w-sm inline v-middle"--}}
{{--                                        required>--}}
{{--                                    <option value="">{{ __('backend.bulkAction') }}</option>--}}
{{--                                    <option value="order">{{ __('backend.saveOrder') }}</option>--}}
{{--                                    <option value="activate">{{ __('backend.activeSelected') }}</option>--}}
{{--                                    <option value="block">{{ __('backend.blockSelected') }}</option>--}}
{{--                                    @if(@Auth::user()->permissionsGroup->delete_status)--}}
{{--                                        <option value="delete">{{ __('backend.deleteSelected') }}</option>--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                                <button type="submit" id="submit_all"--}}
{{--                                        class="btn white">{{ __('backend.apply') }}</button>--}}
{{--                                <button id="submit_show_msg" class="btn white displayNone" data-toggle="modal"--}}
{{--                                        data-target="#m-all" ui-toggle-class="bounce"--}}
{{--                                        ui-target="#animate">{{ __('backend.apply') }}--}}
{{--                                </button>--}}
{{--                            @endif--}}
{{--                        </div>--}}

{{--                        <div class="col-sm-3 text-center">--}}
{{--                            <small class="text-muted inline m-t-sm m-b-sm">{{ __('backend.showing') }} {{ $Banners->firstItem() }}--}}
{{--                                -{{ $Banners->lastItem() }} {{ __('backend.of') }}--}}
{{--                                <strong>{{ $Banners->total()  }}</strong> {{ __('backend.records') }}</small>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-6 text-right text-center-xs">--}}
{{--                            {!! $Banners->links() !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </footer>--}}


        </div>
    </div>
    <div id="m-add" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <form method="post" action="{{route('admin.city.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.addnew') }}</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Name</label><br>
                                </div>
                                <div class="col-md-8">
                                    <input name="name" required class="form-control"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>English Name</label><br>
                                </div>
                                <div class="col-md-8">
                                    <input name="english_name" required class="form-control"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Image</label><br>
                                </div>
                                <div class="col-md-8">
                                    <input name="file"  type="file" required class="form-control"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Country</label><br>
                                </div>
                                <div class="col-md-8">
                                    <select name="country_id" class="form-control js-select-basic-single" style="width: 100px" required>

                                       @foreach(\App\Helpers\Helper::Countries() as $c)
                                            <option value="{{$c->id}}">{{$c->title_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Status</label><br>
                                </div>
                                <div class="col-md-8">
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
