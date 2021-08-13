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
        <h3>Thank You</h3>
        <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
        </ol>
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
        <div class='form-group col-sm-8' >
            @if(!empty($results))
            @if(Session::get('admin_id') == '1' )
            <button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>
            @endif
                {!! $results[0]->campaign_screen !!}
            @else
              <iframe width="854" height="480" src="https://www.youtube.com/embed/yCMjnncj5Pc" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
            @endif
           
            <h2></h2>
            <p><a href="{{ Request::root().'/selectPlatform?i='.$i }}">BACK TO SELECT PLATFORM</a></p>
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


        
    });

</script>
@endsection