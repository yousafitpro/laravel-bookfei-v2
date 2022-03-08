

                <div class="table-responsive">
                    <table class="table table-bordered m-a-0" >
                        <thead class="dker">
                        <tr>
                            <th class=" width50"></th>

                            <th class=" width50">{{ __('backend.name') }}</th>
{{--                            <th class="text-center width50">{{ __('backend.default_guest') }}</th>--}}
                            <th class="text-center width50">{{ __('backend.max_guest') }}</th>
                            <th class="text-center width50">Maximum Extra Bed</th>
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

                                <td class="text-center">
                                    <input id="roomTypeCheckBox" data-id="{{$Banner->id}}" type="checkbox" style="zoom: 1.2">
                                </td>
                                <td class="">
                                    <label>{{$Banner->name}}</label>
                               </td>
{{--                                <td class="text-center">--}}
{{--                                    {{$Banner->default_guest}}                                </td>--}}
                                <td class="text-center">
                                    {{$Banner->max_guest}}                                </td>
                                <td class="text-center">
                                    {{$Banner->max_extra_bed}}                                </td>

                                <td class="text-center">
                                    <i class="fa {{ ($Banner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    @if(@Auth::user()->permissionsGroup->edit_status)
                                        <a href="{{route('admin.hotelRoom.updateView',$Banner->id)}}" class="btn btn-sm success">
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
                <!-- .modal -->
                <div id="removeRoomTypesModel" class="modal fade" data-backdrop="true">
                    <div class="modal-dialog" id="animate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                            </div>
                            <div class="modal-body text-center p-lg">

                                <strong> Are you want to Delete These records ? </strong>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default p-x-md"
                                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                                <a href="javascript:void" data-dismiss="modal" onclick="roomTypeBulkDelete()"
                                   class="btn dark " style="color: white">Ok</a>
                            </div>
                        </div><!-- /.modal-content -->
                    </div>
                </div>
                <!-- / .modal -->
<script>
    function roomTypeBulkDelete() {
        var checkboxes = document.querySelectorAll('input[id="roomTypeCheckBox"]');
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
            $("#btnRoomTypeRemove").text("Removing...")
            $.ajax({
                type:'post',
                url:'{{route('admin.hotelRoom.deleteBulk')}}',
                data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                success:function(data){
                    console.log(data)
                    window.location.reload()
                }})
        }
    }

</script>



