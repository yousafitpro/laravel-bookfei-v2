@extends('dashboard.layouts.master')
@section('title', "Update Country")
@section('content')


        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <small>
                        <a href="{{route('admin.country.list')}}">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Go Back
                        </a>
                    </small>
                    <br>
                    <button onclick="edit('{{url("admin/country/list")}}')"
                            class="btn dark p-x-md pull-right m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close</button>

                    <button onclick="edit('')"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>


                    <br>


                </div>
                <br>
                <form method="post" id="EditForm" action="{{route('admin.country.update',$Banner->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input id="redirectUrl" hidden name="redirectUrl">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6 text-left">
                            <label>Name</label><br>
                            <input name="name" value="{{$Banner->name}}" required class="form-control"><br>

                        </div>
                        <div class="col-md-6 ">
                            <label>English Name</label><br>
                            <input name="english_name" value="{{$Banner->english_name}}" required class="form-control"><br>

                        </div>

                    </div>



                    <br>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Image</label><br>
                            <input name="file" type="file"  class="form-control"><br>

                        </div>
                        <div class="col-md-6">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1" {{$Banner->status=='1'?'selected':''}} >active</option>
                                <option value="0" {{$Banner->status=='0'?'selected':''}}>unactive</option>
                            </select>
                        </div>
                    </div>
                    <br>

                </div>
    </form>
            </div>
        </div>

    <script>
        function edit(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('EditForm').submit()
        }
    </script>
@endsection
