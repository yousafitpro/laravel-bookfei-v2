@extends('dashboard.layouts.master')
@section('title', "Add Currency")
@section('content')

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <button onclick="addCategory('{{url("admin/category/list")}}')"
                            class="btn dark p-x-md pull-right m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close</button>
                    <button onclick="addCategory('')"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
                    <small>
                        <a href="{{route('admin.category.list')}}">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Go Back
                        </a>
                    </small>
                    <br>


                </div>
                <form method="post" id="AddCForm" action="{{route('admin.category.create')}}" enctype="multipart/form-data">
                    @csrf
                    <input hidden id="redirectUrl" name="redirectUrl">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label><br>
                            <input name="name" required class="form-control"><br>
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
                </div>
                </form>
            </div>
        </div>

    <script>

        function addCategory(url)
        {


            $("#redirectUrl").val(url)
            document.getElementById('AddCForm').submit()
        }
    </script>
@endsection
