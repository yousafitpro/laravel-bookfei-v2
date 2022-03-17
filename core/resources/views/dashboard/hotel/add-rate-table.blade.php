


<form method="post" id="addRateTable" action="{{route('admin.hotelRateTable.create')}}" enctype="multipart/form-data">
    @csrf
<input hidden  name="hotel_id" value="{{$hotel_id}}">
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
                    <div class="col-md-3">
                        <label>Effective Date (Start)</label><br>
                        <input name="effective_start_date" type="date" value="{{old('effective_start_date')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Effective date (End)</label><br>
                        <input name="effective_end_date" value="{{old('effective_end_date')}}" required  type="date" class="form-control">
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
                <small>Special Offer Type</small><br>
                <br>
                <div class="row">
                    <div class="col-md-6">

                        <div class="pull-left" >
                            <span onclick="early_bird()">
                                                         <input id="early_bird" name="early_bird" type="checkbox" style="zoom:1"   >
{{--asddsdsdasasas--}}
                            </span>
                            <label  >Early Bird</label>
                        </div>

                        <div class="pull-left m-l-2">
                            <span onclick="bonus_night()">
                                                 <input onclick="bonus_night()" id="bonus_night" name="bonus_night" type="checkbox" style="zoom:1"   >

                            </span>
                            <label>Bonus Night</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Early Bird Before Chek in Date</label><br>
                        <input id="early_bird_before_departure_date" disabled name="early_bird_before_departure_date" value="{{old('early_bird_before_departure_date')}}" type="number" class="form-control">
                    </div>


                </div>


                <br>
                <div class="row">
                    <div class="col-md-4">

                        <label>Bonus Night Type</label><br>
                        <select id="bonus_night_type" class="form-control" disabled name="bonus_night_type" >
                            <option value="Accumulated">Accumulated</option>
                            <option value="Once">Once</option>

                        </select>
                        <br>
                        <br>
                        <label>Status</label><br>
                        <select  name="status" required>
                            <option value="1">active</option>
                            <option value="0">unactive</option>
                        </select>

                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-3">
                        <label>Buy X Nights</label><br>
                        <input id="x_nights" disabled name="x_nights" value="{{old('early_bird_before_departure_date')}}"  type="number" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Get Y Free Nights</label><br>
                        <input id="y_nights" disabled name="y_nights" value="{{old('early_bird_before_departure_date')}}"  type="number" class="form-control">
                    </div>



                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">


                    </div>



                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>

            </div>

</form>
<script>
    function early_bird()
    {

       if ($("#early_bird").prop('checked'))
       {
           $("#bonus_night_type").prop("disabled",false)
           $("#x_nights").prop("disabled",false)
           $("#y_nights").prop("disabled",false)
       }
       else
       {
           $("#bonus_night_type").prop("disabled",true)
           $("#x_nights").prop("disabled",true)
           $("#y_nights").prop("disabled",true)
       }
    }
    function bonus_night()
    {

        if ($("#bonus_night").prop('checked'))
        {
            $("#early_bird_before_departure_date").prop("disabled",false)
        }
        else
        {
            $("#early_bird_before_departure_date").prop("disabled",false)
        }
    }

</script>
