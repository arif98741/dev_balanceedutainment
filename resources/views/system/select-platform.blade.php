<?php
//print_r($campaign);exit;
//dd($campaign);exit;
?>

@extends("layouts.app")

@section('content')
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
    </style>
<div class='panel panel-default'>
    <div class='panel-body'>     
        <h3>Select Platform</h3>
        <div class='form-group col-sm-8'  >
            <iframe width="854" height="480" src="https://www.youtube.com/embed/y7B4yiioVkI?autoplay=0" frameborder="0" gesture="media" allowfullscreen></iframe>


           {{--  <div class="col-sm-12">
            <h2>Email Template</h2>
            <hr>
               <form>
                <input type="hidden" name="templateId" id="templateId" value={{$emailTemplate['id']}}>
                <input type="hidden" id="token" value="{{csrf_token()}}">
                   <textarea id="content">{{$emailTemplate['content']}}</textarea>
                   <button type="button" id="updateButton" class="btn btn-default col-sm-5 ">Update Template</button>
               </form>
           </div> --}}
        </div>

    <!--</div>-->
<!--
    <div class='col-sm-8 panel panel-default' style="border: none;">
        <div class='panel-body'>      -->
            <div class='form-group col-sm-8'>
                <table class="table table-striped table-bordered">
                    <tr><td class="text-center"><h2><a href="<?php echo url('selectYahoo?i=' . $i); ?>">Yahoo</a></h2></td></tr>
                    <tr><td class="text-center"><h2><a href="<?php echo url('selectGoogle?i=' . $i); ?>">Google</a></h2></td></tr>
                    <tr><td class="text-center">
                            <h2><a href="<?php echo url('selectFacebook?i=' . $i); ?>">Facebook</a>
                            </h2>

                        </td></tr>
                    <tr><td class="text-center"><h2><a href="<?php echo url('selectLinkedin?i=' . $i); ?>">LinkedIn</a></h2></td></tr>
                    <tr><td class="text-center"><h2><a href="<?php echo url('selectVcard?i=' . $i); ?>">Upload Vcard File</a></h2></td></tr>
                </table>
            </div>

            <!-- etc .... -->

            </form>
        <!--</div>-->
<!--    </div>
</div>-->
</div>
</div>
<link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('vendor/crudbooster/assets/summernote/summernote.js')}}"></script>  
<script>
    $(function(){
        $('textarea').summernote({
                                    // height: ($(window).height() - 600),
                                     height: 200,
                                    callbacks: {
                                        onImageUpload: function(image) {
                                            uploadImagecampaign_desc(image[0]);
                                        }
                                    }
                                  });


        $('#updateButton').on('click', function(e) {
            var templateId = $("#templateId").val();
            var data = $("#content").val();
            var token=$("#token").val();
            $.ajax({
                method: "POST",
                url: "{{ url('updateTemplate')}}",
                dataType : 'json',
                data: {templateId:templateId,data:data,_token:token},
                success: function(postBack) {
                    if(postBack==1){
                        alert('Template Save success');
                    }else{
                       alert('Template Save Success');
                    }
                }
            });
        });


    });

</script>
@endsection