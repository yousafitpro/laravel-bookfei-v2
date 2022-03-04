<form method="post" action="{{route('admin.hotel.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label>Hotel Name</label><br>
                <input name="name" value="{{old('name')}}" required class="form-control">
            </div>
            <div class="col-md-4">
                <label>English Name</label><br>
                <input name="english_name" value="{{old('english_name')}}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>City</label><br>
                <select class="form-control" name="city_id">
                    @foreach(\App\Helpers\Helper::Cities() as $c)
                        <option value="{{$c->id}}" >{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <br>
        <div class="row">

            <div class="col-md-4">
                <label>Address</label><br>
                <input name="address" value="{{old('code')}}"  class="form-control">
            </div>
            <div class="col-md-4">
                <label>Contact tel</label><br>
                <input name="phone"    class="form-control">
            </div>
            <div class="col-md-4">
                <label>Email</label><br>
                <input name="email"   type="email" class="form-control">
            </div>
        </div><br>





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
                            <select id="adult_age_start" name="adult_age_start" onchange="inputChange('adult_age_start')" value="{{old('adult_age_start')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
                                    <option value="{{$i}}">{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                          </div>
                        <div class="col-md-3">
                            <select id="adult_age_end" name="adult_age_end" onchange="inputChange('adult_age_end')" class="form-control" value="{{old('adult_age_end')}}">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
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
                            <select id="child_age_start" onchange="inputChange('child_age_start')" name="child_age_start" value="{{old('child_age_start')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
                                    <option value="{{$i}}">{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                          </div>
                        <div class="col-md-3">
                            <select id="child_age_end" onchange="inputChange('child_age_end')" name="child_age_end" value="{{old('child_age_end')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
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
                            <select id="toddler_age_start" onchange="inputChange('toddler_age_start')" name="toddler_age_start" value="{{old('toddler_age_start')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
                                    <option value="{{$i}}">{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                          </div>
                        <div class="col-md-3">
                            <select id="toddler_age_end" onchange="inputChange('toddler_age_end')" name="toddler_age_end" value="{{old('toddler_age_end')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
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
                            <select onchange="inputChange('infant_age_start')" id="infant_age_start" name="infant_age_start" value="{{old('infant_age_start')}}" class="form-control">
                                <?php
                                $i=0;
                                ?>
                                @while($i!=100)
                                    <option value="{{$i}}">{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                          </div>
                        <div class="col-md-3">
                            <select id="infant_age_end" onchange="inputChange('infant_age_end')" name="infant_age_end" value="{{old('infant_age_end')}}" class="form-control">
                                <?php
                                $i=0;
                                ?>
                                @while($i!=100)
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
                            <select id="senior_age_start" onchange="inputChange('senior_age_start')" name="senior_age_start" value="{{old('senior_age_start')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
                                    <option value="{{$i}}">{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                          </div>
                        <div class="col-md-3">
                            <select id="senior_age_end" name="senior_age_end" onchange="inputChange('senior_age_end')" value="{{old('senior_age_end')}}" class="form-control">
                                <?php
                                $i=0
                                ?>
                                @while($i!=100)
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

        <button type="submit"
                class="btn success p-x-md pull-right">Save & Next</button>


    </div>
</form>

