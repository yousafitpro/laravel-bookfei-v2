




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
                        <th class=" width50">Rate Table Name</th>
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
                                    <a class="btn btn-sm success" href="{{route('admin.hotelRateTable.editOrCreate',$hotel_id).'?tab=Basic&table_id='.$Banner->id}}">
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
                                        <a href="{{ route("admin.hotelRateTable.delete",["id"=>$Banner->id]) }}"
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




    <div id="m-add-hotel-rate-table" class="modal fade" data-backdrop="true">
        <div class="modal-dialog modal-lg" id="animate">
            <form method="post" action="{{route('admin.hotelRateTable.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.addnew') }}</h5>
                    </div>
                    <div class="modal-body  p-lg">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Rate Table Name</label><br>
                                    <input name="name" value="{{old('name')}}" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Rate Table Code</label><br>
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
                                    <input name="effective_end_date" value="{{old('effective_end_date')}}" required  type="date" class="form-control">
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
                                    <input  name="early_bird_before_departure_date" value="{{old('early_bird_before_departure_date')}}" type="number" class="form-control">
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

                                    <label>Bonus Night Type</label><br>
                                    <select class="form-control" name="bonus_night_type" >
                                        <option value="Accumulated / Once">Accumulated / Once</option>

                                    </select>

                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <label>Buy X Nights</label><br>
                                    <input name="x_nights" value="{{old('early_bird_before_departure_date')}}"  type="number" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Get Y Free Nights</label><br>
                                    <input name="y_nights" value="{{old('early_bird_before_departure_date')}}"  type="number" class="form-control">
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
                                    <input name="min_nights" value="{{old('early_bird_before_departure_date')}}"  type="number" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Maximum Nights</label><br>
                                    <input name="max_nights" value="{{old('early_bird_before_departure_date')}}"  type="number" class="form-control">
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
                url:'{{route('admin.hotelRateTable.deleteBulk')}}',
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
                url:'{{route('admin.hotelRateTable.cloneBulk')}}',
                data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                success:function(data){
                    console.log(data)
                    window.location.reload()
                }})
        }
    }
</script>
