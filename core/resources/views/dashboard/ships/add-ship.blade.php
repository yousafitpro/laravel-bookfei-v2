<form method="post" id="addHotel" action="{{route('admin.cruiseShip.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <label>Cruise Ship Name</label><br>
                <input name="name"  required class="form-control">
            </div>
            <div class="col-md-6">
                <label>English Name</label><br>
                <input name="english_name"  class="form-control">
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label>Cruise Line</label><br>
                <select class="form-control" name="cruise_line_id" style="background-color: grey; color: white">
                    @foreach(\App\Helpers\Helper::Cruises() as $c)
                        <option value="{{$c->id}}"  >{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <br>
        <div class="row">


            <div class="col-md-6">
                <label>Contact tel</label><br>
                <input name="phone"     class="form-control">
            </div>
            <div class="col-md-6">
                <label>Email</label><br>
                <input name="email"   type="email" class="form-control">
            </div>
        </div>


        <br>
        {{--        <label>No Extra Bed Age Group</label>--}}

        <div class="row p-l-1">
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
                            <select name="adult_age_start" class="form-control">

                                <?php
                                $i=0
                                ?>
                                @while($i!=101)
                                    <option value="{{$i}}" >{{$i}}</option>
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
                                    <option value="{{$i}}" >{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                             </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_adult"    type="checkbox" style="zoom:1.6">
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
                                    <option value="{{$i}}" >{{$i}}</option>
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
                                    <option value="{{$i}}" >{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                             </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_child"    type="checkbox" style="zoom:1.6">
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
                                    <option value="{{$i}}" >{{$i}}</option>
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
                                    <option value="{{$i}}" >{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                             </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_toddler"   type="checkbox" style="zoom:1.6">
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
                                    <option value="{{$i}}" >{{$i}}</option>
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
                                    <option value="{{$i}}" >{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                             </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input name="is_infant"    type="checkbox" style="zoom:1.6">
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
                                    <option value="{{$i}}" >{{$i}}</option>
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
                                    <option value="{{$i}}" >{{$i}}</option>
                                    <?php
                                    $i=$i+1;
                                    ?>
                                @endwhile
                            </select>                                             </div>
                        <div class="col-md-3 myflex" style="padding: 10px" >

                            <input id="12w"  name="is_senior" class="mytoggle"  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>

                    <br>

                </div>


            </div>
            <div class="col-md-3">
                <label>Status</label><br>
                <select  class="form-control" name="status" required>

                    <option value="1">active</option>
                    <option value="0">unactive</option>
                </select>
            </div>



        </div>


    </div>
</form>
