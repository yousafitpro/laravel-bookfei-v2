
<form method="post" id="tourUpdateForm" action="{{route('admin.offer.update',$offer->id)}}" enctype="multipart/form-data">
    @csrf

    <input id="redirectUrl" name="redirectUrl" hidden value=""  class="form-control">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <label>Promotion Offer Name</label><br>
                <input name="name" value="{{$offer->name}}" required class="form-control">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <label>Promotion Offer Code</label><br>
                <input name="code" value="{{$offer->code}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Promotion Offer Type</label><br>
                <select class="form-control" name="type">
                    @foreach(['Hotel','Multi Hotel','Cruise'] as $c)
                        <option value="{{$c}}" {{$offer->type==$c?'selected':''}} >{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <label>Minimum Guest</label><br>
                <input name="min_guest" type="number" value="{{$offer->min_guest}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Maximum Guest</label><br>
                <input name="max_guest" type="number" value="{{$offer->max_guest}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <div style="width: 100%">
                    <div style="width: 49%; float: left">
                        <label>Effective Date (Start)</label><br>
                        <input name="effective_date_start"  type="date" value="{{$offer->effective_date_start}}" required class="form-control">

                    </div>
                    <div style="width: 49%; float: left; margin-left:2%">
                        <label>Effective Date (End)</label><br>
                        <input name="effective_date_end" type="date" value="{{$offer->effective_date_end}}" required class="form-control">

                    </div>
                </div>

            </div>

            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <label>Departure Date (Start)</label><br>
                <input name="departure_date_start" type="date" value="{{$offer->departure_date_start}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Departure Date (End)</label><br>
                <input name="departure_date_end" type="date" value="{{$offer->departure_date_end}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <div style="width: 100%">
                    <div style="width: 49%; float: left">
                        <label>Booking Date (Start)</label><br>
                        <input name="booking_date_start" type="date" value="{{$offer->booking_date_start}}" required class="form-control">

                    </div>
                    <div style="width: 49%; float: left; margin-left:2%">
                        <label>Booking Date (End)</label><br>
                        <input name="booking_date_end" type="date" value="{{$offer->booking_date_end}}" required class="form-control">

                    </div>
                </div>

            </div>

            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <label>Sorting Number</label><br>
                <input name="sort_number" type="number" value="{{$offer->sort_number}}" required class="form-control">
            </div>

        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Markup Type</label><br>
                <select class="form-control" name="type">
                    @foreach(['Percentage (%)','Amount($)'] as $c)
                        <option value="{{$c}}" {{$offer->type==$c?'selected':''}} >{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <label>Markup Percentage</label><br>
                <input name="markup_percentage" type="number"  value="{{$offer->markup_percentage}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Markup Amount</label><br>
                <input name="markup_amount" type="number" value="{{$offer->markup_amount}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Agent Commission</label><br>
                <select class="form-control" name="agent_commission">
                    @foreach(['Percentage (%)','Amount($)','None'] as $c)
                        <option value="{{$c}}" {{$offer->agent_commission==$c?'selected':''}} >{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <label>Commission Percentage</label><br>
                <input name="commission_percentage" type="number" value="{{$offer->commission_percentage}}" required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Commission Amount</label><br>
                <input name="commission_amount" type="number" value="{{$offer->commission_amount}}" required class="form-control">
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-6">
                <label>Tag</label><br>
                <select class="form-control js-select-basic-single" name="tag[]" multiple>
                    @foreach(\App\Helpers\Helper::tags() as $c)
                        <option value="{{$c->id}}"
                        @foreach($offer->tag as $item)
                            @if($item==$c->id)
                                {{'selected'}}
                                @endif

                            @endforeach
                        >{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 text-left">
                <label>Status</label><br>
                <select class="form-control" name="status" required>
                    <option value="1" {{$offer->status=='1'?'selected':''}}>active</option>
                    <option value="0" {{$offer->status=='0'?'selected':''}}>unactive</option>
                </select>
            </div>
        </div><br>




    </div>

</form>

<script>
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
