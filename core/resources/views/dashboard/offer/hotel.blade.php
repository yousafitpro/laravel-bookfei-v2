<form action="{{route('admin.offer.addHotel')}}" method="post" id="hotelForm34">
    @csrf


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
                <a href="javascript:void" onclick="addMoreHotel()" class="btn btn-primary dark" style="color: white">Add More Hotel</a>
            </div>
        </div>
        <br>
    </div>

@endif


        @csrf
        <input id="redirectUrlforHotel" name="redirectUrl" hidden value="">
        <input name="offer_id" id="offer_id"  hidden value="{{$offer_id}}">
    <div class="container-fluid">
        <input hidden name="tab" value="{{@request('tab')}}">
        <div class="row">
            <div class="col-md-4">
                <label>Hotel z</label>
                <select required onchange="updateList3('UpdateHotelRateTableList','#hotel_id')" class="form-control js-select-basic-single" id="hotel_id" name="hotel_id">
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
                <select readonly onchange="updateList3('updateList{{$h->id}}','#hotel_id{{$h->id}}','{{$h->id}}')"   class="form-control bg-dark" id="hotel_id{{$h->id}}" name="hotel_id">
                  @foreach(\App\Models\hotel::where(['deleted_at'=>null,'status'=>1])->get() as $h2)
                    <option value="{{$h2->id}}" {{($h->hotel_id!=null && $h->hotel_id==$h2->id)?'selected':''}}>{{$h2->name}}</option>
                    @endforeach



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
                <input class="form-control" onkeyup="updateOfferHotelColumn3('{{$h->id}}','hotel_group','#group{{$h->id}}','on')" id="group{{$h->id}}" required type="number" value="{{$h->hotel_group}}">
            </div>
            <div class="col-md-2">
                <label>Nights</label>
                <input onkeyup="updateOfferHotelColumn3('{{$h->id}}','nights','#nights{{$h->id}}','on')" id="nights{{$h->id}}" class="form-control" required type="number" value="{{$h->nights}}">
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
        <div id="updateList{{$h->id}}">
        @if($h->hotel_id!=null)

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

                 <input  onclick="updateOfferHotelColumn3('{{$h->id}}','rate_table_id','{{$item->id}}','off')" name="rate_table_id{{$h->id}}" {{$h->rate_table_id==$item->id?'checked':''}} required class="form-control" style="zoom: 0.5" type="radio" >
             </div>
         </div>
     @endforeach

    @endif
 </div>
    </div>
@endforeach
<script>

    function updateOfferHotelColumn3(id,column,value,status)
    {
 if (status!='off')
 {
     value=$(value).val()
 }

       // var hotel_id=$("#hotel_id"+id).val()
        $.ajax({
            type:'post',
            url:"{{route('admin.offer.updateOfferHotelColumn')}}",
            data:{"_token":"{{ csrf_token() }}",'hotel_id':id,'column':column,'value':value},
            success:function(data){
                // window.location.reload()


            }})
    }
    function addMoreHotel()
    {
        var hote_id=$("#hotel_id").val()
        $.ajax({
            type:'post',
            url:'{{route('admin.offer.updateTotalHotel')}}',
            data:{"_token":"{{ csrf_token() }}",'offer_id':'{{$offer->id}}'},
            success:function(data){
              window.location.reload()


            }})
    }
function updateList3(id,id2,hotel_id_new=null)
{
if (hotel_id_new!=null)
{
    updateOfferHotelColumn3(hotel_id_new,'hotel_id',"#hotel_id"+hotel_id_new,'on')
}
    var hote_id=$(id2).val()

    $.ajax({
        type:'get',
        url:'{{route('admin.offer.UpdateHotelRateTableList')}}',
        data:{"_token":"{{ csrf_token() }}",'id':hote_id},
        success:function(data){
            $("#"+id).empty()
            $("#"+id).append(data)


        }})
}
</script>
