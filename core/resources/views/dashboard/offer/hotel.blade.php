<form action="{{route('admin.offer.updateTotalHotel')}}" method="post" >
    @csrf

    <input name="offer_id" id="offer_id"  hidden value="{{$offer_id}}">
    <div class="container-fluid">
        @if($offer->type=="Multi Hotel")
        <div class="row">
            <div class="col-md-4">
                <label>Total number of hotels in this offer</label>
                <input required class="form-control" name="total_num_of_hotels" type="number" value="{{$offer->total_num_of_hotels}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary dark" style="color: white">Add More Hotel</button>
            </div>
        </div>
        <br>
    </div>
</form>
@endif
    <form action="{{route('admin.offer.addHotel')}}" method="post" id="hotelForm">
        @csrf
        <input id="redirectUrlforHotel" name="redirectUrl" hidden value="">
        <input name="offer_id" id="offer_id"  hidden value="{{$offer_id}}">
    <div class="container-fluid">
        <input hidden name="tab" value="{{@request('tab')}}">
        <div class="row">
            <div class="col-md-4">
                <label>Hotel</label>
                <select required onchange="updateList()" class="form-control js-select-basic-single" id="hotel_id" name="hotel_id">
                    <option value="none">Select Hotel</option>
                    @foreach(\App\Models\hotel::where("deleted_at",null)->get() as $h)
                        <option value="{{$h->id}}">{{$h->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

   @if($offer->type=="Hotel")
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label>Minimum Nights</label>
                    <input class="form-control" required type="number" name="min_nights">
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <label>Maximum Nights</label>
                    <input class="form-control" required type="number" name="max_nights">
                </div>
            </div>
       @endif
            @if($offer->type=="Multi Hotel")
        <br>
        <div class="row">
            <div class="col-md-2">
                <label>Hotel Group</label>
                <input class="form-control" required type="number" name="hotel_group">
            </div>
            <div class="col-md-2">
                <label>Nights</label>
                <input class="form-control" required type="number" name="nights">
            </div>
            <div class="col-md-2">
                <br>
                <br>
                <div class="myFlex" style="width: 100%">
                    <input type="checkbox" name="is_compulsory" >
                    <label>Compulsory</label>
                </div>
            </div>
        </div>
            @endif
        <br>
        <div class="row">
            <div class="col-sm-3">
                <input value="Rate Table Name" class="form-control" readonly>
            </div>
            <div class="col-sm-2">
                <input class="form-control" value="Effective From" readonly>
            </div>
            <div class="col-sm-2">
                <input class="form-control" value="Effective To" readonly>
            </div>
            <div class="col-sm-2">
                <input class="form-control" value="Special Offer" readonly>
            </div>
            <div class="col-sm-1">
                <input class="form-control" value="Select" readonly>
            </div>
        </div>
        <div id="UpdateHotelRateTableList">

        </div>






    </div>
</form>
<br>
<br>
<hr>
@foreach($hotels as $h)
    <br>
    <div class="container-fluid">



        <div class="row">
            <div class="col-md-4">
                <label>Hotel</label>
                <select readonly  class="form-control bg-dark" id="hotel_id" name="hotel_id">
                    <option value="none">{{\App\Models\hotel::find($h->hotel_id)->name}}</option>



                </select>
            </div>
            <div class="col-md-8">
                <a href="{{route('admin.offer.removeHotel',$h->id)}}">
                    <button class="btn btn-danger pull-right">Remove</button>
                </a>

            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-2">
                <label>Hotel Group</label>
                <input class="form-control" required type="number" value="{{$h->hotel_group}}">
            </div>
            <div class="col-md-2">
                <label>Nights</label>
                <input class="form-control" required type="number" value="{{$h->nights}}">
            </div>
            <div class="col-md-2">
                <br>
                <br>
                <div class="myFlex" style="width: 100%">
                    <input type="checkbox" {{$h->is_compulsory=='true'?'checked':''}} >
                    <label>Compulsory</label>
                </div>
            </div>
        </div>
        <br>   <div class="row">
            <div class="col-sm-3">
                <input value="Rate Table Name" class="form-control" readonly>
            </div>
            <div class="col-sm-2">
                <input class="form-control" value="Effective From" readonly>
            </div>
            <div class="col-sm-2">
                <input class="form-control" value="Effective To" readonly>
            </div>
            <div class="col-sm-2">
                <input class="form-control" value="Special Offer" readonly>
            </div>
            <div class="col-sm-1">
                <input class="form-control" value="Select" readonly>
            </div>
        </div>
        <br>
        @foreach(\App\Models\hotelRateTable::where(['hotel_id'=>$h->hotel_id,'deleted_at'=>null])->get() as $item)
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
                    <input name="rate_table_id{{$item->id}}" {{$h->rate_table_id==$item->id?'checked':''}} required class="form-control" style="zoom: 0.5" type="radio" readonly>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
<script>
function updateList()
{
    var hote_id=$("#hotel_id").val()
    $.ajax({
        type:'get',
        url:'{{route('admin.offer.UpdateHotelRateTableList')}}',
        data:{"_token":"{{ csrf_token() }}",'id':hote_id},
        success:function(data){
            $("#UpdateHotelRateTableList").empty()
            $("#UpdateHotelRateTableList").append(data)


        }})
}
</script>
