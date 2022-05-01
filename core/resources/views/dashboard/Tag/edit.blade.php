@extends('dashboard.layouts.master')
@section('title', "Update Currency")
@section('content')


        <div class="padding">
            <div class="card ">
                <br>
                <a href="{{route('admin.tag.list')}}" style="padding: 20px">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Go Back
                </a>
                <div class="box-header">
                    <button onclick="Tag('editTag','{{url('admin/tag/list')}}')"
                            class="btn dark p-x-md pull-right m-l-1" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }} & Close</button>

                    <button onclick="Tag('editTag','')"
                            class="btn dark p-x-md pull-right" style="min-width: var(--mBtnDefaultWidth)">{{ __('backend.save') }}</button>
                    <small>

                    </small>
                    <br>


                </div>
                <form method="post" id="editTag" action="{{route('admin.tag.update',$Banner->id)}}" enctype="multipart/form-data">
                    @csrf
                    <input hidden id="redirectUrl" name="redirectUrl">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label><br>
                            <input name="name" value="{{$Banner->name}}" required class="form-control"><br>
                        </div>
                        <div class="col-md-6 text-left">
                            <label>Status</label><br>
                            <select class="form-control" name="status" required>
                                <option value="1" {{$Banner->status=='1'?'selected':''}}>active</option>
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
        function Tag(form,url)
        {


            $("#redirectUrl").val(url)
            document.getElementById(form).submit()
        }
    </script>
@endsection
