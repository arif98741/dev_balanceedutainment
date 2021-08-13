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
        <h3><?php echo $title; ?></h3>
          <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
            <li><a href="#"><?php echo $title; ?></a></li>
            
        </ol>
 



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

        <div class='form-group col-sm-8' id="contentBody">
@if(Session::get('admin_id') == '1' )
@php if(!empty($results)){ @endphp 
    <button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>

@php } @endphp


@endif            

<?php
if(!empty($results)){
    echo $results[0]->campaign_screen;

    
}else{ ?>
    @if($method == "selectFacebook")
      
      <iframe width="854" height="480" src="https://www.youtube.com/embed/GU4AW9QisOA" frameborder="0" gesture="media" allowfullscreen></iframe>

    @elseif($method == "selectGoogle")
    
    <iframe width="854" height="480" src="https://www.youtube.com/embed/Bb_2foHJ6no" frameborder="0" gesture="media" allowfullscreen></iframe>

    @elseif($method == "selectYahoo")
    
    <iframe width="854" height="480" src="https://www.youtube.com/embed/XBSjs-khlR4" frameborder="0" gesture="media" allowfullscreen></iframe>

    @elseif($method == "selectLinkedin")
    <iframe width="854" height="480" src="https://www.youtube.com/embed/gVbbF99mWOY" frameborder="0" gesture="media" allowfullscreen></iframe>

            <div class="col-sm-9">
                <h2>Please follow the steps below (better do this from your PC/desktop)</h2>
                <p>1. Go to <a href="http://www.linkedin.com" target="_blank">www.linkedin.com</a> and login into your linkedin account.</p>
                <p>2. Select Connections and click the Download Archive button at this URL ->  <a target="_blank" href="https://www.linkedin.com/settings/data-export-page" >www.linkedin.com/settings/data-export-page</a></p>
                <p>3. You will get an email from LinkedIn in the next few minutes. Click through on the download link.</p>
                <p>4. On the page that opens, click the Download Archive button. </p>
                <p>5. Come back to this page and upload the file "Connections.csv" using the form below.</p>
            </div>
    @elseif($method == "selectVcard")
    
    <iframe width="854" height="480" src="https://www.youtube.com/embed/8Um1w9hbEwg" frameborder="0" gesture="media" allowfullscreen></iframe>
            <div class="col-sm-9">
                <h3>Please follow the instructions below and upload your contacts file.</h3>
                <p>1. Login into your email account and go to your contacts.</p>
                <p>2. Export your contacts, choose vCard format (recommended) or CSV format.</p>
                <p>3. Download the file to your computer.</p>
                <p>4. Upload the file you just downloaded using the form below.</p>
            </div>
        @elseif($method == "selectPlatform")

        <iframe width="854" height="480" src="https://www.youtube.com/embed/y7B4yiioVkI?autoplay=0" frameborder="0" gesture="media" allowfullscreen></iframe>


        

    @else
        <h1>No Screen</h1>

    @endif
        
<?php }
?>            

      
@if($method == "selectPlatform")

   
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



@elseif($method == "selectVcard")
<div class="clearfix"></div>
            <hr>
            <div class='form-group col-sm-6'>

                {!! Form::open(['url' => 'processVcard2', 'files' => true,'class'=>'form-inline', 'onSubmit'=>'return validate();']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Vcard File:') !!}
                    {!! Form::file('vcard-file',  ['class' => 'form-control' , 'id'=>'vcard-file','required' => 'required']) !!}
                    {!! Form::hidden('cid', $i ,  ['class' => 'form-control']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-default'])  !!}
                    
                </div>
                <span id="error_message" style="padding-left:126px; color:red; display:none;"></span>
                {!! Form::close() !!}

            </div>

@elseif($method == "selectLinkedin")
 <div class="clearfix"></div>
            <hr>
            <div class='form-group col-sm-6'>

                {!! Form::open(['url' => 'linkedinContacts2', 'files' => true,'class'=>'form-inline','onSubmit'=>'return validate();']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Csv File:') !!}
                    {!! Form::file('csv-file',  ['class' => 'form-control', 'id'=>'csv-file','required' => 'required']) !!}
                    {!! Form::hidden('cid', $i ,  ['class' => 'form-control']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-default'])  !!}
                </div>
                {!! Form::close() !!}
                <span id="error_message" style="padding-left:126px; color:red; display:none;"></span>
            </div>
@elseif($method == "selectYahoo")
            <div class="col-sm-12" style="margin-top: 5px;">
                <a href="{{ Request::root().'/yahooContacts2?i='.$i}}"  title="click this button to connect yahoo">
                <button type="button" class="btn btn-default" >Yahoo Connect</button>
            </a>
            </div>
 @elseif($method == "selectGoogle")
<div class="col-sm-12" style="margin-top: 5px;">
    <a href="{{ Request::root().'/googleContacts2?i='.$i}}"  title="click this button to connect Google">
                <button type="button" class="btn btn-default" >Connect Google</button>
            </a>
</div>
 @endif

            
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