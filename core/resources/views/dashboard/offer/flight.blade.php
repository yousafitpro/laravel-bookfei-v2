<form action="{{route('admin.offer.addFlight')}}" method="post" id="flightForm">
    @csrf
<input id="redirectUrlforFlight" name="redirectUrl" hidden value="">
    <input name="offer_id" id="offer_id"  hidden value="{{$offer_id}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <label>Flight Route Type</label><br>
                <select class="dark form-control" name="flight_route_type">
                    <option value="Round">Round</option>
                    <option value="One Way">One Way</option>
                    <option value="Stopover">Stopover</option>
                    <option value="None">None</option>
                </select>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Departure Airport</label><br>
                <select class="dark form-control" name="departure_airport">
                   @foreach(\App\Models\airport::where(["deleted_at"=>null,'status'=>'1'])->get() as $a)
                        <option value="{{$a->id}}">{{$a->name}}</option>
                    @endforeach

                </select>

            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-5">
                <label>Arrival Airport</label><br>
                <select class="dark form-control" name="arrival_airport">
                    @foreach(\App\Models\airport::where(["deleted_at"=>null,'status'=>'1'])->get() as $a)
                        <option value="{{$a->id}}">{{$a->name}}</option>
                    @endforeach
                </select>

            </div>
        </div>


        <br>

        <input hidden name="tab" value="{{@request('tab')}}">
        <div class="row">
            <div class="col-md-5">
                <label>Airline</label><br>
                <select class="dark form-control js-select-basic-single" name="airline[]" multiple >
                    @foreach(\App\Models\airline::where(["deleted_at"=>null,'status'=>'1'])->get() as $a)
                        <option value="{{$a->id}}">{{$a->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-5">
                <label>Booking Class</label><br>
                <input required type="number" class="form-control" name="class">
            </div>
        </div>

        <br>
        <label>Class</label><br>
        <div class="row">
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                <input type="radio"  >
                <label>First</label>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                <input type="radio"  >
                <label>Bussiness</label>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                    <input type="radio"  >
                    <label>Premium Econ</label>
                </div>

            </div>
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                <input type="radio"  >
                <label>Econmy</label>
                </div>
            </div>
        </div>







    </div>
</form>
<br>
<br>
<hr>
@foreach($flights as $h)
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label>{{$h->flight_route_type}}</label><br>


            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Day</label><br>
                <input class="form-control" type="number" value="0">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <a href="{{route('admin.offer.removeFlight',$h->id)}}" class="btn btn-danger pull-right " style="color: white">Remove</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Departure Airport</label><br>
                <select class="dark form-control" name="departure_airport">
                    <option value="Round">{{\App\Models\airport::find($h->departure_airport)->name}}</option>

                </select>

            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-5">
                <label>Arrival Airport</label><br>
                <select class="dark form-control" name="arrival_airport">
                    <option value="{{\App\Models\airport::find($h->arrival_airport)->id}}">{{\App\Models\airport::find($h->arrival_airport)->name}}</option>
                </select>

            </div>
        </div>


        <br>

        <input hidden name="tab" value="{{@request('tab')}}">
        <div class="row">
            <div class="col-md-5">
                <label>Airline</label><br>
                <select class="dark form-control js-select-basic-single" name="airline" multiple>
                    @foreach($h->airline as $a)
                        <option selected>{{\App\Models\airline::find($a)->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <input class="form-control" value="{{$h->class}}">
            </div>
        </div>

        <br>
        <label>Class</label><br>
        <div class="row">
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                    <input type="radio" name="class" >
                    <label>First</label>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                    <input type="radio" name="class" >
                    <label>Bussiness</label>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                    <input type="radio" name="class" >
                    <label>Premium Econ</label>
                </div>

            </div>
            <div class="col-md-2 ">
                <div class="myFlex" style="width: 100%">
                    <input type="radio" name="class" >
                    <label>Econmy</label>
                </div>
            </div>
        </div>







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
