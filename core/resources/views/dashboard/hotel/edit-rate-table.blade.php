
<form method="post" action="{{route('admin.hotelRateTable.update',$table->id)}}" enctype="multipart/form-data">
    @csrf
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <label>Rate Table Name</label><br>
            <input name="name" value="{{$table->name}}" required class="form-control">
        </div>
        <div class="col-md-4">
            <label>Rate Table Code</label><br>
            <input name="code" value="{{$table->code}}" required class="form-control">
        </div>
        <div class="col-md-4">
            <label>Currency</label><br>
            <select class="form-control" name="currency_id">
                <option value="{{\App\Helpers\Helper::get_Currency($table->currency_id)->id}}" >{{\App\Helpers\Helper::get_Currency($table->currency_id)->name}}</option>
                @foreach(\App\Helpers\Helper::Currencies() as $c)
                    <option value="{{$c->id}}" >{{$c->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <br>
    <div class="row">

        <div class="col-md-4">
            <label>Supplier</label><br>
            <select class="form-control" name="supplier_id">
                <option value="{{\App\Helpers\Helper::get_Supplier($table->supplier_id)->id}}" >{{\App\Helpers\Helper::get_Supplier($table->supplier_id)->name}}</option>
                @foreach(\App\Helpers\Helper::Suppliers() as $c)
                    <option value="{{$c->id}}" >{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label>Effective Date (start)</label><br>
            <input name="effective_start_date" type="date" value="{{$table->effective_start_date}}" required class="form-control">
        </div>
        <div class="col-md-4">
            <label>Effective Date (end)</label><br>
            <input name="effective_end_date" value="{{$table->effective_end_date}}" required  type="date" class="form-control">
        </div>
    </div><br>

    <br>
    <small>Special Offer Type</small><br>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="pull-left m-l-2">
                <input {{$table->early_bird=="1"?'checked':""}} name="early_bird" type="checkbox" style="zoom:1"   >
                <label>Early Bird</label>
            </div>
            <div class="pull-left m-l-2">
                <input {{$table->bonus_night=="1"?'checked':""}} name="bonus_night" type="checkbox" style="zoom:1"   >
                <label>Bonus Night</label>
            </div>
        </div>
        <div class="col-md-4">
            <label>Early Bird Before Chek in Date</label><br>
            <input name="early_bird_before_departure_date" value="{{$table->early_bird_before_departure_date}}"  type="number" class="form-control">
        </div>
        <div class="col-md-4">

            <label>Status</label><br>
            <select class="form-control" name="status" required>
                @if($table->status=="1")
                    <option value="1">active</option>
                @else
                    <option value="0">unactive</option>
                @endif
                <option value="1">active</option>
                <option value="0">unactive</option>
            </select>

        </div>

    </div>


    <br>
    <div class="row">
        <div class="col-md-4">

            <label>Bonus Night Type</label><br>
            <option value="{{$table->bonus_night_type}}">{{$table->bonus_night_type}}</option>

            <select class="form-control" name="bonus_night_type" >
                <option value="Accumulated / Once">Accumulated / Once</option>

            </select>

        </div>
        <div class="col-md-2">
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
    <br>
    <div class="row">
        <div class="col-md-4">


        </div>
        <div class="col-md-2">
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
        <div class="col-md-12">
            <button type="submit"
                    class="btn success p-x-md pull-right">{{ __('backend.update') }}</button>
        </div>
    </div>



</div>
</form>