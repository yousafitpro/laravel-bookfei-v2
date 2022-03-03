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
            <form method="post" action="{{route('admin.hotelRoom.createRateTable')}}" >
                @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="container-fluid">
                            <input style="display: none" name="hotel_room_type_id" value="{{$roomType->id}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <small>From {{$rateTable->effective_start_date}}</small><br>
                                    <input type="date" name="start" value="{{$rateTable->effective_start_date}}" readonly class="form-control input-sm">
                                </div>
                                <div class="col-md-4">
                                    <small>To</small><br>
                                    <input type="date" name="end" value="{{$rateTable->effective_end_date}}" readonly class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <small>Date</small><br>
                                    <input type="date" name="date" required   class="form-control">
                                </div>
                                <div class="col-md-4"></div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <input class="pull-left" value="SUN" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">SUN</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="MON" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">MON</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="TUE" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">TUE</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="WED" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">WED</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="THU" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">THU</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="FRI" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">FRI</small>
                                    </div>
                                    <div class="pull-left" style="margin-left: 10px">
                                        <input class="pull-left" value="SAT" name="day" type="radio" style="zoom: 1.4">
                                        <small class="pull-left " style="margin-left: 5px">SAT</small>
                                    </div>
                                </div>

                            </div><br><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <small>Tax Percentage % </small><br>
                                    <input type="number" name="tax_percentage" required value="0"  class="form-control input-sm">
                                </div>
                                <div class="col-md-4">
                                    <small>Tax Amount</small><br>
                                    <input type="number" name="tax_amount" required value="0"  class="form-control">
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
                                    <button type="submit" style="width: 200px"
                                            class="btn primary p-x-md">{{ __('backend.apply') }}</button>
                                </div>
                            </div><br>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="container-fluid">
                            <h6 class="text-center">Price</h6><br>
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Age Group" class="form-control"></div>
                                <div class="col-md-6"><input readonly   value="Price" class="form-control"></div>
                            </div>
                            <br>
                            @if($roomType->is_adult!="0")
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Adult {{$roomType->adult_age_start}}-{{$roomType->adult_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input {{$roomType->is_adult=="0"?"readonly":""}}  type="number" required value="0" name="adult" class="form-control"></div>
                            </div>
                                <br>
                            @endif

                            @if($roomType->is_child!="0")
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Child {{$roomType->child_age_start}}-{{$roomType->child_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input {{$roomType->is_child=="0"?"readonly":""}}  type="number" required value="0" name="child" class="form-control"></div>
                            </div>
                            <br>@endif
                                @if($roomType->toddler!="0")
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Toddler {{$roomType->toddler_age_start}}-{{$roomType->toddler_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$roomType->toddler=="0"?"readonly":""}} required value="0" name="toddler" class="form-control"></div>
                            </div>
                            <br>
                                @endif
                                    @if($roomType->is_infant!="0")
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Infant {{$roomType->infant_age_start}}-{{$roomType->infant_age_end}}" class="form-control"></div>
                                <div class="col-md-6"><input  type="number" {{$roomType->is_infant=="0"?"readonly":""}} required value="0" name="infant" class="form-control"></div>
                            </div>
                            <br>
                                    @endif
                                        @if($roomType->is_senior!="0")
                            <div class="row">
                                <div class="col-md-6"><input readonly value="Senior {{$roomType->senior_age_start}}-{{$roomType->senior_age_end}}" class="form-control"></div>
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
                            <small>( {{$sdate}} )</small>
                                @endif
                        </div>
                        <div class="pull-right">
                            <form method="post">
                                @csrf
                                <input value="{{$sdate?$sdate:''}}" onchange="this.form.submit()" type="month" name="month">
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
                            <th style="background:darkgrey;">{{\Carbon\Carbon::parse($i->date)->format("y-m-d")}} {{$i->day}}</th>
                        @endforeach
                        </thead>
                        <tbody>
                        <tr>
                            <td style="background: lightgrey;">Adult {{$roomType->adult_age_start}}-{{$roomType->adult_age_end}}</td>
                            @foreach($l as $i)
                                <td>{{$i->adult}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Child {{$roomType->child_age_start}}-{{$roomType->child_age_end}}</td>
                            @foreach($l as $i)
                                <td>{{$i->child}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Toddler {{$roomType->toddler_age_start}}-{{$roomType->toddler_age_end}}</td>
                            @foreach($l as $i)
                                <td>{{$i->toddler}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Infant {{$roomType->infant_age_start}}-{{$roomType->infant_age_end}}</td>
                            @foreach($l as $i)
                                <td>{{$i->infant}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Senior {{$roomType->senior_age_start}}-{{$roomType->senior_age_end}}</td>
                            @foreach($l as $i)
                                <td>{{$i->senior}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Tax Percentage</td>
                            @foreach($l as $i)
                                <td>{{$i->tax_percentage}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background: lightgrey;">Tax Amount</td>
                            @foreach($l as $i)
                                <td>{{$i->tax_amount}}</td>
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

@endsection
@push("after-scripts")

    <script type="text/javascript">
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
    </script>
@endpush