

                <div class="table-responsive">
                    <table class="table table-bordered m-a-0" >
                        <thead class="dker">
                        <tr>


                            <th class=" width50">{{ __('backend.name') }}</th>
                            <th class="text-center width50">{{ __('backend.default_guest') }}</th>
                            <th class="text-center width50">{{ __('backend.max_guest') }}</th>
                            <th class="text-center width50">{{ __('backend.status') }}</th>
                            <th class="text-center width200">{{ __('backend.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $title_var = "title_" . @Helper::currentLanguage()->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                        ?>
                        @foreach($roomTypes as $Banner)
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

                                <td class="">
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
                                       @if($Banner->hotel_rate_table_id==null)
                                            <a class="btn btn-sm success" href="{{route('admin.hotelRoom.createLink',[$Banner->id,$table->id])}}">
                                                <i class="fa fa-link" aria-hidden="true"></i> Create
                                                </small>
                                            </a>
                                        @else
                                            <a class="btn btn-sm success" href="javascript:void">
                                                <i class="fa fa-link" aria-hidden="true"></i>Linked
                                                </small>
                                            </a>
                                           @endif
                                           @if($Banner->hotel_rate_table_id==null)
                                               <a class="btn btn-sm success" href="{{route('admin.hotelRoom.createLink',[$Banner->id,$table->id])}}">
                                                   <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                   </small>
                                               </a>
                                           @else
                                               <a class="btn btn-sm success" href="{{route('admin.hotelRoom.rateTable',$Banner->id)}}">
                                                   <i class="fa fa-edit" aria-hidden="true"></i>Edit
                                                   </small>
                                               </a>
                                           @endif

                                    @endif



                                </td>
                            </tr>

                        @endforeach
                        <!-- .modal -->

                        <!-- / .modal -->
                        </tbody>
                    </table>

                </div>




    <div id="m-add-room" class="modal fade" data-backdrop="true">
        <div class="modal-dialog modal-lg" id="animate">
            <form method="post" action="{{route('admin.hotelRoom.create')}}" enctype="multipart/form-data">
                @csrf
                <input hidden name="hotel_id" value="{{$hotel_id}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.addnew') }}</h5>
                    </div>
                    <div class="modal-body  p-lg">
                        <div class="container-fluid">
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 offset-md-3 text-center">--}}
{{--                                    <h3>{{\App\Helpers\Helper::get_Hotel($hotel_id)->name}}</h3>--}}
{{--                                    <hr>--}}
{{--                                    <br>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
                                <div class="col-md-2">
                                    <label>Maximum Extra Bed</label><br>
                                    <input name="max_extra_bed" value="{{old('name')}}" required class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label>Maximum Extra No Bed</label><br>
                                    <input name="max_extra_no_bed" value="{{old('name')}}" required class="form-control">
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                     </div>
                                <div class="col-md-3">


                                        <label>Status</label><br>
                                        <select class="form-control" name="status" required>
                                            <option value="1">active</option>
                                            <option value="0">unactive</option>
                                        </select>


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
                                                <input class="form-control" readonly  style="background-color: white" name="adult_age_start" value="{{$hotel->adult_age_start}}">

                                            </div>

                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="adult_age_end" value="{{$hotel->adult_age_end}}">


                                            </div>
                                            <div class="col-md-3 myflex" style="padding: 10px" >

                                                <input name="is_adult" {{$hotel->is_adult=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px">
                                            <div class="col-md-3">
                                                <input class="form-control" readonly value="Child">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="child_age_start" value="{{$hotel->child_age_start}}">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="child_age_end" value="{{$hotel->child_age_end}}">

                                            </div>
                                            <div class="col-md-3 myflex" style="padding: 10px" >

                                                <input name="is_child" {{$hotel->is_child=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px">
                                            <div class="col-md-3">
                                                <input class="form-control" readonly value="Toddler">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="toddler_age_start" value="{{$hotel->toddler_age_start}}">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="toddler_age_end" value="{{$hotel->toddler_age_end}}">

                                            </div>
                                            <div class="col-md-3 myflex" style="padding: 10px" >

                                                <input name="is_toddler" {{$hotel->is_toddler=="1"?'checked':""}}  type="checkbox" style="zoom:1.6">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px">
                                            <div class="col-md-3">
                                                <input class="form-control"  readonly value="Infant">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="infant_age_start" value="{{$hotel->infant_age_start}}">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="infant_age_end" value="{{$hotel->infant_age_end}}">

                                            </div>
                                            <div class="col-md-3 myflex" style="padding: 10px" >

                                                <input name="is_infant" {{$hotel->is_infant=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px">
                                            <div class="col-md-3">
                                                <input class="form-control" readonly value="Senior">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="senior_age_start" value="{{$hotel->senior_age_start}}">

                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" readonly style="background-color: white" name="senior_age_end" value="{{$hotel->senior_age_end}}">

                                            </div>
                                            <div class="col-md-3 myflex" style="padding: 10px" >

                                                <input id="12w"  name="is_senior" {{$hotel->is_senior=="1"?'checked':""}}  class="mytoggle"  type="checkbox" style="zoom:1.6">
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
