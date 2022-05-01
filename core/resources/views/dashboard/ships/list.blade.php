@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

    <div class="padding">
        <div class="card" style="padding: 4px">
            <div class="box-header ">
                <a href="{{route('admin.cruiseShip.editOrCreate',0).'?tab=Basic'}}">
                <button class="btn dark pull-left">Add cruiseShip</button>
                </a>
                <a href="javascrip:void" onclick="cruiseShipBulkDelete()">
                    <button class="btn btn-danger pull-right" id="btncruiseShipRemove">Remove</button>
                </a>




            </div>
            <br>
            <br>
            <br>



<div class="container-fluid">
  <form method="get" action="{{route('admin.cruiseShip.list')}}">
      <div class="row">
          <div class="col-md-2">
              <input name="searchWord" placeholder="cruiseShip Name" class="form-control" value="{{session('searchWord','')}}">
          </div>
          <div class="col-md-2">
              <select name="cruise_line" class="form-control" >
{{--                  <option value="{{session('city_id','none')}}">{{session('city_name','City')}}</option>--}}
                  @foreach(\App\Helpers\Helper::Cruises() as $c)
                      <option value="none" {{session('cruise_line_id')=='none'?'selected':''}}>All</option>
                      <option value="{{$c->id}}" {{session('cruise_line_id')==$c->id?'selected':''}}>{{$c->name}}</option>
                  @endforeach

              </select>
          </div>
          <div class="col-md-2">
              <button type="submit" class="btn dark btn-block">Filter</button>
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
                            <th class=" width50">cruiseShip Name</th>
                            <th class=" width50">{{ __('backend.phone') }}</th>
                            <th class=" width50">{{ __('backend.email') }}</th>
                            <th class=" width50">Cruise Line</th>
                            <th class="text-center width50">{{ __('backend.status') }}</th>
                            <th class=" width200">{{ __('backend.action') }}</th>
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
                                <td class="">
                                    <input type="checkbox"  data-id="{{$Banner->id}}" id="cruiseShipCheckBox" style="zoom:1.2">
                                </td>
                                <td class="">
                                    <label>{{$Banner->name}}</label>
                               </td>
                                <td class="">
                                    <label>{{$Banner->phone}}</label>
                                </td>
                                <td class="">
                                    <label>{{$Banner->email}}</label>                                </td>
                                <td class="">
                                    <label>{{\App\Helpers\Helper::get_Cruise($Banner->cruise_line_id)->name}}</label>                                </td>

                                <td class="text-center">
                                    <i class="fa {{ ($Banner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    @if(@Auth::user()->permissionsGroup->edit_status)

                                        <a href="{{route('admin.cruiseShip.editOrCreate',$Banner->id).'?tab=Basic'}}">

                                            <button class="btn btn-sm dark" >
                                                <small><i class="fa fa-edit" aria-hidden="true"></i> {{ __('backend.edit') }}
                                                </small>
                                            </button>
                                        </a>
                                    @endif


{{--                                    @if(@Auth::user()->permissionsGroup->delete_status)--}}
{{--                                        <button class="btn btn-sm warning" data-toggle="modal"--}}
{{--                                                data-target="#m-{{ $Banner->id }}" ui-toggle-class="bounce"--}}
{{--                                                ui-target="#animate">--}}
{{--                                            <small><i class="material-icons">&#xe872;</i> {{ __('backend.delete') }}--}}
{{--                                            </small>--}}
{{--                                        </button>--}}
{{--                                    @endif--}}

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
                                            <a href="{{ route("admin.cruiseShip.delete",["id"=>$Banner->id]) }}"
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

     function cruiseShipBulkDelete() {
            var checkboxes = document.querySelectorAll('input[id="cruiseShipCheckBox"]');
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
             $("#btncruiseShipRemove").text("Removing...")
             $.ajax({
                 type:'post',
                 url:'{{route('admin.cruiseShip.deleteBulk')}}',
                 data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                 success:function(data){
                     console.log(data)
                     window.location.reload()
                 }})
         }
        }

    </script>
@endpush
