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
        <h3>Import Google Contacts</h3>
          <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
            <li><a href="#">Connect Google</a></li>
            
        </ol>



            <div class="col-sm-12">
               <form id="editForm">
                 <h2>Edit Screen</h2>
                 @php
             if(!empty($results)){ @endphp 
                <input type="hidden" name="ScreenId" id="ScreenId" value="@php echo $results[0]->id @endphp">
                <input type="hidden" id="token" value="{{csrf_token()}}">
               
                <textarea id="content">@php echo $results[0]->campaign_screen @endphp</textarea>
               @php } @endphp
                
                   

                   <button type="button" id="updateScreen" class="btn btn-default col-sm-2 ">Update</button>
               </form>
               <hr/>
           </div> 
<div class="col-sm-12" id="contentBody">
        @php
if(!empty($results)){ @endphp
   <button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>
@php } @endphp

<div class='form-group col-sm-12'>
<?php
if(!empty($results)){
    echo $results[0]->campaign_screen;
}else{ ?>
            <iframe width="854" height="480" src="https://www.youtube.com/embed/Bb_2foHJ6no" frameborder="0" gesture="media" allowfullscreen></iframe>
<?php }
?>            
</div>  
</div>  

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



<div class="col-sm-12" style="margin-top: 5px;">
    <a href="{{ Request::root().'/googleContacts2?i='.$i}}"  title="click this button to connect Google">
                <button type="button" class="btn btn-default" >Connect Google</button>
            </a>
</div>
            
        
    </div>

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