
    <form method="post" id="tourAddForm" action="{{route('admin.offer.create')}}" enctype="multipart/form-data">
        @csrf

        <input id="redirectUrl" name="redirectUrl" hidden value=""  class="form-control">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <label>Promotion Offer Name</label><br>
                        <input name="name" value="{{old('name')}}" required class="form-control">
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-6">
                        <label>Promotion Offer Code</label><br>
                        <input name="code" value="{{old('code')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label>Promotion Offer Type</label><br>
                        <select id="OfferType" onchange="ChangeLayout()" class="form-control" name="type">
                            @foreach(['Hotel','Multi Hotel','Tour','Cruise','Cruise + Hotel','Cruise + Multi Hotel'] as $c)
                                <option value="{{$c}}" >{{$c}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Minimum Guest</label><br>
                        <input name="min_guest" type="number" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Maximum Guest</label><br>
                        <input name="max_guest" type="number" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <div style="width: 100%">
                            <div style="width: 49%; float: left">
                                <label>Effective Date (Start)</label><br>
                                <input name="effective_date_start" type="date" value="{{old('effective_date_start')?old('effective_date_start'):\Carbon\Carbon::now()->toDateString()}}" required class="form-control">

                            </div>
                            <div style="width: 49%; float: left; margin-left:2%">
                                <label>Effective Date (End)</label><br>
                                <input name="effective_date_end" type="date" value="{{old('effective_date_end')}}" required class="form-control">

                            </div>
                        </div>

                    </div>

                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Departure Date (Start)</label><br>
                        <input name="departure_date_start" type="date" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Departure Date (End)</label><br>
                        <input name="departure_date_end" type="date" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <div style="width: 100%">
                            <div style="width: 49%; float: left">
                                <label>Booking Date (Start)</label><br>
                                <input name="booking_date_start" type="date" value="{{old('effective_date_start')}}" required class="form-control">

                            </div>
                            <div style="width: 49%; float: left; margin-left:2%">
                                <label>Booking Date (End)</label><br>
                                <input name="booking_date_end" type="date" value="{{old('effective_date_end')}}" required class="form-control">

                            </div>
                        </div>

                    </div>

                    <div class="col-md-1">
                    </div>
                    <div class="col-md-6">
                        <label>Sorting Number</label><br>
                        <input name="sort_number" type="number" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>

                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label>Markup Type</label><br>
                        <select onchange="ChangeMarkup()" class="form-control" id="markup_type" name="markup_type">
                            @foreach(['Percentage (%)','Amount($)','Percentage (%) + Amount($)'] as $c)
                                <option value="{{$c}}" >{{$c}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Markup Percentage</label><br>
                        <input id="markup_percentage" name="markup_percentage" type="number" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Markup Amount</label><br>
                        <input disabled id="markup_amount" name="markup_amount" type="number" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label>Agent Commission</label><br>
                        <select id="commission" onchange="ChangeCommission()"  class="form-control" name="agent_commission">
                            @foreach(['Percentage (%)','Amount($)','Percentage (%) + Amount($)','None'] as $c)
                                <option value="{{$c}}" >{{$c}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Commission Percentage</label><br>
                        <input id="c_percentage" name="commission_percentage" type="number" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Commission Amount</label><br>
                        <input id="c_amount" disabled name="commission_amount" type="number" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <label>Tag</label><br>
                        <select class="form-control js-select-basic-single" name="tag[]" multiple>
                            @foreach(\App\Helpers\Helper::tags() as $c)
                                <option value="{{$c->id}}" >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 text-left">
                        <label>Status</label><br>
                        <select class="form-control" name="status" required>
                            <option value="1">active</option>
                            <option value="0">unactive</option>
                        </select>
                    </div>
                </div><br>




            </div>

    </form>

<script>

    function ChangeLayout()
    {
        var type=$("#OfferType").val();

        HideAll()
        if (type=="Cruise + Hotel")
        {
            $("#HotelTab").css('display','block')
            $("#CruiseTab").css('display','block')
        }
        if (type=="Cruise + Multi Hotel")
        {
            $("#HotelTab").css('display','block')
            $("#CruiseTab").css('display','block')
        }
     if (type=="Hotel")
     {
         $("#HotelTab").css('display','block')
     }
        if (type=="Multi Hotel")
        {
            $("#HotelTab").css('display','block')
        }
        if (type=="Cruise")
        {
            $("#CruiseTab").css('display','block')
        }
        if (type=="Tour")
        {
            $("#TourTab").css('display','block')
        }

    }
    function HideAll()
    {
        $("#HotelTab").css('display','none')
        $("#TourTab").css('display','none')
        $("#CruiseTab").css('display','none')
    }
    function ChangeMarkup()
    {
        $val=$("#markup_type").val()
        if ($val=='Percentage (%)')
        {
            $("#markup_percentage").prop("disabled",false)
            $("#markup_amount").prop("value",'')
            $("#markup_amount").prop("disabled",true)
        }
        else if ($val=='Amount($)')
        {
            $("#markup_amount").prop("disabled",false)
            $("#markup_percentage").prop("value",'')
            $("#markup_percentage").prop("disabled",true)
        }
        else
        {
            $("#markup_amount").prop("disabled",false)
            $("#markup_percentage").prop("disabled",false)
        }

    }
    function ChangeCommission()
    {
        $val=$("#commission").val()
        if ($val=='Percentage (%)')
        {
            $("#c_percentage").prop("disabled",false)
            $("#c_amount").prop("value",'')
            $("#c_amount").prop("disabled",true)
        }
        else if ($val=='Amount($)')
        {
            $("#c_amount").prop("disabled",false)
            $("#c_percentage").prop("value",'')
            $("#c_percentage").prop("disabled",true)
        }
        else if ($val="Percentage (%) + Amount($)")
        {
            $("#c_amount").prop("disabled",false)
            $("#c_percentage").prop("disabled",false)
        }
        else
        {
            $("#c_amount").prop("value",'')
            $("#c_amount").prop("disabled",true)
            $("#c_percentage").prop("value",'')
            $("#c_percentage").prop("disabled",true)
        }

    }

    function early_bird()
    {

        if ($("#early_bird").prop('checked'))
        {
            $("#early_bird_before_departure_date").prop("disabled",false)

        }
        else
        {
            $("#early_bird_before_departure_date").prop("disabled",true)

        }
    }
</script>
