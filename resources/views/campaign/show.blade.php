@extends("layouts.app")

@section('content')
<div class='panel panel-default'>
    <div class='panel-body'>  
        <h3>Select Contacts</h3>
        <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$campaign['id'] }}">Select Platform</a></li>
            <li><a href="#">Select Contacts</a></li>
        </ol>
        <div class='form-group col-sm-8' style="margin: 50px auto;float: none;" >
            <iframe width="854" height="480" src="https://www.youtube.com/embed/NzoRSz1XoIs" frameborder="0" gesture="media" allowfullscreen></iframe>

            @if ($emails)
            <h2>Select {{ $type }} Contacts:</h2>
            <hr>
            <div class='form-group col-sm-6' style="float: none;margin: 0 auto;max-height: 1000px;overflow-y: scroll;">
                <h3>Total Contacts Imported : <?php echo count($emails); ?></h3>
                <table class="table table-striped table-bordered table-result">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" /></th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    @foreach ($emails as $i => $email)
                    <tr class="contact-row">
                        <td><input type='checkbox' name="checkbox[]" class="email-check"/></td>
                        <td name='names[]' class="names">{{ $email['name'] }}</td>
                        <td name='emails[]' class="email">{{ $email['email'] }}</td>
                    </tr>
                    @endforeach
                </table>
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cid" id="cid" value="{{ $campaign['id'] }}">
            </div>
            <button type="button" class="btn btn-default col-sm-2 col-sm-offset-5" id="save-contacts">Save Contacts</button>
            <script type="text/javascript">
                jQuery(document).ready(function() {



                    $("#checkAll").click(function() {
                        $(".email-check").prop('checked', $(this).prop('checked'));
                    });

                    $("#save-contacts").click(function() {
                        var allVals = {};
                        $('.email-check:checked').each(function(i) {
                            var record = {};
                            var email = $(this).parents('tr').find('.email').text();
                            var name = $(this).parents('tr').find('.names').text();
                            record.email = email;
                            record.name = name;
                            allVals[i] = record;
                        });
                        //                console.log(allVals);return;
                        var _token = $('#_token').val();
                        var cid = $('#cid').val();
                        var postData = {};
                        postData.emails = allVals;
                        postData._token = _token;
                        postData.cid = cid;
                        $.ajax({
                            type: "POST",
                            url: './saveContacts',
                            dataType: "json",
                            data: postData,
                            cache: false,
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
                    });

                    $("#checkAll").click();
                });

            </script>

            @endif
        </div>
    </div>
</div>

@endsection