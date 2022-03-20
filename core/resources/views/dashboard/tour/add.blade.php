
    <form method="post" id="tourAddForm" action="{{route('admin.tour.create')}}" enctype="multipart/form-data">
        @csrf


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label>Tour Name</label><br>
                        <input name="name" value="{{old('name')}}" required class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Tour Code</label><br>
                        <input name="code" value="{{old('code')}}" required class="form-control">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Currency</label><br>
                        <select class="form-control" name="currency_id">
                            @foreach(\App\Helpers\Helper::Currencies() as $c)
                                <option value="{{$c->id}}" >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Supplier</label><br>
                        <select class="form-control" name="supplier_id">
                            @foreach(\App\Helpers\Helper::Suppliers() as $c)
                                <option value="{{$c->id}}" >{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Effective Date (start)</label><br>
                        <input name="effective_start_date" type="date" value="{{old('effective_start_date')}}" required class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Effective Date (start)</label><br>
                        <input name="effective_end_date" value="{{old('effective_end_date')}}" required type="date" class="form-control">
                    </div>
                </div>
                <br>
                <small>Special Offer Type</small><br>
                <br>
                <div class="row">
                    <div class="col-md-4">
 <span onclick="early_bird()">
                        <input id="early_bird" name="early_bird" type="checkbox" style="zoom:1"   >
 </span>
                        <label>Early Bird</label>
                    </div>
                    <div class="col-md-4">
                        <label>Early Bird Before Chek in Date</label><br>
                        <input name="early_bird_before_departure_date" value="{{old('early_bird_before_departure_date')}}" required type="number" class="form-control">
                    </div>
                    <div class="col-md-4">

                        <label>Status</label><br>
                        <select class="form-control" name="status" required>
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
                                    <select name="adult_age_start" value="{{old('adult_age_start')}}" class="form-control">
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

                                    <input name="is_adult"  checked  type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Child">

                                </div>
                                <div class="col-md-3">
                                    <select name="child_age_start" value="{{old('child_age_start')}}" class="form-control">
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

                                    <input name="is_child" checked   type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Toddler">

                                </div>
                                <div class="col-md-3">
                                    <select name="toddler_age_start" value="{{old('toddler_age_start')}}" class="form-control">
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

                                    <input name="is_toddler" checked  type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control"  readonly value="Infant">

                                </div>
                                <div class="col-md-3">
                                    <select name="infant_age_start" value="{{old('infant_age_start')}}" class="form-control">
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

                                    <input name="is_infant" checked  type="checkbox" style="zoom:1.6">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-md-3">
                                    <input class="form-control" readonly value="Senior">

                                </div>
                                <div class="col-md-3">
                                    <select name="senior_age_start" value="{{old('senior_age_start')}}" class="form-control">
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

                                    <input id="12w"  name="is_senior" checked class="mytoggle"  type="checkbox" style="zoom:1.6">
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
