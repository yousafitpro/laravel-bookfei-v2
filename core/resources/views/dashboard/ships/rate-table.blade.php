




            <div class="table-responsive">
                <table class="table table-bordered m-a-0" >
                    <thead class="dker">
                    <tr>
                        {{--                            <th class="width20 dker">--}}
                        {{--                                <label class="ui-check m-a-0">--}}
                        {{--                                    <input id="checkAll" type="checkbox"><i></i>--}}
                        {{--                                </label>--}}
                        {{--                            </th>--}}
                        <th class=" width50"></th>
                        <th  style="width: 120px">Rate Table Name</th>
                        <th class=" width50">{{ __('backend.code') }}</th>
                        <th class=" width50">{{ __('backend.currency') }}</th>
                        <th class=" width50">{{ __('backend.supplier') }}</th>
                        <th class="text-center  width50">{{ __('backend.status') }}</th>
                        <th class=" width50">Effective From</th>
                        <th class=" width50">Effective To</th>
                        <th class=" width50">Special Offer</th>
                        <th class=" width200">{{ __('backend.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $title_var = "title_" . @Helper::currentLanguage()->code;
                    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                    ?>
                    @foreach($rateTables as $Banner)
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
                            <td class="text-center" style="zoom:1.3">
                                <input type="checkbox" id="hotelRateTableCheckBox" data-id="{{$Banner->id}}">
                            </td>
                            <td class="">
                                <label>{{$Banner->name}}</label>
                            </td>
                            <td class="">
                                <label>{{$Banner->code}}</label>
                            </td>
                            <td class="">
                                <label>{{\App\Helpers\Helper::get_Currency($Banner->currency_id)->name}}</label>
                            </td>
                            <td class="">
                                <label>{{\App\Helpers\Helper::get_Supplier($Banner->supplier_id)->name}}</label>
                            </td>


                            <td class="text-center">
                                <i class="fa {{ ($Banner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                            </td>
                            <td class="">
                                <label>{{$Banner->effective_start_date}}</label>
                            </td>
                            <td class="">
                                <label>{{$Banner->effective_end_date}}</label>
                            </td>
                            <td class="">

                            </td>
                            <td class="text-center">
                                @if(@Auth::user()->permissionsGroup->edit_status)
                                    <a class="btn btn-sm success" href="{{route('admin.shipRateTable.editOrCreate',$cruiseShip->id).'?tab=Basic&table_id='.$Banner->id}}">
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
                                        <a href="{{ route("admin.shipRateTable.delete",["id"=>$Banner->id]) }}"
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




<script>
    function rateTableBulkDelete() {
        var checkboxes = document.querySelectorAll('input[id="hotelRateTableCheckBox"]');
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
            $("#btnRateTableRemove").text("Removing...")
            $.ajax({
                type:'post',
                url:'{{route('admin.shipRateTable.deleteBulk')}}',
                data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                success:function(data){
                    console.log(data)
                    window.location.reload()
                }})
        }
    }
    function rateTableBulkClone() {

        var checkboxes = document.querySelectorAll('input[id="hotelRateTableCheckBox"]');
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
            $("#btnRateTableClone").text("Cloning...")
            $.ajax({
                type:'post',
                url:'{{route('admin.shipRateTable.cloneBulk')}}',
                data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                success:function(data){
                    console.log(data)
                    window.location.reload()
                }})
        }
    }
</script>
