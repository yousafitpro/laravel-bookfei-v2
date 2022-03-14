

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
                                       @if($Banner->cruise_ship_rate_table_id==null)
                                            <a class="btn btn-sm success" href="{{route('admin.shipRoom.createLink',[$Banner->id,$table->id])}}">
                                                <i class="fa fa-link" aria-hidden="true"></i> Create
                                                </small>
                                            </a>
                                        @else
                                            <a class="btn btn-sm success" href="javascript:void">
                                                <i class="fa fa-link" aria-hidden="true"></i>Linked
                                                </small>
                                            </a>
                                           @endif
                                           @if($Banner->cruise_ship_rate_table_id==null)
                                               <a class="btn btn-sm success" href="{{route('admin.shipRoom.createLink',[$Banner->id,$table->id])}}">
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




