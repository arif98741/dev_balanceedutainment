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
    <fieldset>
        <legend class="text-uppercase text-bold text-green">Campaign</legend>
        <div class="col-sm-8 panel panel-default" style="float: none;margin: 0 auto;">
            {!! $campaign->campaign_desc !!}
        </div>   
    </fieldset>

    @if ($emails)
    <p style="text-align: right;margin-top: 20px;"><a href="{{ Request::root().'/campaign/'.$campaign->id }}">BACK TO PREVIOUS PAGE</a></p>
    <h2>Select contacts from list below to send the above campaign</h2>
    <hr>
    <div class='form-group col-sm-6' style="float: none;margin: 0 auto;">
        <table class="table table-striped table-bordered table-result">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll" /></th>
                    <th>Email</th>
                </tr>
            </thead>
            @foreach ($emails as $email)
            <tr class="contact-row">
                <td><input type='checkbox' name="checkbox[]" class="email-check"/></td>
                <td name='emails[]' class="email">{{ $email['email'] }}</td>
            </tr>
            @endforeach
        </table>
        <input type="hidden" name="type" id="cid" value="{{ $campaign->id }}"/>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <button type="button" class="btn btn-default col-sm-3" id="send-campaign">Send Campaign</button>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            $("#checkAll").click(function() {
                $(".email-check").prop('checked', $(this).prop('checked'));
            });

            $("#send-campaign").click(function() {
                var allVals = {};
                $('.email-check:checked').each(function(i) {
                    var email = $(this).parents('tr').find('.email').text();
                    allVals[i] = email;
                });
                var cid = $('#cid').val();
                var _token = $('#_token').val();
                var postData = {};
                postData.emails = allVals;
                postData.cid = cid;
                postData._token = _token;
                $.ajax({
                    type: "POST",
                    url: './publish_campaign',
                    dataType: "json",
                    data: postData,
                    cache: false,
                    success: function(postBack) {
//                        console.log(postBack);return;
                        $('.table-result').html(postBack);
                        $('#cid,#send-campaign').remove();
                    }
                });
            });

        });

    </script>
    @else
    <h3 class="">Use one of the options below to participate in campaign</h3>
    <hr>

    <div class='col-sm-8 panel panel-default' style="float: none;margin: 0 auto;">
        <div class='panel-body'>      
            <div class='form-group col-sm-8' style="float: none;margin: 0 auto;">
                <table class="table table-striped table-bordered">
                    <tr><td class="text-center"><h2><a href="<?php echo url('yahooContacts2?i=' . $campaign->id); ?>">Yahoo</a></h2></td></tr>
                    <tr><td class="text-center"><h2><a href="<?php echo url('googleContacts2?i=' . $campaign->id); ?>">Google</a></h2></td></tr>
                    <tr><td class="text-center">
                            <h2><a href="<?php echo url('facebookContacts2?i=' . $campaign->id); ?>">Facebook</a>
                                <span class="glyphicon glyphicon-question-sign" data-toggle="modal" data-target=".facebook-modal" aria-hidden="true"></span>
                            </h2>

                        </td></tr>
                    <tr><td class="text-center"><h2><a href="<?php echo url('linkedin2?i=' . $campaign->id); ?>">LinkedIn</a></h2></td></tr>
                    <tr><td class="text-center"><h2><a href="<?php echo url('uploadVcard2?i=' . $campaign->id); ?>">Upload Vcard File</a></h2></td></tr>
                </table>
            </div>

            <!-- etc .... -->

            </form>
        </div>
    </div>

    <!--modal-->
    <div class="modal fade facebook-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <img src="{{URL::asset('/images/facebook-info.png')}}" alt="" />
            </div>
        </div>
    </div>

    <div class="modal fade linkedin-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <img src="{{URL::asset('/images/linkedin-info.png')}}" alt="" />
            </div>
        </div>
    </div>
    <!--end modal-->
    <script type="text/javascript">
        jQuery(document).ready(function() {


            jQuery('#how-to-facebook').on('click', function() {
                jQuery('#myModal').modal();
            });
        });
    </script>


    @endif
</div>

@endsection