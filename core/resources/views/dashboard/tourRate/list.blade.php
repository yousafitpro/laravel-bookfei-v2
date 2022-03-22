@extends('dashboard.layouts.master')
@section('title', 'Tour Rate Table')
@section('content')
<style>
    td,th{
        border: solid 5px transparent;
    }
</style>

{{--Hello--}}
    <div class="padding">

        <div class="box box-body">
            <div class="box-header">
                <small>
                    <a href="{{route('admin.tour.editOrCreate',$tour->id).'?tab=Basic'}}">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Go Back
                    </a>
                </small><br>

                        <h6 style="font-weight: bold; margin-left: 10px">Tour Rate Table</h6>



            </div>
            <form method="post" id="myForm" action="{{route('admin.tourRate.create')}}" enctype="multipart/form-data">
                @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="container-fluid">
                            <input style="display: none" name="tour_id" value="{{$tour->id}}">
                            <div class="row">

                                <div class="col-md-4">
                                    <small>From</small><br>
                                    <input type="date" id="startDate" name="start" value="{{$tour->effective_start_date}}"  class="form-control input-sm">
                                </div>
                                <div class="col-md-4">
                                    <small>To</small><br>
                                    <input type="date" id="endDate" name="end" value="{{$tour->effective_end_date}}"  class="form-control">
                                </div>

                                <div class="col-md-4"></div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <input class="pull-left" value="7" name="sun" type="checkbox" id="sunday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">SUN</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="1" name="mon" type="checkbox" id="monday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">MON</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="2" name="tue" type="checkbox" id="tuesday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">TUE</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="3" name="wed" type="checkbox" id="wednesday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">WED</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="4" name="thu" type="checkbox" id="thursday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">THU</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="5" name="fri" type="checkbox" id="friday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">FRI</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="6" name="sat" type="checkbox" id="saturday" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">SAT</small>
                                    </div>
                                </div>

                            </div><br><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <small>Tax Percentage % </small><br>
                                    <input type="number" name="tax_percentage" required   class="form-control input-sm">
                                </div>
                                <div class="col-md-4">
                                    <small>Tax Amount</small><br>
                                    <input type="number" name="tax_amount" required   class="form-control">
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
                                    <label onclick="checkApply()"  style="width: 200px"
                                            class="btn primary p-x-md">{{ __('backend.apply') }}</label>
                                </div>
                            </div><br>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="container-fluid">
                            <h6 >Price</h6><br>
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Age Group" class="form-control"></div>
                                <div class="col-md-6"><input readonly   value="Price" class="form-control"></div>
                            </div>
                            <br>
                            @if($tour->is_adult!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Adult {{$tour->adult_age_start}}-{{$tour->adult_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input {{$tour->is_adult=="0"?"readonly":""}}  type="number" required  name="adult" class="form-control"></div>
                            </div>

                            <br>
                            @endif
                                @if($tour->is_child!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Child {{$tour->child_age_start}}-{{$tour->child_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input {{$tour->is_child=="0"?"readonly":""}}  type="number" required  name="child" class="form-control"></div>
                            </div>
                            <br>
                                @endif
                                    @if($tour->is_toddler!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Toddler {{$tour->toddler_age_start}}-{{$tour->toddler_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$tour->toddler=="0"?"readonly":""}} required  name="toddler" class="form-control"></div>
                            </div>
                            <br>
                                    @endif
                                        @if($tour->is_infant!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Infant {{$tour->infant_age_start}}-{{$tour->infant_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$tour->is_infant=="0"?"readonly":""}} required  name="infant" class="form-control"></div>
                            </div>
                            <br>
                                        @endif
                                            @if($tour->is_senior!=0)
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Senior {{$tour->senior_age_start}}-{{$tour->senior_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$tour->is_senior=="0"?"readonly":""}} required  name="senior" class="form-control"></div>
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
                            <th style="background:darkgrey;">{{$i->date!=null?(\Carbon\Carbon::parse($i->date)->format("y-m-d")):''}} {{$i->date!=null?strtoupper(Str::limit($i->day,3,'')):''}}</th>
                        @endforeach
                        </thead>
                        <tbody>



                        @if($tour->is_adult!=0)
                            <tr>
                                <td style="background: lightgrey; min-width: 180px">Extra Bed Adult {{$tour->adult_age_start}}-{{$tour->adult_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="adult{{$i->id}}" onkeyup="updateMe('{{$i->id}}','adult',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->adult}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_child!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Child {{$tour->child_age_start}}-{{$tour->child_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="child{{$i->id}}" onkeyup="updateMe('{{$i->id}}','child',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->child}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_toddler!=0)

                            <tr>
                                <td style="background: lightgrey;">Extra Bed Toddler {{$tour->toddler_age_start}}-{{$tour->toddler_age_end}}</td>
                                @foreach($l as $i)

                                    <td><input id="toddler{{$i->id}}" onkeyup="updateMe('{{$i->id}}','toddler',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->toddler}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_infant!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Infant {{$tour->infant_age_start}}-{{$tour->infant_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="infant{{$i->id}}" onkeyup="updateMe('{{$i->id}}','infant',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->infant}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_senior!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Senior {{$tour->senior_age_start}}-{{$tour->senior_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="senior{{$i->id}}" onkeyup="updateMe('{{$i->id}}','senior',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->senior}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        <tr>
                            <td style="background: lightgrey;">Tax Percentage</td>
                            @foreach($l as $i)
                                <td><input id="tax{{$i->id}}" onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Tax Amount</td>
                            @foreach($l as $i)
                                <td><input id="amount{{$i->id}}" onkeyup="updateMe('{{$i->id}}','tax_amount',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_amount}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Enabled</td>
                            @foreach($l as $i)
                                <td >

                                    <input  id="checkBox{{$i->id}}"  {{($i->date==null || ($i->date>$tour->effective_end_date || $i->date<$tour->effective_start_date))?'disabled':''}} onclick="toggleMe('{{$i->id}}')"  {{(($i->is_disabled==0 && $i->date!=null && ($i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date)) && ($i->adult!='' || $i->child!='' || $i->toddler!='' || $i->infant!='' || $i->senior!='')  )?'checked':''}} style="zoom: 1.8" type="checkbox">



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
                            <th style="background:darkgrey;">{{$i->date!=null?(\Carbon\Carbon::parse($i->date)->format("y-m-d")):''}} {{$i->date!=null?strtoupper(Str::limit($i->day,3,'')):''}}</th>
                        @endforeach
                        </thead>
                        <tbody>



                        @if($tour->is_adult!=0)
                            <tr>
                                <td style="background: lightgrey; min-width: 180px">Extra Bed Adult {{$tour->adult_age_start}}-{{$tour->adult_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="adult{{$i->id}}" onkeyup="updateMe('{{$i->id}}','adult',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->adult}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_child!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Child {{$tour->child_age_start}}-{{$tour->child_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="child{{$i->id}}" onkeyup="updateMe('{{$i->id}}','child',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->child}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_toddler!=0)

                            <tr>
                                <td style="background: lightgrey;">Extra Bed Toddler {{$tour->toddler_age_start}}-{{$tour->toddler_age_end}}</td>
                                @foreach($l as $i)

                                    <td><input id="toddler{{$i->id}}" onkeyup="updateMe('{{$i->id}}','toddler',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->toddler}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_infant!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Infant {{$tour->infant_age_start}}-{{$tour->infant_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="infant{{$i->id}}" onkeyup="updateMe('{{$i->id}}','infant',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->infant}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        @if($tour->is_senior!=0)
                            <tr>
                                <td style="background: lightgrey;">Extra Bed Senior {{$tour->senior_age_start}}-{{$tour->senior_age_end}}</td>
                                @foreach($l as $i)
                                    <td><input id="senior{{$i->id}}" onkeyup="updateMe('{{$i->id}}','senior',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->senior}}"></td>
                                @endforeach
                            </tr>
                        @endif
                        <tr>
                            <td style="background: lightgrey;">Tax Percentage</td>
                            @foreach($l as $i)
                                <td><input id="tax{{$i->id}}" onkeyup="updateMe('{{$i->id}}','tax_percentage',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_percentage}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Tax Amount</td>
                            @foreach($l as $i)
                                <td><input id="amount{{$i->id}}" onkeyup="updateMe('{{$i->id}}','tax_amount',event)" {{$i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date ?'':'disabled'}} class="form-control" type="number" value="{{$i->tax_amount}}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Enabled</td>
                            @foreach($l as $i)
                                <td >

                                    <input id="checkBox{{$i->id}}"   {{($i->date==null || ($i->date>$tour->effective_end_date || $i->date<$tour->effective_start_date))?'disabled':''}} onclick="toggleMe('{{$i->id}}')"   {{(($i->is_disabled==0 && $i->date!=null && ($i->date<=$tour->effective_end_date && $i->date>=$tour->effective_start_date)) && ($i->adult!='' || $i->child!='' || $i->toddler!='' || $i->infant!='' || $i->senior!='')  )?'checked':''}} style="zoom: 1.8" type="checkbox">


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
            var myDays=[]

            if ($("#sunday").prop('checked'))
            {
                myDays.push("Sunday")
            }
            if ($("#monday").prop('checked'))
            {
                myDays.push("Monday")
            }
            if ($("#tuesday").prop('checked'))
            {
                myDays.push("Tuesday")
            }
            if ($("#wednesday").prop('checked'))
            {
                myDays.push("Wednesday")
            }
            if ($("#thursday").prop('checked'))
            {
                myDays.push("Thursday")
            }
            if ($("#friday").prop('checked'))
            {
                myDays.push("Friday")
            }
            if ($("#saturday").prop('checked'))
            {
                myDays.push("Saturday")
            }

            console.log(days)

            days.forEach(function (el){

                if (el.date>=startDate && el.date<=endDate )
                {

                    myDays.forEach(function (item){

                        if (item==el.day)
                        {

                            is_true=true
                        }
                    })

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
                 url:'admin/tourRateTable/toggle/'+id,
                 data:{"_token":"{{ csrf_token() }}"},
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
        function updateMe(id,col,me)
        {
            var metrue=false;

            if($("#adult"+id).val()!=undefined && $("#adult"+id).val()!='')
            {

                metrue=true;
            }
            if($("#child"+id).val()!=undefined && $("#child"+id).val()!='')
            {
                metrue=true;
            }
            if($("#toddler"+id).val()!=undefined && $("#toddler"+id).val()!='')
            {
                metrue=true;
            }
            if($("#infant"+id).val()!=undefined && $("#infant"+id).val()!='')
            {
                metrue=true;
            }
            if($("#senior"+id).val()!=undefined && $("#senior"+id).val()!='')
            {
                metrue=true;
            }


            if (metrue)
            {

                $("#checkBox"+id).prop("checked",true)
            }
            else
            {
                $("#checkBox"+id).prop("checked",false)
            }
            $.ajax({
                type:'post',
                url:'admin/tourRateTable/updateColumn/'+id,
                data:{"_token":"{{ csrf_token() }}",'column':col,'val':me.target.value},
                success:function(data){
                    // window.location.reload()
                }})



        }
    </script>
@endpush
