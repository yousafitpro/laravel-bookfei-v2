@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')
<style>
    td,th{
        border: solid 5px transparent;
    }
</style>
    <div class="padding">
        <div class="box box-body">
            <div class="box-header">
                <small>
                    <a href="{{route('admin.hotelRateTable.editOrCreate',$hotel->id).'?tab=RoomType&table_id='.$rateTable->id}}">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Go Back
                    </a>
                </small>
            </div>
            <div class="box-header">
                <label>Hotel:{{$hotel->name}}</label>
                <br>
                <small style="color: grey">({{$hotel->name}}-{{$roomType->name}}-{{$rateTable->name}})</small>

            </div>
            <form method="post" id="myForm" action="{{route('admin.hotelRoom.createRateTable')}}" >
                @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="container-fluid">
                            <input style="display: none" name="hotel_room_type_id" value="{{$roomType->id}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <small>From </small><br>
                                    <input type="date" name="start" value="{{$rateTable->effective_start_date}}"  class="form-control input-sm">
                                </div>
                                <div class="col-md-4">
                                    <small>To</small><br>
                                    <input type="date" name="end" value="{{$rateTable->effective_end_date}}"  class="form-control">
                                </div>
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4"></div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <input class="pull-left" value="7" name="sun" id="sunday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">SUN</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="1" name="mon" id="monday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">MON</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="2" name="tue" id="tuesday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">TUE</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="3" name="wed" id="wednesday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">WED</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="4" name="thu" id="thursday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">THU</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="5" name="fri" id="friday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">FRI</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="6" name="sat" id="saturday" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">SAT</small>
                                    </div>
                                </div>

                            </div><br><br>
                            <div class="row">
                                <div class="col-md-7">
                                    <small>Room Price ({{\App\Helpers\Helper::get_Currency($rateTable->currency_id)->name}}) </small><br>
                                    <input type="number"  name="room_price"    max="100" class="form-control input-sm">

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <small>Tax Percentage  % </small><br>
                                    <input type="number"  name="tax_percentage"    max="100" class="form-control input-sm">

                                </div>
                                <div class="col-md-4">
                                    <small>Tax Amount</small><br>
                                    <input type="number" name="tax_amount"  max="100" class="form-control">
                                </div>

                                <div class="col-md-4"></div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <input class="pull-left" value="SUN" name="is_disabled" type="checkbox" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">Disabled</small>
                                    </div>
                                    <br><br>
                                    <label onclick="checkApply()"   style="width: 200px"
                                            class="btn dark p-x-md">{{ __('backend.apply') }}</label>
                                </div>
                            </div><br>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="container-fluid">
                            <h6 class="text-left">Extra Bed</h6><br>
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Age Group" class="form-control"></div>
                                <div class="col-md-6"><input readonly   value="Price" class="form-control"></div>
                            </div>
                            <br>
                            @if($hotel->is_adult!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Adult {{$hotel->adult_age_start}}-{{$hotel->adult_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input {{$roomType->is_adult=="0"?"readonly":""}}  type="number" required value="0" name="adult" class="form-control"></div>
                            </div>
                                <br>
                            @endif

                            @if($hotel->is_child!=0)
                            <div class="row">

                                <div class="col-md-6"><input readonly value="Child {{$hotel->child_age_start}}-{{$hotel->child_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input {{$roomType->is_child=="0"?"readonly":""}}  type="number" required value="0" name="child" class="form-control"></div>
                            </div>
                            <br>@endif

                                @if($hotel->is_toddler!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Toddler {{$hotel->toddler_age_start}}-{{$hotel->toddler_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$roomType->toddler=="0"?"readonly":""}} required value="0" name="toddler" class="form-control"></div>
                            </div>
                            <br>
                                @endif
                                    @if($hotel->is_infant!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Infant {{$hotel->infant_age_start}}-{{$hotel->infant_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$roomType->is_infant=="0"?"readonly":""}} required value="0" name="infant" class="form-control"></div>
                            </div>
                            <br>
                                    @endif
                                        @if($hotel->is_senior!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Senior {{$hotel->senior_age_start}}-{{$hotel->senior_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$roomType->is_senior=="0"?"readonly":""}} required value="0" name="senior" class="form-control"></div>
                            </div>
                                @endif
                        </div>

                    </div>
                </div>
            </div>
            </form>

        </div>
        <div class="table-responsive box box-body">
            <div class="container-fluid">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <a onclick="reloadMe()"><small>All Records</small></a>
                            @if($sdate)
                            <small>( {{$sdateName}} )</small>
                                @endif
                        </div>
                        <div class="pull-right">
                            <form method="post">
                                @csrf
                                <input style="height: 40px; width: 200px" value="{{$sdate?$sdate:''}}" onchange="this.form.submit()" type="month" name="month">
                            </form>

                        </div>
                    </div>
                </div>
                <br>
            </div>
            @foreach($list as $l)

                <div class="">
                    <table class="table ">
                        <thead>
                        <th style="background:darkgrey;">Date</th>
                        @foreach($l as $i)
                            <th style="background:darkgrey;">{{\Carbon\Carbon::parse($i->date)->format("y-m-d")}} {{$i->day_name}}</th>
                        @endforeach
                        </thead>
                        <tbody>

                            <tr>
                                <td style="background: lightgrey; min-width: 180px">Room Price ({{\App\Helpers\Helper::get_Currency($rateTable->currency_id)->name}})</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','room_price',event)" type="number" class="form-control" value="{{$i->room_price}}"></td>
                                @endforeach
                            </tr>

                        @if($hotel->is_adult!=0)
                        <tr>
                            <td style="background: lightgrey; min-width: 180px">Extra Bed Adult {{$hotel->adult_age_start}}-{{$hotel->adult_age_end}}</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','adult',event)" class="form-control" type="number" value="{{$i->adult}}"></td>
                            @endforeach
                        </tr>
                        @endif
                        @if($hotel->is_child!=0)
                        <tr>
                            <td style="background: lightgrey;">Extra Bed Child {{$hotel->child_age_start}}-{{$hotel->child_age_end}}</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','child',event)" class="form-control" type="number" value="{{$i->child}}"></td>
                            @endforeach
                        </tr>
                        @endif
                        @if($hotel->is_toddler!=0)

                        <tr>
                            <td style="background: lightgrey;">Extra Bed Toddler {{$hotel->toddler_age_start}}-{{$hotel->toddler_age_end}}</td>
                            @foreach($l as $i)

                                <td><input onkeyup="updateMe('{{$i->id}}','toddler',event)" class="form-control" type="number" value="{{$i->toddler}}"></td>
                            @endforeach
                        </tr>
                        @endif
                        @if($hotel->is_infant!=0)
                        <tr>
                            <td style="background: lightgrey;">Extra Bed Infant {{$hotel->infant_age_start}}-{{$hotel->infant_age_end}}</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','infant',event)" class="form-control" type="number" value="{{$i->infant}}"></td>
                            @endforeach
                        </tr>
                        @endif
                        @if($hotel->is_senior!=0)
                        <tr>
                            <td style="background: lightgrey;">Extra Bed Senior {{$hotel->senior_age_start}}-{{$hotel->senior_age_end}}</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','senior',event)" class="form-control" type="number" value="{{$i->senior}}"></td>
                            @endforeach
                        </tr>
                        @endif
                        <tr>
                            <td style="background: lightgrey;">Tax Percentage</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Tax Amount</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_amount',event)" class="form-control" type="number" value="{{$i->tax_amount}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Enabled</td>
                            @foreach($l as $i)
                                <td >
                                    @if($i->is_disabled==1)
                                        <input onclick="toggleMe('{{$i->id}}')"  checked style="zoom: 1.8" type="checkbox">
                                    @else
                                        <input onclick="toggleMe('{{$i->id}}')" style="zoom: 1.8" type="checkbox">
                                    @endif

                                </td>
                            @endforeach
                        </tr>


                        </tbody>
                    </table>
                </div>

            @endforeach

        </div>
    </div>
<!-- .modal -->
<div id="ApplyDiv" class="modal fade" data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
            </div>
            <div class="modal-body text-center p-lg">

                    <strong> Data is Already Existed Are you want to Override ? </strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default p-x-md"
                        data-dismiss="modal">{{ __('backend.no') }}</button>
                <a onclick="$('#myForm').submit()"
                   class="btn dark " style="color: white">{{ __('backend.yes') }}</a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->
@endsection
@push("after-scripts")

    <script type="text/javascript">
     function checkApply()
     {
               var is_true=false;
         var days = @json($days);
         days =Object.values(days);

         console.log(days)
         var sunday = document.querySelectorAll('input[id="sunday"]');
         if (sunday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Sunday")
                 {
                    is_true=true;
                 }
             })
         }
         var monday = document.querySelectorAll('input[id="monday"]');
         if (monday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Monday")
                 {
                     is_true=true;
                 }
             })
         }
         var tuesday = document.querySelectorAll('input[id="tuesday"]');
         if (tuesday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Tuesday")
                 {
                     is_true=true;
                 }
             })
         }
         var wednesday = document.querySelectorAll('input[id="wednesday"]');
         if (wednesday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Wednesday")
                 {
                     is_true=true;
                 }
             })
         }
         var thursday = document.querySelectorAll('input[id="thursday"]');
         if (thursday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Thursday")
                 {
                     is_true=true;
                 }
             })
         }
         var friday = document.querySelectorAll('input[id="friday"]');
         if (friday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Friday")
                 {
                     is_true=true;
                 }
             })
         }
         var saturday = document.querySelectorAll('input[id="saturday"]');
         if (saturday[0].checked)
         {
             days.forEach(function (el){
                 if (el.day=="Saturday")
                 {
                     is_true=true;
                 }
             })
         }

         if (is_true)
         {
               $("#ApplyDiv").modal();
         }
         else
         {
             $("#myForm").submit()
         }
     }
         function toggleMe(id)
         {
             $.ajax({
                 type:'post',
                 url:'admin/hotel-rate-table/toggle/'+id,
                 data:{"_token":"{{ csrf_token() }}"},
                 success:function(data){
                   // window.location.reload()
                 }})
         }
         function updateMe(id,col,me)
         {
             if (me.target.value!="")
             {
                 $.ajax({
                     type:'post',
                     url:'admin/hotel-rate-table/updateColumn/'+id,
                     data:{"_token":"{{ csrf_token() }}",'column':col,'val':me.target.value},
                     success:function(data){
                         // window.location.reload()
                     }})
             }


         }


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
