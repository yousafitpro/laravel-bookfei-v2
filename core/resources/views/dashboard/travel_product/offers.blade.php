
<div class="container-fluid">
<div class="row">
    <div class="col-md-6">
        <a href="" data-target="#addMe" data-toggle="modal" class="btn dark pull-left" style="min-width: var(--mBtnDefaultWidth)">Add</a>
    </div>
    <div class="col-md-6">
        <a href="javascript:void" onclick="OffersBulkDelete()" id="btnOffersDell" class="btn btn-danger pull-right" style="min-width: var(--mBtnDefaultWidth)">Remove</a>

    </div>
</div>
    <br>
    <div class="row" >
        <div class="col-md-1">

        </div>
        <div class="col-md-2">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Offer Name">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px"  value="Code">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Offer Type">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Category">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Markup %">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Markup $">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Status">
        </div>
        <div class="col-md-1">
            <input readonly class="form-control bg-dark" style="font-size: 10px" value="Action">
        </div>
    </div>
@foreach($offers as $o)
    <?php
    $offer=\App\Models\offer::find($o->offer_id)
    ?>
    <br>
        <div class="row" >
            <div class="col-md-1">
         <input type="checkbox" id="otCheckBox" data-id="{{$o->id}}"  style="zoom: 1.5">
            </div>
            <div class="col-md-2">
                <input readonly class="form-control bg-dark" style="font-size: 10px" value="{{$offer->name}}">
            </div>
            <div class="col-md-1">
                <input readonly class="form-control bg-dark" style="font-size: 10px"  value="{{$offer->code}}">
            </div>
            <div class="col-md-1">
                <input readonly class="form-control bg-dark" style="font-size: 10px" value="{{$offer->type}}">
            </div>
            <div class="col-md-1">
                <input readonly class="form-control bg-dark" style="font-size: 10px" value="Category">
            </div>
            <div class="col-md-1">
                <input readonly class="form-control bg-dark" style="font-size: 10px" value="{{$offer->markup_percentage}}">
            </div>
            <div class="col-md-1">
                <input readonly class="form-control bg-dark" style="font-size: 10px" value="{{$offer->markup_amount}}">
            </div>
            <div class="col-md-1">
                <input readonly class="form-control bg-dark" style="font-size: 10px" value="{{$offer->status=='1'?'Active':'Unactive'}}">
            </div>
            <div class="col-md-1">
                <a class="btn dark" style="color: white">Edit</a>
            </div>
        </div>
    @endforeach


</div>
<div class="modal fade" id="addMe" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Offers</h5>
                <button type="button" onclick="reloadOfferPage()" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    @csrf
                    <div class="container-fluid">
                        <div class="table-responsive">

                            <table class="table table-bordered m-a-0">
                                <thead class="dker">
                                <tr>


                                    <th class="text-center width50">{{ __('backend.name') }}</th>

                                    <th class="text-center width50">{{ __('backend.code') }}</th>
                                    <th class="text-center width200">{{ __('backend.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $title_var = "title_" . @Helper::currentLanguage()->code;
                                $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                ?>
                                @foreach($oldoffers as $Banner)

                                    <tr>


                                        <td class="text-center">
                                            <label>{{$Banner->name}}</label>
                                        </td>
                                        <td class="text-center">
                                            <label>{{$Banner->code}}</label>
                                        </td>

                                        <td class="text-center">

                                                <a href="javascript:void" onclick="addOffer('{{$Banner->id}}')">

                                                    <button class="btn btn-sm success"  id="btnAdd{{$Banner->id}}">
                                                        <small><i class="fa fa-plus" aria-hidden="true"></i> Add
                                                        </small>
                                                    </button>
                                                </a>




                                        </td>
                                    </tr>


                                @endforeach
                                <!-- .modal -->

                                <!-- / .modal -->
                                </tbody>
                            </table>

                        </div>

                        <hr>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button onclick="reloadOfferPage()" type="button" class="btn btn-secondary"
                            data-dismiss="modal"> Cancel
                    </button>
                    <button onclick="reloadOfferPage()" data-dismiss="modal"  type="submit" form="service-suggestion"
                            class="btn btn-primary"> Ok
                    </button>
                </div>

        </div>
    </div>
</div>

<br>
<br>
<hr>

<script>
    function OffersBulkDelete() {
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
            $("#btnOffersDell").text("Removing...")
            $.ajax({
                type:'post',
                url:'{{route('admin.travel_product.deleteOffers')}}',
                data:{"_token":"{{ csrf_token() }}",'data':tempArray},
                success:function(data){
                    console.log(data)
                    window.location.reload()
                }})
        }
    }

    function addOffer(id)
    {
        $("#btnAdd"+id).text("Adding...")
        $.ajax({
            type:'get',
            url:'{{route('admin.travel_product.addOffer')}}',
            data:{"_token":"{{ csrf_token() }}",'travel_product_id':'{{$travelProduct->id}}','offer_id':id},
            success:function(data){

                if (data.code=='1')
                {
                    $("#btnAdd"+id).text("Added")
                    return;
                }

                    alert(data.message)
                    $("#btnAdd"+id).text("Add")



            }})
    }
    function reloadOfferPage()
    {
        window.location.reload()
    }
</script>
