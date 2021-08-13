<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')
@section('content')

<div class='panel panel-default'>
    <div class='panel-body'>      
        <div class='form-group col-sm-6'>
            <table class="table table-striped table-bordered table-result">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll"/></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @forelse ($emails as $email)
                <tr class="contact-row">
                    <td><input type='checkbox' name="checkbox[]" class="check"/></td>
                    <td name='names[]' class="name">{{ $email['name'] }}</td>
                    <td name='emails[]' class="email">{{ $email['email'] }}</td>
                    <td> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                </tr>
                @empty
                <tr><td>No contacts</td></tr>
                @endforelse
            </table>
            <input type="hidden" name="type" id="mediaType" value="{{$type}}"/>
            <button type="button" class="btn btn-default col-sm-3" id="save-btn">Save</button>
        </div>


    </div>
</div>

<script>
    $(document).ready(function() {
         $(".table-result").DataTable({
                                "paging": false
                            });
        $('.glyphicon-remove').on('click', function() {
            $(this).parents('tr').remove();
        });

        $("#checkAll").click(function() {
            $(".check").prop('checked', $(this).prop('checked'));
        });

        $("#save-btn").click(function() {
            var allVals = {};
//            var stuff ={'key1':'value1','key2':'value2'};
            $('.check:checked').each(function(i) {
                var arr = {};
                var name = $(this).parents('tr').find('.name').text();
                var email = $(this).parents('tr').find('.email').text();
                arr.name = name;
                arr.email = email;
                allVals[i] = arr;
            });
            var type = $('#mediaType').val();
            var postData = {};
            postData.users = allVals;
            postData.type = type;
            $.ajax({
                type: "POST",
                url: './saveSocialMedia',
                dataType: "json",
                data: postData,
                cache: false,
                success: function(postBack) {
                    $('.table-result').html(postBack);
                    $('#mediaType,#save-btn').remove();
                }
            });
        });

    });
</script>
@endsection