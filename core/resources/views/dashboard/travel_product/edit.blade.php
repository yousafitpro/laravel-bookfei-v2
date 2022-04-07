
<form method="post" id="tourUpdateForm" action="{{route('admin.travel_product.update',$travelProduct->id)}}" enctype="multipart/form-data">
    @csrf

    <input id="redirectUrl" name="redirectUrl" hidden value=""  class="form-control">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <label>Travel Product Name</label><br>
                <input name="name"  value="{{$travelProduct->name}}" required class="form-control">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <label>Reference Code</label><br>
                <input name="code" value="{{$travelProduct->code}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Travel Product Type</label><br>
                <select class="form-control" name="type">

                    @foreach(['Multi Offers','Single Offer'] as $c)
                        <option value="{{$c}}"
                           {{$c==$travelProduct->type?'selected':''}}
                        >{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <label>Effective Date (Start)</label><br>
                <input name="effective_date_start" value="{{$travelProduct->effective_date_start}}" type="date"  required class="form-control">
            </div>
            <div class="col-md-3">
                <label>Effective Date (End)</label><br>
                <input name="effective_date_end" value="{{$travelProduct->effective_date_end}}" type="date" value="{{old('effective_date_end')}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <label>Destination


                </label><br>
                <select class="form-control js-select-basic-single" name="destination[]" multiple>
                    @foreach(\App\Helpers\Helper::Destinations() as $c)
                        <option value="{{$c->id}}"

                                @foreach($travelProduct->destination as $item)
                                @if($item==$c->id)
                                    {{'selected'}}
                                    @endif

                       @endforeach
                        >{{$c->name}} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <label>Sorting Type</label><br>
                <select class="form-control" name="sort_type">
                    @foreach(['Top','Default'] as $c)
                        <option value="{{$c}}"
                          {{$c==$travelProduct->sort_type?'selected':''}}
                        >{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Sorting Number</label><br>
                <input name="sort_number"  value="{{$travelProduct->sort_number}}" required class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label>Category</label><br>
                <select class="form-control js-select-basic-single" multiple name="category[]" >
                    @foreach(\App\Helpers\Helper::Categories() as $c)
                        <option value="{{$c->id}}"

                        @foreach($travelProduct->category as $item)
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
                    <option value="1" {{$travelProduct->status=='1'?'selected':''}}>active</option>
                    <option value="0" {{$travelProduct->status=='0'?'selected':''}}>unactive</option>
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
