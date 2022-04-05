
    <form method="post" id="tourAddForm" action="{{route('admin.travel_product.create')}}" enctype="multipart/form-data">
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
                        <select class="form-control" name="type">
                            @foreach(['Hotel','Multi Hotel','Cruise'] as $c)
                                <option value="{{$c}}" >{{$c}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Minimum Guest</label><br>
                        <input name="min_guest" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Effective Date (End)</label><br>
                        <input name="max_guest" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <div style="width: 100%">
                            <div style="width: 49%; float: left">
                                <label>Effective Date (Start)</label><br>
                                <input name="effective_date_start" value="{{old('effective_date_start')}}" required class="form-control">

                            </div>
                            <div style="width: 49%; float: left; margin-left:2%">
                                <label>Effective Date (End)</label><br>
                                <input name="effective_date_end" value="{{old('effective_date_end')}}" required class="form-control">

                            </div>
                        </div>

                    </div>

                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Departure Date (Start)</label><br>
                        <input name="departure_date_start" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Departure Date (End)</label><br>
                        <input name="departure_date_end" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <div style="width: 100%">
                            <div style="width: 49%; float: left">
                                <label>Booking Date (Start)</label><br>
                                <input name="booking_date_start" value="{{old('effective_date_start')}}" required class="form-control">

                            </div>
                            <div style="width: 49%; float: left; margin-left:2%">
                                <label>Booking Date (End)</label><br>
                                <input name="booking_date_end" value="{{old('effective_date_end')}}" required class="form-control">

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
                        <select class="form-control" name="type">
                            @foreach(['Percentage (%)','Amount($)'] as $c)
                                <option value="{{$c}}" >{{$c}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Markup Percentage</label><br>
                        <input name="markup_percentage" type="number" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Markup Amount</label><br>
                        <input name="markup_amount" type="number" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label>Agent Commission</label><br>
                        <select class="form-control" name="type">
                            @foreach(['Percentage (%)','Amount($)','None'] as $c)
                                <option value="{{$c}}" >{{$c}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-3">
                        <label>Commission Percentage</label><br>
                        <input name="markup_percentage" type="number" value="{{old('effective_date_start')}}" required class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Commission Amount</label><br>
                        <input name="markup_amount" type="number" value="{{old('effective_date_end')}}" required class="form-control">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <label>Tag</label><br>
                        <select class="form-control" name="currency_id">
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
