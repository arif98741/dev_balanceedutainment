@extends("layouts.app")

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">

 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"   crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
 <div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
       #DataTables_Table_0_filter{ position: absolute;
margin-top: -44px;

margin-left: 400px;

}
.dataTables_wrapper {
   
    clear: both;
    *zoom: 1;
    zoom: 1;
    position: unset !important;
}
    </style>
    <div class='panel panel-default'>
        <div class='panel-body'>  
            <h3><?php echo $title; ?></h3>
            <ol class="breadcrumb">
                <li><a href="{{ Request::root().'/selectPlatform?i='.$campaign['id'] }}">Select Platform</a></li>
                <li><a href="#"><?php echo $title; ?></a></li>
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
             <iframe width="854" height="480" src="https://www.youtube.com/embed/NzoRSz1XoIs" frameborder="0" gesture="media" allowfullscreen></iframe>
            @endif

               
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
                @if ($emails)
                <h2>Select {{ $type }} Contacts:</h2>
                <hr>
                <div class='form-group col-sm-12' >
                    <h3>Total Contacts Imported : <?php echo count($emails); ?></h3>
                    <div style="overflow-y: scroll;max-height: 500px;">
                       
                    <table class="table table-striped table-bordered table-result datatables-simple display" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" /></th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($emails as $i => $email)
                        <tr class="contact-row">
                            <td><input type='checkbox' name="checkbox[]" class="email-check"/></td>
                            <td name='names[]' class="names">{{ $email['name'] }}</td>
                            <td name='emails[]' class="email">{{ $email['email'] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="cid" id="cid" value="{{ $campaign['id'] }}">
                </div>
            </div>
                <div class="col-sm-12">
                    <button type="button" class="btn btn-default col-sm-2" id="save-contacts">Save Contacts</button>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function() {

                          $(".datatables-simple").DataTable({
                                paging: false,
                                responsive: true,
                                    fixedHeader: {
                                    header: true,
                                    footer: true
                                    }
                            });
                        $("#checkAll").click(function() {
                            $(".email-check").prop('checked', $(this).prop('checked'));
                        });
                                $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                                });
                        $("#save-contacts").click(function() {
                            var allVals = [];
                            $('.email-check:checked').each(function(i) {
                                
                                var record = {};
                                var email = $(this).parents('tr').find('.email').text();
                                var name = $(this).parents('tr').find('.names').text();
                                record.email = email;
                                record.name = name;
                                allVals[i] = record;
                            });
                            //               console.log(allVals);return;
                            //var _token = $('#_token').val();
                            var cid = $('#cid').val();
                            var t = "{{ csrf_token() }}";
                            var postData = {};
                            postData.cid = cid;

                                //postData.emails = allVals.splice(0, 300);
                                postData.emails = allVals;
                              // console.log(postData.emails);
                                postData._token = "{{ csrf_token() }}",
                                
                                        $.ajax({
                                            type: "POST",
                                            url: './saveContacts',
                                            // contentType: "application/json",
                                            // dataType: "json",
                                            data: {cid:cid,emails:allVals,_token:t},
                                            cache: true,
                                            success: function(postBack) {
                                                //                        var res = $.parseJSON(postBack);
                                                //                        console.log(postBack);return;
                                                if (postBack.msg == 'ok') {
                                                    window.location.href = './composeMsg'
                                                } else {
                                                    return false;
                                                }
                                            }
                                        });
//                            }
                        });

                        $("#checkAll").click();
                    });

                </script>
                @else
                <div class='form-group col-sm-8' style="float: none;margin: 0 auto;">
                    <h3>Total Contacts Imported : <?php echo count($emails); ?></h3>
                    <table class="table table-striped table-bordered table-result">
                        <tr><td>You do not have any contacts in {{ $type }}</td></tr>
                    </table>
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