@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

    <div class="padding">
        <div class="card" style="padding: 4px">
            <div class="box-header ">
                <h3>{{ __('backend.hotel') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="javascript:void">{{ __('backend.hotels') }}</a>
                </small>
                <br>
                <div>
                    <a  class="btn btn-fw btn-outline-primary marginBottom5"
                        href="{{route("admin.tour.list")}}">{{ __('backend.all') }} {{ __('backend.hotels') }}</a>
                    <a  class="btn btn-fw btn-outline-primary marginBottom5"
                       href="{{route("admin.tour.list")."?status=1"}}">{{ __('backend.active') }} {{ __('backend.hotels') }}</a>
                    <a class="btn btn-fw btn-outline-primary marginBottom5"
                       href="{{route("admin.tour.list")."?status=0"}}">{{ __('backend.unactive') }} {{ __('backend.hotels') }}</a>
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
                            <th class="text-center width50">{{ __('backend.phone') }}</th>
                            <th class="text-center width50">{{ __('backend.email') }}</th>
                            <th class="text-center width50">{{ __('backend.city') }}</th>
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
                                    <label>{{$Banner->phone}}</label>
                                </td>
                                <td class="text-center">
                                    <label>{{$Banner->email}}</label>                                </td>
                                <td class="text-center">
                                    <label>{{\App\Helpers\Helper::get_City($Banner->city_id)->name}}</label>                                </td>

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
                                                    <small><i class="fa fa-home" aria-hidden="true"></i> {{ __('backend.rooms') }}
                                                    </small>
                                                </button>
                                            </a>
                                        @endif
                                        <br><br>
                                        @if(@Auth::user()->permissionsGroup->delete_status)

                                            <a href="{{route('admin.hotelRateTable.list',$Banner->id)}}">
                                                <button class="btn btn-sm warning" >
                                                    <small><i class="fa fa-table" aria-hidden="true"></i> {{ __('backend.rateTable') }}
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
                                    <form method="post" action="{{route('admin.hotel.update',$Banner->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('backend.update') }}</h5>
                                            </div>
                                            <div class="modal-body  p-lg">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Hotel Name</label><br>
                                                            <input name="name" value="{{$Banner->name}}" required class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>English Name</label><br>
                                                            <input name="english_name" value="{{$Banner->english_name}}" required class="form-control">
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>City</label><br>
                                                            <select class="form-control" name="city_id">
                                                                <option value="{{\App\Helpers\Helper::get_City($Banner->city_id)->id}}" >{{\App\Helpers\Helper::get_City($Banner->city_id)->name}}</option>
                                                                @foreach(\App\Helpers\Helper::Cities() as $c)
                                                                    <option value="{{$c->id}}" >{{$c->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Address</label><br>
                                                            <input name="address" value="{{$Banner->address}}" required class="form-control">
                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Contact tel</label><br>
                                                            <input name="phone" value="{{$Banner->phone}}"   required class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email</label><br>
                                                            <input name="email" value="{{$Banner->email}}"  required type="email" class="form-control">
                                                        </div>
                                                    </div>


                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-9 box box-body ">

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
                                                                        <select name="adult_age_start" value="{{$Banner->adult_age_start}}" class="form-control">
                                                                            <option value="{{$Banner->adult_age_start}}">{{$Banner->adult_age_start}}</option>
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="adult_age_end" class="form-control" value="{{old('adult_age_end')}}">
                                                                            <option value="{{$Banner->adult_age_end}}">{{$Banner->adult_age_end}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_adult" {{$Banner->is_adult=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" readonly value="Child">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="child_age_start" value="{{old('child_age_start')}}" class="form-control">
                                                                            <option value="{{$Banner->child_age_start}}">{{$Banner->child_age_start}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="child_age_end" value="{{old('child_age_end')}}" class="form-control">
                                                                            <option value="{{$Banner->child_age_end}}">{{$Banner->child_age_end}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_child" {{$Banner->is_child=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" readonly value="Toddler">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="toddler_age_start" value="{{old('toddler_age_start')}}" class="form-control">
                                                                            <option value="{{$Banner->toddler_age_start}}">{{$Banner->toddler_age_start}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="toddler_age_end" value="{{old('toddler_age_end')}}" class="form-control">
                                                                            <option value="{{$Banner->toddler_age_end}}">{{$Banner->toddler_age_end}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_toddler" {{$Banner->is_toddler=="1"?'checked':""}}  type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control"  readonly value="Infant">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="infant_age_start" value="{{old('infant_age_start')}}" class="form-control">
                                                                            <option value="{{$Banner->infant_age_start}}">{{$Banner->infant_age_start}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="infant_age_end" value="{{old('infant_age_end')}}" class="form-control">
                                                                            <option value="{{$Banner->infant_age_end}}">{{$Banner->infant_age_end}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_infant" {{$Banner->is_infant=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" readonly value="Senior">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="senior_age_start" value="{{old('senior_age_start')}}" class="form-control">
                                                                            <option value="{{$Banner->senior_age_start}}">{{$Banner->senior_age_start}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="senior_age_end" value="{{old('senior_age_end')}}" class="form-control">
                                                                            <option value="{{$Banner->senior_age_end}}">{{$Banner->senior_age_end}}</option>

                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input id="12w"  name="is_senior" {{$Banner->is_senior=="1"?'checked':""}}  class="mytoggle"  type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>

                                                                <br>

                                                            </div>


                                                        </div>



                                                    </div>



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
                                            <a href="{{ route("admin.tour.delete",["id"=>$Banner->id]) }}"
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
    <div id="m-add-hotel" class="modal fade" data-backdrop="true">
        <div class="modal-dialog modal-lg" id="animate">
            <form method="post" action="{{route('admin.hotel.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.addnew') }}</h5>
                    </div>
                    <div class="modal-body  p-lg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Hotel Name</label><br>
                                    <input name="name" value="{{old('name')}}" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>English Name</label><br>
                                    <input name="english_name" value="{{old('code')}}" required class="form-control">
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>City</label><br>
                                   <select class="form-control" name="city_id">
                                       @foreach(\App\Helpers\Helper::Cities() as $c)
                                           <option value="{{$c->id}}" >{{$c->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Address</label><br>
                                    <input name="address" value="{{old('code')}}" required class="form-control">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Contact tel</label><br>
                                    <input name="phone"   required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label><br>
                                    <input name="email"  required type="email" class="form-control">
                                </div>
                            </div>


                            <br>

                            <div class="row">
                                <div class="col-md-9 box box-body ">

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
                                                                        <select name="adult_age_start" value="{{old('adult_age_start')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="adult_age_end" class="form-control" value="{{old('adult_age_end')}}">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_adult"  checked  type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" readonly value="Child">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="child_age_start" value="{{old('child_age_start')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="child_age_end" value="{{old('child_age_end')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_child" checked   type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" readonly value="Toddler">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="toddler_age_start" value="{{old('toddler_age_start')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="toddler_age_end" value="{{old('toddler_age_end')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_toddler" checked  type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control"  readonly value="Infant">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="infant_age_start" value="{{old('infant_age_start')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="infant_age_end" value="{{old('infant_age_end')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input name="is_infant" checked  type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: 5px">
                                                                    <div class="col-md-3">
                                                                        <input class="form-control" readonly value="Senior">

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="senior_age_start" value="{{old('senior_age_start')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                          </div>
                                                                    <div class="col-md-3">
                                                                        <select name="senior_age_end" value="{{old('senior_age_end')}}" class="form-control">
                                                                            <?php
                                                                            $i=1
                                                                            ?>
                                                                            @while($i!=100)
                                                                                <option value="{{$i}}">{{$i}}</option>
                                                                                <?php
                                                                                $i=$i+1;
                                                                                ?>
                                                                            @endwhile
                                                                        </select>                                             </div>
                                                                    <div class="col-md-3 myflex" style="padding: 10px" >

                                                                        <input id="12w"  name="is_senior" checked class="mytoggle"  type="checkbox" style="zoom:1.6">
                                                                    </div>
                                                                </div>
                                                                <br>

                                                </div>


                                </div>



                            </div>



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
