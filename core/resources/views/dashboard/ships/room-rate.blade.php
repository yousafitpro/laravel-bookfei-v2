@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">

<style>
    td,th{
        border: solid 5px transparent;
    }
</style>
    <div class="padding">
        <div class="box box-body">
            <div class="box-header">
                <small>
                    <a href="{{route('admin.shipRateTable.editOrCreate',$ship->id).'?tab=RoomType&table_id='.$rateTable->id}}">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Go Back
                    </a>
                </small>
            </div>
            <div class="box-header">
                <label>Cruise Ship: {{$ship->name}} - {{$roomType->name}} ({{$rateTable->name}})</label>


            </div>
            <form method="post" id="myForm" action="{{route('admin.hotelRoom.createRateTable')}}" >
                @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="container-fluid">
                            <input style="display: none" name="cruise_ship_room_type_id" value="{{$roomType->id}}">
                            <div class="row" style="display: none">
                                <div class="col-md-4">
                                    <small>From </small><br>
                                    <input type="date" id="startDate" name="start" value="{{$rateTable->effective_start_date}}"  class="form-control input-sm">
                                </div>
                                <div class="col-md-4">
                                    <small>To</small><br>
                                    <input type="date" id="endDate" name="end" value="{{$rateTable->effective_end_date}}"  class="form-control">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="container-fluid">

                                        <div class="row">
                                            <div class="col-md-6"><input readonly value="Price Label" class="form-control"></div>
                                            <div class="col-md-6"><input readonly   value="Price" class="form-control"></div>
                                        </div>
                                        <br>
                                        @if($ship->is_adult!=0)
                                            <div class="row">
                                                <div class="col-md-6"><input readonly value="Adult {{$ship->adult_age_start}}-{{$ship->adult_age_end}}" class="form-control"></div>
                                                <div class="col-md-6"><input   type="number" required value="0" name="adult" class="form-control"></div>
                                            </div>
                                            <br>
                                        @endif

                                        @if($ship->is_child!=0)
                                            <div class="row">

                                                <div class="col-md-6"><input readonly value="Child {{$ship->child_age_start}}-{{$ship->child_age_end}}" class="form-control"></div>
                                                <div class="col-md-6"><input   type="number" required value="0" name="child" class="form-control"></div>
                                            </div>
                                            <br>@endif

                                        @if($ship->is_toddler!=0)
                                            <div class="row">
                                                <div class="col-md-6"><input readonly value="Toddler {{$ship->toddler_age_start}}-{{$ship->toddler_age_end}}" class="form-control"></div>
                                                <div class="col-md-6"><input  type="number"  required value="0" name="toddler" class="form-control"></div>
                                            </div>
                                            <br>
                                        @endif
                                        @if($ship->is_infant!=0)
                                            <div class="row">
                                                <div class="col-md-6"><input readonly value="Infant {{$ship->infant_age_start}}-{{$ship->infant_age_end}}" class="form-control"></div>
                                                <div class="col-md-6"><input  type="number"  required value="0" name="infant" class="form-control"></div>
                                            </div>
                                            <br>
                                        @endif
                                        @if($ship->is_senior!=0)
                                            <div class="row">
                                                <div class="col-md-6"><input readonly value="Senior {{$ship->senior_age_start}}-{{$ship->senior_age_end}}" class="form-control"></div>
                                                <div class="col-md-6"><input  type="number"  required value="0" name="senior" class="form-control"></div>
                                            </div>
                                        @endif
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6"><input readonly value="NCCF Per Guest" class="form-control"></div>
                                            <div class="col-md-6"><input  type="number"  required  name="nccf_per_guest" class="form-control"></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6"><input readonly value="Port Tax Per Guest" class="form-control"></div>
                                            <div class="col-md-6"><input  type="number"  required  name="port_tax_per_guest" class="form-control"></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6"><input readonly value="Insurance Per Guest" class="form-control"></div>
                                            <div class="col-md-6"><input  type="number"  required  name="insurance_per_guest" class="form-control"></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6"><input readonly value="Gratuities_per_night" class="form-control"></div>
                                            <div class="col-md-6"><input  type="number"  required  name="gratuities_per_night" class="form-control"></div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Cruise Date</label>
                      <textarea style="height: 300px; width: 100%"></textarea>
                        <br>
                        <br>
                        <div class="pull-left">
                            <input class="pull-left" value="SUN" name="is_disabled" type="checkbox" style="zoom: 1.4">
                            <small class="pull-left " style="margin-left: 5px">Disabled</small>
                        </div>
                        <br><br>
                        <label onclick="checkApply()"   style="width: 200px"
                               class="btn dark p-x-md">{{ __('backend.apply') }}</label>
                    </div>
                    <div class="col-md-3">

                        <div id="datepicker"></div>
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

                            <small>( {{$sdate}} )</small>

                        </div>
                        <div class="pull-right">
                            <form method="post">
                                @csrf
                                <label>Select Month</label>
                                <input style="height: 30px; width: 200px" value="{{$mdate}}" onchange="this.form.submit()" type="month" name="month">
                            </form>

                        </div>
                    </div>
                </div>
                <br>
            </div>
            @foreach($list3 as $l)

                <div class="">
                    <table class="table ">
                        <thead>
                        <th style="background:darkgrey;">Date</th>
                        @foreach($l as $i)
                            <th style="background:darkgrey;">{{\Carbon\Carbon::parse($i->date)->format("y-m-d")}} {{strtoupper(Str::limit($i->day,3,''))}}</th>
                        @endforeach
                        </thead>
                        <tbody>



                        @if($ship->is_adult!=0)
                            <tr>
                                <td style="background: lightgrey; min-width: 180px">Extra Bed Adult {{$ship->adult_age_start}}-{{$ship->adult_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','adult',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->adult}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_child!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Child {{$ship->child_age_start}}-{{$ship->child_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','child',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->child}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_toddler!=0)

                            <tr>
                                <td style="background: lightgrey;">Extra Bed Toddler {{$ship->toddler_age_start}}-{{$ship->toddler_age_end}}</td>
                                @foreach($l as $i)

                                    <td><input onkeyup="updateMe('{{$i->id}}','toddler',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->toddler}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_infant!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Infant {{$ship->infant_age_start}}-{{$ship->infant_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','infant',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->infant}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_senior!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Senior {{$ship->senior_age_start}}-{{$ship->senior_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','senior',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->senior}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        <tr>
                            <td style="background: lightgrey;">NCCF Per Guest</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Port Tax Per Guest</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Insurance Per Guest</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Gratuities Per Night</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>

                        <tr>
                            <td style="background: lightgrey;">Enabled</td>
                            @foreach($l as $i)
                                <td >

                                        <input  id="checkBox{{$i->id}}"  {{$i->room_price!=null && $i->room_price!='' ?'checked':''}} style="zoom: 1.8" type="checkbox">



                                </td>
                            @endforeach
                        </tr>


                        </tbody>
                    </table>
                </div>

            @endforeach
            @foreach($list as $l)
                <div class="">
                    <table class="table ">
                        <thead>
                        <th style="background:darkgrey;">Date</th>
                        @foreach($l as $i)
                            <th style="background:darkgrey;">{{\Carbon\Carbon::parse($i->date)->format("y-m-d")}} {{strtoupper(Str::limit($i->day,3,''))}}</th>
                        @endforeach
                        </thead>
                        <tbody>



                        @if($ship->is_adult!=0)
                            <tr>
                                <td style="background: lightgrey; min-width: 180px">Extra Bed Adult {{$ship->adult_age_start}}-{{$ship->adult_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','adult',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->adult}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_child!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Child {{$ship->child_age_start}}-{{$ship->child_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','child',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->child}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_toddler!=0)

                            <tr>
                                <td style="background: lightgrey;">Extra Bed Toddler {{$ship->toddler_age_start}}-{{$ship->toddler_age_end}}</td>
                                @foreach($l as $i)

                                    <td><input onkeyup="updateMe('{{$i->id}}','toddler',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->toddler}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_infant!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Infant {{$ship->infant_age_start}}-{{$ship->infant_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','infant',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->infant}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($ship->is_senior!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Senior {{$ship->senior_age_start}}-{{$ship->senior_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input onkeyup="updateMe('{{$i->id}}','senior',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->senior}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        <tr>
                            <td style="background: lightgrey;">NCCF Per Guest</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Port Tax Per Guest</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Insurance Per Guest</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Gratuities Per Night</td>
                            @foreach($l as $i)
                                <td><input onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$rateTable->effective_end_date && $i->date>=$rateTable->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>

                        <tr>
                            <td style="background: lightgrey;">Enabled</td>
                            @foreach($l as $i)
                                <td >

                                    <input  id="checkBox{{$i->id}}"  {{$i->room_price!=null && $i->room_price!='' ?'checked':''}} style="zoom: 1.8" type="checkbox">



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
         var startDate=$("#startDate").val();
         var endDate=$("#endDate").val();

               var is_true=false;
         var days = @json($empties);
         days =Object.values(days);

         console.log(days)
         days.forEach(function (el){
           if (el.date>=startDate && el.date<=startDate)
           {
               is_true=true;
           }
         })

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
             if (col=="room_price")
             {
                 if (me.target.value!="")
                 {
                     $("#checkBox"+id).prop('checked',true)
                 }
                 else
                 {
                     $("#checkBox"+id).prop('checked',false)
                 }
             }

                 $.ajax({
                     type:'post',
                     url:'admin/ship-rate-table/updateColumn/'+id,
                     data:{"_token":"{{ csrf_token() }}",'column':col,'val':me.target.value},
                     success:function(data){
                         // window.location.reload()
                     }})



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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endpush
