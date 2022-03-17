
<form method="post" id="editRateTable" action="{{route('admin.hotelRateTable.update',$table->id)}}" enctype="multipart/form-data">
    @csrf
    <input hidden  name="hotel_id" value="{{$hotel_id}}">
<div class="container-fluid">
    <div class="row">

        <div class="col-md-6 ">
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
                    <option value="{{$c->id}}" {{$table->currency_id==$c->id?'selected':''}}>{{$c->name}}</option>
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
        <div class="col-md-3 " >
            <label> Effective date (Start)</label><br>
            <input name="effective_start_date" style="background-color: gray; color: white" type="date" value="{{$table->effective_start_date}}" required class="form-control">
        </div>
        <div class="col-md-3">
            <label> Effective date (End)</label><br>
            <input name="effective_end_date" style="background-color: gray; color: white" value="{{$table->effective_end_date}}" required  type="date" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Minimum Nights</label><br>
            <input name="min_nights"  value="{{$table->min_nights}}"  type="number" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Maximum Nights</label><br>
            <input name="max_nights" value="{{$table->max_nights}}"  type="number" class="form-control">
        </div>
    </div>
<br>
    <div class="row">

    </div>
    <br>
    <small>Special Offer Type</small><br>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div class="pull-left m-l-2">
                <span onclick="early_bird()">
                                    <input {{$table->early_bird=="1"?'checked':""}} id="early_bird" name="early_bird" type="checkbox" style="zoom:1"   >

                </span>
                <label>Early Bird</label>
            </div>
            <div class="pull-left m-l-2">
                <span onclick="bonus_night()">
                                    <input {{$table->bonus_night=="1"?'checked':""}} id="bonus_night" name="bonus_night" type="checkbox" style="zoom:1"   >

                </span>
                <label>Bonus Night</label>
            </div>
            <br>





        </div>
        <div class="col-md-6">
            <label>Early Bird Before Chek in Date</label><br>
            <input {{$table->early_bird=="0"?'disabled':""}} id="early_bird_before_departure_date" name="early_bird_before_departure_date" value="{{$table->early_bird_before_departure_date}}"  type="number" class="form-control">
        </div>


    </div>

{{--sadad--}}
    <br>
    <div class="row">
        <div class="col-md-4">

            <label>Bonus Night Type </label><br>


            <select class="form-control" name="bonus_night_type" id="bonus_night_type" {{$table->bonus_night=="0"?'disabled':""}}  >
{{--                <option value="{{$table->bonus_night_type}}">{{$table->bonus_night_type}}</option>--}}
                <option value="Accumulated" {{$table->bonus_night_type=="Accumulated"?'selected':''}}>Accumulated</option>
                <option value="Once" {{$table->bonus_night_type=="Once"?'selected':''}}>Once</option>

            </select>

            <br>
            <label>Status</label><br>
            <select name="status" required>
                @if($table->status=="1")
                    <option value="1">active</option>
                @else
                    <option value="0">unactive</option>
                @endif
                <option value="1">active</option>
                <option value="0">unactive</option>
            </select>

        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <label>Buy X Nights</label><br>
            <input name="x_nights" id="x_nights" {{$table->bonus_night=="0"?'disabled':""}} value="{{$table->x_nights}}"  type="number" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Get Y Free Nights</label><br>
            <input name="y_nights" id="y_nights" {{$table->bonus_night=="0"?'disabled':""}} value="{{$table->y_nights}}"  type="number" class="form-control">
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-md-4">


        </div>
        <div class="col-md-2">
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
            $("#early_bird_before_departure_date").prop("disabled",true)
        }
    }

</script>
