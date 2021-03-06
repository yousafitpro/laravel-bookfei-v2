


<form method="post" id="addRateTable" action="{{route('admin.shipRateTable.create')}}" enctype="multipart/form-data">
    @csrf
<input hidden  name="cruise_ship_id" value="{{$ship_id}}">
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
                    <div class="col-md-6">
                        <label>Nights</label><br>
                        <input name="nights" value="{{old('nights')}}"  type="number" class="form-control">
                    </div>

                </div>
<br>
                <small>Special Offer Type</small><br>
                <br>
                <div class="row">
                    <div class="col-md-6">

                        <div class="pull-left">
                            <input name="early_bird" type="checkbox" style="zoom:1"   >
                            <label>Early Bird</label>
                        </div>

                        <div class="pull-left m-l-2">
                            <input name="bonus_night" type="checkbox" style="zoom:1"   >
                            <label>Bonus Night</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Early Bird Before Chek in Date</label><br>
                        <input name="early_bird_before_departure_date" value="{{old('early_bird_before_departure_date')}}" type="number" class="form-control">
                    </div>


                </div>


                <br>
                <div class="row">
                    <div class="col-md-6">

                        <label>Bonus Night Type</label><br>
                        <select class="form-control" name="bonus_night_type" >
                            <option value="Accumulated">Accumulated</option>
                            <option value="Once">Once</option>

                        </select>
                        <br>
                        <br>


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

                <div class="row">
                    <div class="col-md-6">
                        <label>Free Guest Rule</label><br>
                        <input name="free_guest_rule" value="{{old('free_guest_rule')}}"  type="text" class="form-control">

                    </div>
                    <div class="col-md-6">
                        <label>Status</label><br>
                        <select  name="status" required>
                            <option value="1">active</option>
                            <option value="0">unactive</option>
                        </select>
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

</script>
