<?php
//dd($campaign);
?>

@extends("layouts.app")
    <!-- Include Editor style. -->
 <!-- @include('crudbooster::admin_template_plugins')    -->
@section('content')
<!-- <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css' rel='stylesheet' type='text/css' /> -->
     

<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
    </style>
    <div class='panel panel-default'>
        <div class='panel-body'> 
            <h3><?php echo $title?$title:'Compose Message'; ?></h3>
            <ol class="breadcrumb">
                <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
                <li><a href="#"><?php echo $title?$title:'Compose Message'; ?></a></li>
            </ol>

            <div class='form-group  col-sm-12' >
 <div class="col-sm-12">
               <form id="editForm">
                 <h2>Edit Screen</h2>
                 @php
             if(!empty($results)){ @endphp 
                <input type="hidden" name="ScreenId" id="ScreenId" value="@php echo $results[0]->id @endphp">
                <input type="hidden" name="campaignId" id="campaignId" value="@php echo $i @endphp">
                <input type="hidden" id="token" value="{{csrf_token()}}">
               
                <textarea id="content">@php echo $results[0]->campaign_screen @endphp</textarea>
               @php } @endphp
                
                   

                   <button type="button" id="updateScreen" class="btn btn-default col-sm-2 ">Update</button>
               </form>
               <hr/>
           </div> 

<div class='form-group col-sm-12' id="contentBody">
@if(!empty($results))
@if(Session::get('admin_id') == '1' )
    <button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>
@endif

    {!! $results[0]->campaign_screen !!}

@else
 <iframe width="854" height="480" src="https://www.youtube.com/embed/t1lzd4ZPq3E?autoplay=0" frameborder="0" gesture="media" allowfullscreen></iframe>
@endif
</div>
                

                <h2>Customize Message For <?php echo count(session()->get('socialEmails')); ?> Contacts</h2>
                <?php
                    $c=count(session()->get('socialEmails'));
                    
                    if($c===1)
                    {
                        if(session()->get('socialEmails')[0]['name']!="")
                        {
                            $name=explode(" ",session()->get('socialEmails')[0]['name']);
                            if($name[0]=="")
                            {
                                $name[0]="Friend";
                            }
                        }
                        else
                        {
                            $name[0]="Friend";
                        }
                        
                    }
                    else{
                        $name[0]="Friend";
                    }
                 ?>
                <div class="col-sm-12">
                    <form method="post" action="{{ Request::root().'/saveMsg'}}">
                    <div class="form-group  text-left col-sm-6">
                        <label class="col-sm-2">Subject: </label>
                       <!-- $campaign->subject -->
                        <input type="text" name="subject" class="form-control col-sm-10" id="subject" value="{{$name[0]}},"/>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group  text-left col-sm-6">
                        <label class="col-sm-2">Message:  </label>
                        <div class="clearfix"></div>
                     
                        <textarea type="wysiwyg" name="msg-desc" id="msg-desc">{!! $myCampagin->campaign_desc !!}</textarea>
                    </div>
                   <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-6">Test Email</label>
                            <input type="email" class="form-control" name="testEmail" id="testEmail" placeholder="Example@example.com">
                            <input type="hidden" name="emailTempId" value="{{$campaign->id}}">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-warning" onclick="sendMail()">Send Test Mail</button>
                        </div>
                    </div>
                   <div class="clearfix"></div>
                    <div class="col-sm-8 text-left"><strong>&lt;first_name&gt;</strong> will be replaced with your friend's first name or will be "friend" when the info is not available.</span>
                        <h2></h2>
                        <div class="form-group text-left col-sm-8">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <button type="submit" id="save-msg" class="btn btn-default" >Save Message</button>
                           
                        </div>
                </form>

                </div>
                
            </div>
        </div>

    </div>
</div>
<style type="text/css">
    .note-editable .panel-body
    {
        height: 200px !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/summernote/summernote.css')}}">
<script type="text/javascript" src="{{asset('vendor/crudbooster/assets/summernote/summernote.js')}}"></script>  
 <!-- Include JS file. -->
    <!-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/froala_editor.min.js'></script> -->
<script>
    $(function() {
         // $('textarea').froalaEditor()
          $('textarea').summernote({
                                    // height: ($(window).height() - 600),
                                     height: 200,
                                    callbacks: {
                                        onImageUpload: function(image) {
                                            uploadImagecampaign_desc(image[0]);
                                        }
                                    }
                                  });
        $('#save-msg').click(function() {
            var mysave = $('#msg-desc-div').html();
            $('#msg-desc').val(mysave);
        });
    });

    function sendMail() {
        if($("#testEmail").val()!="")
        {
            
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var dd= emailReg.test( $("#testEmail").val() );
            if(dd)
            {
                var emailId = $("#testEmail").val();
            var emailTemplate = $("#msg-desc").val();
            var emailSubject = $("#subject").val();
            var token=$("#_token").val();
            $.ajax({
                method: "POST",
                url: "{{ url('sendMail')}}",
                dataType : 'json',
                data: {emailId:emailId,emailTemplate:emailTemplate,_token:token,emailSubject:emailSubject},
                success: function(postBack) {
                    console.log(postBack);
                    if(postBack==1){
                        alert('Mail Sent');
                    }else{
                       alert('Mail Sent Failed');
                    }
                }
            });
            }
            else
            {
                alert("Please Enter Vailid Email");
                return false;
            }
        }
        else
        {
            alert("Please Enter Email First");
            return false;
        }
    }
</script>
<style>
    .editable-area{
        height: 170px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px 10px;
        overflow: scroll;
        overflow-x: hidden;
        resize: vertical;
    }
</style>
@endsection