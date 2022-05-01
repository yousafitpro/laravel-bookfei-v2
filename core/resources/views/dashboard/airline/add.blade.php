@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
f

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <small>
                        <a href="{{route('admin.category.list')}}">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Go Back
                        </a>
                    </small>
                    <br>
                    <button onclick="addAirline('{{url("admin/airline/list")}}')"
                            class="btn dark p-x-md pull-right m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close</button>

                    <button onclick="addAirline('')"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>


                    <br>


                </div>
                <br>
                <form method="post" id="AddAirline" action="{{route('admin.airline.create')}}" enctype="multipart/form-data">
                    @csrf
                    <input hidden id="redirectUrl" name="redirectUrl">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label><br>
                            <input name="name" required class="form-control"><br>
                        </div>
                        <div class="col-md-6">
                            <label>English Name</label><br>
                            <input name="english_name" required class="form-control"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3 text-right">

                        </div>

                        <div class="col-md-2">
                        </div>
                    </div>


                    <br>
                    <div class="row">

                        <div class="col-md-6 text-left">
                            <label>Image</label><br>
                            <input name="file" type="file" required class="form-control"><br>
                        </div>

                        <div class="col-md-6 text-left">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1">active</option>
                                <option value="0">unactive</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6">

                        </div>

                    </div>
                    <br>
                </div>
                </form>
            </div>
        </div>

    <script>
        function addAirline(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('AddAirline').submit()
        }
    </script>
@endsection
