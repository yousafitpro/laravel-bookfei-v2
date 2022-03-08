<form method="post" id="editHotel" action="{{route('admin.hotel.update',$hotel->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <label>Hotel Name</label><br>
                <input name="name" value="{{$hotel->name}}" required class="form-control">
            </div>
            <div class="col-md-4">
                <label>English Name</label><br>
                <input name="english_name" value="{{$hotel->english_name}}" class="form-control">
            </div>
            <div class="col-md-4">
                <label>City</label><br>
                <select class="form-control" name="city_id">
                    <option value="{{\App\Helpers\Helper::get_City($hotel->city_id)->id}}" >{{\App\Helpers\Helper::get_City($hotel->city_id)->name}}</option>
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
                <input name="address" value="{{$hotel->address}}"  class="form-control">
            </div>
            <div class="col-md-4">
                <label>Contact tel</label><br>
                <input name="phone" value="{{$hotel->phone}}"    class="form-control">
            </div>
            <div class="col-md-4">
                <label>Email</label><br>
                <input name="email" value="{{$hotel->email}}"  type="email" class="form-control">
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
                            <select name="adult_age_start" value="{{$hotel->adult_age_start}}" class="form-control">
                                <option value="{{$hotel->adult_age_start}}">{{$hotel->adult_age_start}}</option>
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
                                <option value="{{$hotel->adult_age_end}}">{{$hotel->adult_age_end}}</option>

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

                            <input name="is_adult" {{$hotel->is_adult=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Child">

                        </div>
                        <div class="col-md-3">
                            <select name="child_age_start" value="{{old('child_age_start')}}" class="form-control">
                                <option value="{{$hotel->child_age_start}}">{{$hotel->child_age_start}}</option>

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
                                <option value="{{$hotel->child_age_end}}">{{$hotel->child_age_end}}</option>

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

                            <input name="is_child" {{$hotel->is_child=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Toddler">

                        </div>
                        <div class="col-md-3">
                            <select name="toddler_age_start" value="{{old('toddler_age_start')}}" class="form-control">
                                <option value="{{$hotel->toddler_age_start}}">{{$hotel->toddler_age_start}}</option>

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
                                <option value="{{$hotel->toddler_age_end}}">{{$hotel->toddler_age_end}}</option>

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

                            <input name="is_toddler" {{$hotel->is_toddler=="1"?'checked':""}}  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control"  readonly value="Infant">

                        </div>
                        <div class="col-md-3">
                            <select name="infant_age_start" value="{{old('infant_age_start')}}" class="form-control">
                                <option value="{{$hotel->infant_age_start}}">{{$hotel->infant_age_start}}</option>

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
                                <option value="{{$hotel->infant_age_end}}">{{$hotel->infant_age_end}}</option>

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

                            <input name="is_infant" {{$hotel->is_infant=="1"?'checked':""}}   type="checkbox" style="zoom:1.6">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-3">
                            <input class="form-control" readonly value="Senior">

                        </div>
                        <div class="col-md-3">
                            <select name="senior_age_start" value="{{old('senior_age_start')}}" class="form-control">
                                <option value="{{$hotel->senior_age_start}}">{{$hotel->senior_age_start}}</option>

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
                                <option value="{{$hotel->senior_age_end}}">{{$hotel->senior_age_end}}</option>

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

                            <input id="12w"  name="is_senior" {{$hotel->is_senior=="1"?'checked':""}}  class="mytoggle"  type="checkbox" style="zoom:1.6">
                        </div>
                    </div>

                    <br>

                </div>


            </div>
            <div class="col-md-3">
                <label>Status</label><br>
                <select value="{{$hotel->status}}" class="form-control" name="status" required>

                    <option value="1">active</option>
                    <option value="0">unactive</option>
                </select>
            </div>



        </div>


    </div>
</form>
