
@foreach($list as $item)
<div class="myfileUploaderImageBox box">

<div style="position: absolute">
    <img style="max-height: 60px"  src="{{$item->image}}">
</div >
    <div onclick="removeImage('{{$item->id}}')" class="btn " style="position: absolute; color: red; margin-right: -15px; margin-top: -15px; right: 0">X</div>
</div>
@endforeach
<script>
    function  updateImages()
    {

        $.ajax({
            type:'get',
            url:'{{route('myfileUploader.getCardImages')}}',
            data:{'_token':'{{ csrf_token() }}','item_id':'{{$item_id}}','type':'{{$type}}'},
            success:function(data){
                $("#mainFileUploadContainer").empty();
                $("#mainFileUploadContainer").append(data)
            }})
    }
    function removeImage(id)
    {
        $.ajax({
            type:'get',
            url:'{{route('myfileUploader.removeFile')}}',
            data:{'_token':'{{ csrf_token() }}','id':id},
            success:function(data){
                updateImages()
            }})
    }
</script>
