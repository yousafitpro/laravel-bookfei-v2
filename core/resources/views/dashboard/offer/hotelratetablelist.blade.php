@foreach($list as $item)
    <br>
    <div class="row">
        <div class="col-sm-3">
            <input value="{{$item->name}}" class="form-control" readonly>
        </div>
        <div class="col-sm-2">
            <input class="form-control" value="{{$item->effective_start_date}}" readonly>
        </div>
        <div class="col-sm-2">
            <input class="form-control" value="{{$item->effective_end_date}}" readonly>
        </div>
        <div class="col-sm-2">
            <input class="form-control" value="yes" readonly>
        </div>
        <div class="col-sm-1">
            <input name="rate_table_id" value="{{$item->id}}" required class="form-control" style="zoom: 0.5" type="radio" readonly>
        </div>
    </div>
@endforeach
