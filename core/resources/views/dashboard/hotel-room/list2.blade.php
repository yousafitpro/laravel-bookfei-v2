
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0" >
                        <thead class="dker">
                        <tr>


                            <th class=" width50">{{ __('backend.name') }}</th>
                            <th class="text-center width50">{{ __('backend.default_guest') }}</th>
                            <th class="text-center width50">{{ __('backend.max_guest') }}</th>
{{--                            <th class="text-center width50">{{ __('backend.status') }}</th>--}}
                            <th class="text-center width200">{{ __('backend.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $title_var = "title_" . @Helper::currentLanguage()->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                        ?>
                        @foreach($roomTypes as $Banner)

                           @if($Banner->roomType->status=='1' || $Banner->roomType->deleted_at==null)

                          <tr>


                              <td class="">
                                  <label>{{$Banner->roomType->name}}</label>
                              </td>
                              <td class="text-center">
                                  {{$Banner->roomType->default_guest}}                                </td>
                              <td class="text-center">
                                  {{$Banner->roomType->max_guest}}                                </td>

{{--                              <td class="text-center">--}}
{{--                                  <i class="fa {{ ($Banner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>--}}
{{--                              </td>--}}
                              <td class="text-center">


                                          <a class="btn btn-sm success" href="{{route('admin.hotelRoom.rateTable',$Banner->id)}}">
                                              <i class="fa fa-edit" aria-hidden="true"></i>Edit
                                              </small>
                                          </a>






                              </td>
                          </tr>
                          @endif
                        @endforeach
                        <!-- .modal -->

                        <!-- / .modal -->
                        </tbody>
                    </table>

                </div>
<br>

<br>
<br>
<br>





