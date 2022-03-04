<div class="card">
    <div class="box-body">
  <div class="container-fluid">

          <div class="row">
              <div class="col-md-12 " >
                  <div class="myfileUploaderImageBox box" style="width: 110px; ">
                      <label for="myImage" id="uploadBtn"  class="btn btn-primary" style="height: 100%; padding: 20px;  width:100%; font-size: 12px; font-weight: bold">

                          Upload Image</label>
                      <input hidden id="myImage" onchange="myfile_uploader_upload(event,'{{route('myfileUploader.upload')}}','{{ csrf_token() }}','{{$type}}','{{$item_id}}')" name="myImage" type="file">
                  </div>
                  <div id="mainFileUploadContainer" >

                  </div>
              </div>
          </div>





  </div>
    </div>
</div>
<script>
setTimeout(function (){
    updateImages()
},1000)
    function myfile_uploader_upload(ev,url,token,type,item_id)
    {

        // if (me.target.value!="")
        // {
        var form=new FormData()
        form.append('_token',token)
        form.append('file',ev.target.files[0])
        form.append('type',type)
        form.append('item_id',item_id)
        console.log(form)
        $("#uploadBtn").html("Uploading...")
        $.ajax({
            type:'post',
            url:url,
            processData: false,
            contentType: false,
            cache: false,
            data:form,
            enctype: 'multipart/form-data',

            success:function(data){
                $("#uploadBtn").html("Upload Image")
                updateImages()
            },
            error:function ()
            {
                $("#uploadBtn").html("Upload Image")
            }
        })

        // }


    }
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

</script>
