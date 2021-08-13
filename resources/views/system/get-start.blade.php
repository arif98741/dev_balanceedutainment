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
        <h3>Login via Facebook</h3>
        <div class="col-sm-12">
            <div class="col-sm-12">
               <form id="editForm">
                 <h2>Edit Screen</h2>
                 @php
             if(!empty($data['results'])){ @endphp 
                <input type="hidden" name="ScreenId" id="ScreenId" value="@php echo $data['results'][0]->id @endphp">
                <input type="hidden" name="campaignId" id="campaignId" value="@php echo $data['i'] @endphp">
                <input type="hidden" id="token" value="{{csrf_token()}}">
               
                <textarea id="content">@php echo $data['results'][0]->campaign_screen @endphp</textarea>
               @php } @endphp
                
                   

                   <button type="button" id="updateScreen" class="btn btn-default col-sm-2 ">Update</button>
               </form>
               <hr/>
           </div> 

        </div>
        <div class='form-group col-sm-7' id="contentBody">
            {{--  print_r($data['results']) --}}
            @if(!empty($data['results']))
            
            @if(Session::get('admin_id') == '1' )
            <button class="btn" title="Edit" onclick="editForm()"><i class="glyphicon glyphicon-edit"></i></button>
            @endif
                {!! $data['results'][0]->campaign_screen !!}
            @else
            
             <iframe style="width: 100%;height: 400px;" src="https://www.youtube.com/embed/6yhBKJhFftk" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
            @endif
            
           
           <div class="col-sm-12" style="margin-top: 5px;">
               <a href="{{ Request::root().'/facebookLogin?post='.$post}}"  title="click this button to login using facebook">
                
                <button  type="button" class="btn btn-default col-sm-5 " id="save-btn">Facebook Login</button>
            </a>
           </div>
        </div>


        <div class='form-group col-sm-4'>
          <?php 
//print_r($campaign->campaign_title);
           ?>
            <form id="campaignForm" class="hide">
              
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $encodedData['campaign_id'] }}">
                <div class="col-sm-12 form-group">
                    <label class="col-sm-12">User</label>
                    <select class="form-control" name="cuser" required="">
                        <option value="">Please Select User</option>
                        @foreach($CmsUsers as $CmsUser)
                        <option value="{{ $CmsUser->id }}"
                            @if($CmsUser->id == $campaign->user_id) selected @endif
                         >{{ $CmsUser->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 form-group">
                    <label class="col-sm-12">Campaign Title</label>
                    <input type="text" class="form-control" name="ctitle" value="{{ $campaign->campaign_title }}" placeholder="Campaign Title" required="">
                </div>
                <div class="col-sm-12">
                    <label class="col-sm-12">Campaign Desc</label>
                    <textarea name="cdesc">{!! $campaign->campaign_desc !!}</textarea>
                </div>

                <div class="col-sm-12 form-group">
                    {{-- <label class="col-sm-12">Campaign Start Time</label> --}}
                   {{-- <div class="input-group">             --}}
                        <div class='input-group date' id='datetimepicker1'>
                        <input type='text' name="campaign_date" value="{{ $campaign->campaign_start_time }}" class="form-control" required="" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        </div>                    
                    {{-- </div> --}}
                    {{-- <input type="text" class="form-control notfocus datetimepicker active form-control" value="{{ $campaign->campaign_title }}" name=""> --}}
                </div>
                <div class="col-sm-12 form-group">
                    <label class="col-sm-12">Campaign Status</label>
                     <select class="form-control" name="cstatus" required="">
                        <option value="">Please Select Campaign Status</option>
                        <option value="0" @if('0' == $campaign->campaign_status) selected @endif>UnPublished</option>
                        <option value="1" @if('1' == $campaign->campaign_status) selected @endif>Published</option>
                    </select>
                </div>

               {{--  <div class="col-sm-12">
                    <div class="input-group">           
                        <span class="input-group-addon"><a href="javascript:void(0)" onclick="$('#campaign_start_time').data('daterangepicker').toggle()"><i class="fa fa-calendar"></i></a></span>
                        
                        <input type="text" title="Campaign Start Time" readonly="" required="" class="form-control notfocus datetimepicker active" name="campaign_start_time" id="campaign_start_time" value="2018-08-24 05:10:10">
                    </div>
                </div> --}}
                
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-info">Update Campaign</button>
                </div>
            </form>



        </div>

    </div>
</div>
</div>



<!-- Font Awesome Icons -->
{{-- <link href="http://alinasoftwares.in/dave/public/vendor/crudbooster/assets/adminlte/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<!--BOOTSTRAP DATERANGEPICKER-->

<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="http://alinasoftwares.in/dave/public/vendor/crudbooster/assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">          
<script src="http://alinasoftwares.in/dave/public/vendor/crudbooster/assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">


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


        // $('#campaignForm').on('submit', function(e) {
        //     var templateId = $("#templateId").val();
        //     var data = $("#content").val();
        //     var token=$("#token").val();
        //     $.ajax({
        //         method: "POST",
        //         url: "{{-- url('updateTemplate')--}}",
        //         dataType : 'json',
        //         data: {templateId:templateId,data:data,_token:token},
        //         success: function(postBack) {
        //             if(postBack==1){
        //                 alert('Template Save success');
        //             }else{
        //                alert('Template Save Success');
        //             }
        //         }
        //     });
        //     return false;
        // });

         $('#campaignForm').on('submit', function(e) {
            var token=$("#token").val();
            $.ajax({
                method: "POST",
                url: "{{ url('updateCampaign')}}",
                //dataType : 'json',
                data: $('#campaignForm').serialize(),
                success: function(postBack) {
                    //console.log('Template Save success'+postBack);
                    if(postBack==1){
                        alert('Campaign Update success');
                    }else{
                       alert('Campaign Update Failed');
                    }
                }
            });
            return false;
        });

$('#datetimepicker1').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});
    });

</script>
@endsection