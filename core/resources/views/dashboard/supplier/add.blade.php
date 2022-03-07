@extends('dashboard.layouts.master')
@section('title', "Add Room Type")
@section('content')
    <form method="post" action="{{route('admin.supplier.create')}}" enctype="multipart/form-data">
        @csrf

        <div class="padding">
            <div class="card ">
                <div class="box-header">
                    <button type="submit"
                            class="btn dark p-x-md pull-right">{{ __('backend.save') }}</button>
                    <small>
                        <a href="{{route('admin.supplier.list')}}">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Go Back
                        </a>
                    </small>
                    <br>


                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label><br>
                            <input name="name" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Type</label><br>
                            <input name="type" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Supplier Code</label><br>
                            <input name="supplier_code" required class="form-control">
                        </div>
                    </div>
<br>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Contact Name</label><br>
                            <input name="contact_name" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Email</label><br>
                            <input name="email" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Phone</label><br>
                            <input name="phone" required class="form-control">
                        </div>
                    </div>



                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1">active</option>
                                <option value="0">unactive</option>
                            </select>
                        </div>

                    </div>
                    <br>
                </div>
            </div>
        </div>
    </form>
@endsection
