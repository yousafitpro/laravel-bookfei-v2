


<form method="post" id="editRateTable" action="{{route('admin.shipRateTable.update',$table->id)}}" enctype="multipart/form-data">
    @csrf

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <label>Rate Table Name</label><br>
                <input name="name" value="{{$table->name}}" required class="form-control">
            </div>
            <div class="col-md-6">
                <label>Rate Table Code</label><br>
                <input name="code" value="{{$table->code}}" required class="form-control">
            </div>

        </div>

        <br>
        <div class="row">
            <div class="col-md-6">
                <label>Currency</label><br>
                <select class="form-control" name="currency_id">
                    @foreach(\App\Helpers\Helper::Currencies() as $c)
                        <option value="{{$c->id}}" {{$table->currency_id==$c->id?'selected':''}} >{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>Supplier</label><br>
                <select class="form-control" name="supplier_id">
                    @foreach(\App\Helpers\Helper::Suppliers() as $c)
                        <option value="{{$c->id}}" {{$table->supplier_id==$c->id?'selected':''}} >{{$c->name}}</option>
                    @endforeach
                </select>
            </div>

        </div><br>
        <div class="row">
            <div class="col-md-3">
                <label>Effective Date (Start)</label><br>
                <input name="effective_start_date" type="date" value="{{$table->effective_start_date}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Effective date (End)</label><br>
                <input name="effective_end_date" value="{{$table->effective_end_date}}" required  type="date" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Nights</label><br>
                <input name="nights" value="{{$table->nights}}"  type="number" class="form-control">
            </div>

        </div>
        <br>
        <small>Special Offer Type</small><br>
        <br>
        <div class="row">
            <div class="col-md-6">

                <div class="pull-left">
                    <input name="early_bird" type="checkbox" {{$table->early_bird?'checked':''}} style="zoom:1"   >
                    <label>Early Bird</label>
                </div>

                <div class="pull-left m-l-2">
                    <input name="bonus_night" type="checkbox" {{$table->bonus_night?'checked':''}} style="zoom:1"   >
                    <label>Bonus Night</label>
                </div>
            </div>

            <div class="col-md-6">
                <label>Early Bird Before Chek in Date</label><br>
                <input name="early_bird_before_departure_date" value="{{$table->early_bird_before_departure_date}}" type="number" class="form-control">
            </div>


        </div>


        <br>
        <div class="row">
            <div class="col-md-6">

                <label>Bonus Night Type</label><br>
                <select class="form-control" name="bonus_night_type" >
                    <option value="Accumulated" {{$table->bonus_night_type=='Accumulated'?'selected':''}}>Accumulated</option>
                    <option value="Once" {{$table->bonus_night_type=='Once'?'selected':''}}>Once</option>

                </select>
                <br>
                <br>


            </div>

            <div class="col-md-3">
                <label>Buy X Nights</label><br>
                <input name="x_nights" value="{{$table->x_nights}}"  type="number" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Get Y Free Nights</label><br>
                <input name="y_nights" value="{{$table->y_nights}}"  type="number" class="form-control">

            </div>


        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Free Guest Rule</label><br>
                <input name="free_guest_rule" value="{{$table->free_guest_rule}}"  type="text" class="form-control">

            </div>
            <div class="col-md-6">
                <label>Status</label><br>
                <select  name="status" required>
                    <option value="1" {{$table->status=='1'?'selected':''}}>active</option>
                    <option value="0" {{$table->status=='0'?'selected':''}}>unactive</option>
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
