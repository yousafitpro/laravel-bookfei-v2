@extends('dashboard.layouts.master')
@section('title', $title)
@section('content')

<div class="box box-body" style="min-height: 80vh">
    <form action="{{route('admin.config.update')}}" method="post">

   @csrf
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div >
                    <label>Default Markup Type</label><br>
                    <select>
                        <option value="{{$config->default_markup_type}}">{{$config->default_markup_type}}</option>
                        <option value="Percentage">Percentage</option>
                        <option value="Amount">Amount</option>
                        <option value="Percentage + Amount">Percentage + Amount</option>
                    </select>
                    <br>
                </div>

                <div >
                    <br>
                    <label>Default Markup Percentage</label><br>
                    <input class="form-control" value="{{$config->default_markup_percentage}}" max="100" type="number" name="default_markup_percentage" required>
                <br>
                </div>
                <div >

                    <label>Default Markup Amount</label><br>
                    <input class="form-control" value="{{$config->default_markup_amount}}" type="number" name="default_markup_amount" required>
                    <br>
                </div>
                <div >

                    <label>Levy</label><br>
                    <input class="form-control" type="number" value="{{$config->levy}}" name="levy" required>
                    <br>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success pull-right">Save Changes</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
