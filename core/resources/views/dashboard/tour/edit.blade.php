<form method="post" id="tourUpdateForm" action="{{route('admin.tour.update',$tour->id)}}" enctype="multipart/form-data">
    @csrf

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label>Tour Name</label><br>
                        <input name="name" value="{{$tour->name}}" required class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Tour Code</label><br>
                        <input name="code" value="{{$tour->code}}" required class="form-control">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Currency</label><br>
                        <select class="form-control" name="currency_id">
                            <option value="{{\App\Helpers\Helper::get_Currency($tour->currency_id)->id}}" >{{\App\Helpers\Helper::get_Currency($tour->currency_id)->name}}</option>
                            @foreach(\App\Helpers\Helper::Currencies() as $c)
                                <option value="{{$c->id}}" >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Supplier</label><br>
                        <select class="form-control" name="supplier_id">
                            <option value="{{\App\Helpers\Helper::get_Supplier($tour->supplier_id)->id}}" >{{\App\Helpers\Helper::get_Supplier($tour->supplier_id)->name}}</option>
                            @foreach(\App\Helpers\Helper::Suppliers() as $c)
                                <option value="{{$c->id}}" >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Effective Date (start)</label><br>
                        <input name="effective_start_date" type="date" value="{{$tour->effective_start_date}}" required class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Effective Date (start)</label><br>
                        <input name="effective_end_date" value="{{$tour->effective_end_date}}" required type="date" class="form-control">
                    </div>
                </div>
                <br>
                <small>Special Offer Type</small><br>
                <br>
                <div class="row">
                    <div class="col-md-4">

                       <span onclick="early_bird()">
                            <input {{$tour->early_bird=="1"?'checked':""}} id="early_bird" name="early_bird" type="checkbox" style="zoom:1"   >

                       </span>
                        <label>Early Bird</label>
                    </div>
                    <div class="col-md-4">
                        <label>Early Bird Before Chek in Date</label><br>
                        <input {{$tour->early_bird=="0"?'disabled':""}} id="early_bird_before_departure_date" name="early_bird_before_departure_date" value="{{$tour->early_bird_before_departure_date}}" required type="number" class="form-control">
                    </div>
                    <div class="col-md-4">

                        <label>Status</label><br>
                        <select class="form-control" name="status" required>
                            @if($tour->status=="1")
                                <option value="1">active</option>
                            @else
                                <option value="0">unactive</option>
                            @endif
                            <option value="1">active</option>
                            <option value="0">unactive</option>
                        </select>

                    </div>

                </div>


                <br>

                <div class="row">
                    <div class="col-md-9 box box-body ">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Age Group">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Age From">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Age To">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Status">
                                </div>
                            </div>

                            <div class="row " style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Adult">

                                </div>
                                <div class="col-md-3">
                                    <select name="adult_age_start" value="{{$tour->adult_age_start}}" class="form-control">
                                        <option value="{{$tour->adult_age_start}}">{{$tour->adult_age_start}}</option>
                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                          </div>
                                <div class="col-md-3">
                                    <select name="adult_age_end" class="form-control" value="{{old('adult_age_end')}}">
                                        <option value="{{$tour->adult_age_end}}">{{$tour->adult_age_end}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                             </div>
                                <div class="col-md-3 myflex" style="padding: 10px" >

                                    <input name="is_adult" {{$tour->is_adult=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Child">

                                </div>
                                <div class="col-md-3">
                                    <select name="child_age_start" value="{{old('child_age_start')}}" class="form-control">
                                        <option value="{{$tour->child_age_start}}">{{$tour->child_age_start}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                          </div>
                                <div class="col-md-3">
                                    <select name="child_age_end" value="{{old('child_age_end')}}" class="form-control">
                                        <option value="{{$tour->child_age_end}}">{{$tour->child_age_end}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                             </div>
                                <div class="col-md-3 myflex" style="padding: 10px" >

                                    <input name="is_child" {{$tour->is_child=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Toddler">

                                </div>
                                <div class="col-md-3">
                                    <select name="toddler_age_start" value="{{old('toddler_age_start')}}" class="form-control">
                                        <option value="{{$tour->toddler_age_start}}">{{$tour->toddler_age_start}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                          </div>
                                <div class="col-md-3">
                                    <select name="toddler_age_end" value="{{old('toddler_age_end')}}" class="form-control">
                                        <option value="{{$tour->toddler_age_end}}">{{$tour->toddler_age_end}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                             </div>
                                <div class="col-md-3 myflex" style="padding: 10px" >

                                    <input name="is_toddler" {{$tour->is_toddler=="1"?'checked':""}}  type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control"  readonly value="Infant">

                                </div>
                                <div class="col-md-3">
                                    <select name="infant_age_start" value="{{old('infant_age_start')}}" class="form-control">
                                        <option value="{{$tour->infant_age_start}}">{{$tour->infant_age_start}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                          </div>
                                <div class="col-md-3">
                                    <select name="infant_age_end" value="{{old('infant_age_end')}}" class="form-control">
                                        <option value="{{$tour->infant_age_end}}">{{$tour->infant_age_end}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                             </div>
                                <div class="col-md-3 myflex" style="padding: 10px" >

                                    <input name="is_infant" {{$tour->is_infant=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Senior">

                                </div>
                                <div class="col-md-3">
                                    <select name="senior_age_start" value="{{old('senior_age_start')}}" class="form-control">
                                        <option value="{{$tour->senior_age_start}}">{{$tour->senior_age_start}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                          </div>
                                <div class="col-md-3">
                                    <select name="senior_age_end" value="{{old('senior_age_end')}}" class="form-control">
                                        <option value="{{$tour->senior_age_end}}">{{$tour->senior_age_end}}</option>

                                        <?php
                                        $i=0
                                        ?>
                                        @while($i!=101)
                                            <option value="{{$i}}">{{$i}}</option>
                                            <?php
                                            $i=$i+1;
                                            ?>
                                        @endwhile
                                    </select>                                             </div>
                                <div class="col-md-3 myflex" style="padding: 10px" >

                                    <input id="12w"  name="is_senior" {{$tour->is_senior=="1"?'checked':""}}  class="mytoggle"  type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <br>

                        </div>


                    </div>



                </div>



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
