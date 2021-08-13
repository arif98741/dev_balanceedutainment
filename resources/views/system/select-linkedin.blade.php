<!-- First, extends to the CRUDBooster Layout -->

@extends("layouts.app")

@section('content')
<!-- Your html goes here -->
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
    </style>
    <div class='panel panel-default'>
        <div class='panel-body'>  
            <h3>Import Linkedin Contacts</h3>
              <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
            <li><a href="#">Upload LinkedIn Contacts</a></li>
        </ol>

            <div class="col-sm-12">
               <form id="editForm">
                 <h2>Edit Screen</h2>
                 @php
             if(!empty($results)){ @endphp 
                <input type="text" name="ScreenId" id="ScreenId" value="@php echo $results[0]->id @endphp">
                <input type="text" id="token" value="{{csrf_token()}}">
               
                <textarea id="content">@php echo $results[0]->campaign_screen @endphp</textarea>
               @php } @endphp
                
                   

                   <button type="button" id="updateScreen" class="btn btn-default col-sm-2 ">Update</button>
               </form>
               <hr/>
           </div> 

<div id="contentBody">
        @php
if(!empty($results)){ @endphp
<button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>
@php } @endphp


        <?php
if(!empty($results)){
    echo $results[0]->campaign_screen;
}else{ ?>
            <iframe width="854" height="480" src="https://www.youtube.com/embed/gVbbF99mWOY" frameborder="0" gesture="media" allowfullscreen></iframe>

            <div class="col-sm-9">
                <h2>Please follow the steps below (better do this from your PC/desktop)</h2>
                <p>1. Go to <a href="http://www.linkedin.com" target="_blank">www.linkedin.com</a> and login into your linkedin account.</p>
                <p>2. Select Connections and click the Download Archive button at this URL ->  <a target="_blank" href="https://www.linkedin.com/settings/data-export-page" >www.linkedin.com/settings/data-export-page</a></p>
                <p>3. You will get an email from LinkedIn in the next few minutes. Click through on the download link.</p>
                <p>4. On the page that opens, click the Download Archive button. </p>
                <p>5. Come back to this page and upload the file "Connections.csv" using the form below.</p>
            </div>
<?php }
?>            
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
            
            <div class="clearfix"></div>
            <hr>
            <div class='form-group col-sm-6'>

                {!! Form::open(['url' => 'linkedinContacts2', 'files' => true,'class'=>'form-inline','onSubmit'=>'return validate();']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Csv File:') !!}
                    {!! Form::file('csv-file',  ['class' => 'form-control', 'id'=>'csv-file']) !!}
                    {!! Form::hidden('cid', $i ,  ['class' => 'form-control']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-default'])  !!}
                </div>
                {!! Form::close() !!}
				<span id="error_message" style="padding-left:126px; color:red; display:none;"></span>
            </div>

            <!-- etc .... -->

            </form>
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
<script>
function validate(){
$('#error_message').hide();
var ext = $('#csv-file').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['csv']) == -1) {
    $('#error_message').show();
	$('#error_message').html('Please upload .csv extension file');
	return false;
}else{
return true;	
}
}
</script>