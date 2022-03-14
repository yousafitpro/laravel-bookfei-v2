@extends('dashboard.layouts.master')
@section('content')
    <div class="padding">
        <div class="card ">
            <div class="container-fluid">
                <br>
                <div class="row box-header">
                    @if($_GET['tab']=="Basic" && $table_id==0 )
                    <button onclick="document.getElementById('addRateTable').submit()"
                            class="btn dark p-x-md pull-right">{{ __('backend.save') }}</button>
                    @endif
                        @if($_GET['tab']=="Basic" && $table_id!=0)
                            <button onclick="document.getElementById('editRateTable').submit()"
                                    class="btn dark p-x-md pull-right">{{ __('backend.update') }}</button>
                        @endif
                    <div class="col-md-12">
                        <small>

                            <a href="{{route('admin.cruiseShip.editOrCreate',$ship->id).'?tab=RateTable'}}">
                                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                Go Back</a>
                        </small>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-12 p-l-2">
                            <h6 style="color: grey">
                                <label>Ship: </label><small> {{$ship->name}}</small>

                            </h6>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <!-- Tab links -->
                        <div class="mtab">
                            <a href="{{route('admin.shipRateTable.editOrCreate',$ship_id).'?tab=Basic&table_id='.$table_id}}">
                                <button class="mtablinks  {{$_GET['tab']=="Basic"?'active':''}}" >Basic</button>
                            </a>
                            <a href="{{route('admin.shipRateTable.editOrCreate',$ship_id).'?tab=RoomType&table_id='.$table_id}}">
                                <button class="mtablinks {{$_GET['tab']=="RoomType"?'active':''}}">Room Type</button>
                            </a>

                        </div>
                        <br>
                        <!-- Tab content -->
                        <div id="Basic" class="mtabcontent {{$_GET['tab']=="Basic"?'mtabActive':''}}">

                            @if($table_id==0)
                                @include('dashboard.ships.add-rate-table')
                            @else
                                @include('dashboard.ships.edit-rate-table')
                            @endif
                        </div>

                        <div id="RoomType" class="mtabcontent {{$_GET['tab']=="RoomType"?'mtabActive':''}}">
                            @if($table_id!=0)
                            @include('dashboard.ship-room.list2')
                                @endif

                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function addRateTable() {
            alert("ok")
            document.getElementById('addRateTable').submit();
        }
    </script>
@endsection

