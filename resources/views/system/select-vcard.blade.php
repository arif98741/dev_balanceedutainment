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
            <h3>Upload VCard</h3>
              <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
            <li><a href="#">Upload VCard Contacts</a></li>
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

           
<div class="col-sm-12">
    <br/>

<div class="col-sm-12" id="contentBody">
        @php
if(!empty($results)){ @endphp
    <button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>
@php } @endphp

        <?php
if(!empty($results)){
    echo $results[0]->campaign_screen;
}else{ ?>

            <iframe width="854" height="480" src="https://www.youtube.com/embed/8Um1w9hbEwg" frameborder="0" gesture="media" allowfullscreen></iframe>
            <div class="col-sm-9">
                <h3>Please follow the instructions below and upload your contacts file.</h3>
                <p>1. Login into your email account and go to your contacts.</p>
                <p>2. Export your contacts, choose vCard format (recommended) or CSV format.</p>
                <p>3. Download the file to your computer.</p>
                <p>4. Upload the file you just downloaded using the form below.</p>
            </div>
            
        <?php } ?>            
        </div>
  </div>
  
            
             

            
            <div class="clearfix"></div>
            <hr>
            <div class='form-group col-sm-6'>

                {!! Form::open(['url' => 'processVcard2', 'files' => true,'class'=>'form-inline', 'onSubmit'=>'return validate();']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Vcard File:') !!}
                    {!! Form::file('vcard-file',  ['class' => 'form-control' , 'id'=>'vcard-file']) !!}
                    {!! Form::hidden('cid', $i ,  ['class' => 'form-control']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-default'])  !!}
                    
                </div>
                <span id="error_message" style="padding-left:126px; color:red; display:none;"></span>
                {!! Form::close() !!}

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




    });

</script>
@endsection

<script>
function validate(){
$('#error_message').hide();
var ext = $('#vcard-file').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['vcf']) == -1) {
    $('#error_message').show();
	$('#error_message').html('Please upload .vcf extension file');
	return false;
}else{
return true;	
}
}
</script>