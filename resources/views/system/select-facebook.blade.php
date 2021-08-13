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
            <h3>Import Facebook Contacts

            </h3>
            <ol class="breadcrumb">
                <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
                <li><a href="#">Import Facebook Contacts</a></li>
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

<div class='form-group col-sm-12' >
<?php
if(!empty($results)){
    echo $results[0]->campaign_screen;
}else{ ?>
    <iframe width="854" height="480" src="https://www.youtube.com/embed/GU4AW9QisOA" frameborder="0" gesture="media" allowfullscreen></iframe>

    <div class="clearfix"></div>
                <div class="col-sm-9">
                    <h5><strong>1. Create/login into your Yahoo email · Select and complete one of the options below:</strong></h5>
                    <p> I already have a Yahoo email account:  <a href="https://login.yahoo.com/config/mail">Login into Yahoo mail</a></p>
                    <h6>OR</h6>
                    <p>  I don't have a Yahoo account: <a href="https://edit.yahoo.com/registration">Create new Yahoo mail account</a></p>
                    <h2></h2>
                    <h5><strong>2. Import emails from Facebook</strong></h5>
                    <p>Go to Yahoo mail and follow the steps below (see image):</p>
                    <p>i - Press on the contacts icon (top left, second icon) or use this <a href="https://mg.mail.yahoo.com/neo/launch?action=contacts">link</a>.</p>
                    <p>ii - Press on the "facebook" option (left pane).</p>
                    <p>iii - Press on the "import" button (right pane) and approve the facebook permissions.</p>
                    <img class="col-sm-9" src="{{URL::asset('/images/yahoo_tour.png')}}" alt="yahoo tour"/>
                    <div class="clearfix"></div>
                    <p>Wait a few moments while all contacts are synced. Reload the page.</p>
                    <p><strong>3. Click Yahoo Connect button</strong></p>
                    <a href="{{ Request::root().'/facebookContacts2?i='.$i}}"  title="click this button to connect facebook">
                        <button type="button" class="btn btn-default col-sm-offset-5" >Yahoo Connect</button>
                    </a>
                </div>

<?php }
?>
  </div>             
            {{--     <div class="col-sm-12">
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