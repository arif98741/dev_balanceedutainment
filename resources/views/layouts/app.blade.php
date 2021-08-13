<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <!--<link href="/css/app.css" rel="stylesheet">-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>


        <!-- Scripts -->
        <script>
            window.Laravel = <?php
            echo json_encode([
                'csrfToken' => csrf_token(),
                ]);
                ?>
        </script>
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>
<input type="hidden" name="firstRequest" id="firstRequest" value="{{ Request::segment(1) }}">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    var firstRequest = $('#firstRequest').val();
    console.log(firstRequest);
    $('#editForm').css('display','none');
    function editForm(){
        $('#editForm').toggle();
        $('#contentBody').toggle();
    }


        $('#updateScreen').on('click', function(e) {
            var ScreenId = $("#ScreenId").val();
            var data = $("#content").val();
            var token=$("#token").val();
            var campaignId=$("#campaignId").val();
            $.ajax({
                method: "POST",
                url: "{{ url('updateScreen')}}",
                dataType : 'json',
                data: {campaignId:campaignId,ScreenId:ScreenId,data:data,_token:token},
                success: function(postBack) {
                    console.log(postBack);
                    if(postBack==1){
                        //alert('Template Save success');
                        if(firstRequest == "googleContacts2" || firstRequest == "saveMsg"){
                            window.location.href = "http://dev.balanceedutainment.com/public/selectGoogle?i=1";
                        }else{
                            location.reload();
                        }
                    }else{
                       alert('Screen Update Failed');
                    }
                }
            });
        });
</script>

    </body>
</html>
