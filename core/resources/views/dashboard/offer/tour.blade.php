
    <div class="container-fluid">
        <label>Tour Name</label><br>
        <form action="{{route('admin.offer.addTour')}}" method="post" id="flightForm">
            @csrf
            <input id="redirectUrlforFlight" name="redirectUrl" hidden value="">
            <input name="offer_id" id="offer_id"  hidden value="{{$offer_id}}">
        <div class="row">
            <div class="col-md-5">

                <select class="dark form-control" name="tour_id">

               @foreach(\App\Models\tour::where(['deleted_at'=>null,'status'=>'1'])->get() as $t )
                        <option value="{{$t->id}}">{{$t->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-md-2">

                <button class="btn dark form-control">Add</button>
            </div>
            <div class="col-md-5">

                <a onclick="BulkDelete()" class="btn btn-danger  pull-right" id="btnDell" style="color: white">remove</a>
            </div>
        </div>
</form>
        <br>
<div class="row">
    <div class="col-md-1">

    </div>
    <div class="col-md-3">
        <input readonly class="form-control bg-dark" value="Tour Name">
    </div>
    <div class="col-md-2">
        <input readonly class="form-control bg-dark" value="Tour Code">
    </div>
    <div class="col-md-1">
        <input readonly class="form-control bg-dark" value="Action">
    </div>
</div>
        @foreach($tours as $h)
            <?php
            $tour=\App\Models\tour::find($h->tour_id)
            ?>
<br>
            <div class="row">
                <div class="col-md-1">
                    <input style="zoom: 2" type="checkbox" id="otCheckBox" data-id="{{$h->id}}">
                </div>
                <div class="col-md-3">
                    <input readonly class="form-control bg-dark" value="{{$tour->name}}">
                </div>
                <div class="col-md-2">
                    <input readonly class="form-control bg-dark" value="{{$tour->code}}">
                </div>
                <div class="col-md-1">
                    <button class="btn dark form-control">Edit</button>
                </div>
            </div>
        @endforeach


    </div>

<br>
<br>
<hr>

<script>
    function BulkDelete() {
        var checkboxes = document.querySelectorAll('input[id="otCheckBox"]');
        var tempArray=[];
        for (var checkbox of checkboxes) {

            if (checkbox.checked)
            {
                tempArray.push(checkbox.getAttribute('data-id'))
            }

        }

        console.log(tempArray)
        if (tempArray.length>0)
        {
            $("#btnDell").text("Removing...")
            $.ajax({
                type:'post',
                url:'{{route('admin.offer.removeTour')}}',
                data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                success:function(data){
                    console.log(data)
                    window.location.reload()
                }})
        }
    }
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
