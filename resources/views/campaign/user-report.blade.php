
<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')

@section('content')
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
        .campaign-report td,.campaign-report th{border: 1px solid #ddd !important;}
    </style>

    @if ($data) 


    <div class='form-group col-sm-6'>
        <h3>User Custom Template</h3>
        <div><strong>Subject : </strong>{{$template->title}}<br><strong>Content : </strong>{!! $template->content!!}</div>
    </div>

    <hr>

    <div class="clearfix"></div>
    <div class='form-group col-sm-6'>
        <div  class="box">
            <div class="box-body">
                <table class="table table-striped table-bordered datatables-simple">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Receiver Email</th>
                    <th>Operation</th>
                </tr>
            </thead>

            @foreach ($data as $i => $row)

            <tr class="contact-row">
                <td >{{ $i+1 }}</td>
                <td >{{ $row->email }}</td>
                <td ><button class="danger btn btn-sm delete-btn" emid="{{ $row->id }}">Delete</button></td>
            </tr>
            @endforeach
        </table>
            </div>
        </div>
        
    </div>
    <div class="col-sm-6">
        <h3>Default Message</h3>
        <div>
            <strong>Subject :</strong> {{ ($defaultTemplate->email_template->title)?$defaultTemplate->email_template->title:"Not Set Yet"  }}
            <br/>
            <strong>Content :</strong> {!! ($defaultTemplate->email_template->content)?$defaultTemplate->email_template->content:"No Content Yet" !!}
        </div>
    </div>

    @else
    <div class="col-sm-3">
        <h3> <em>No Data</em> </h3>
    </div>
    @endif
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            var curRow = $(this);
            var emid = $(this).attr('emid');
            $.ajax({
                method: "GET",
                url: '{{URL::to("delEmail")}}',
                dataType : 'json',
                data: {'emid': emid},
                success: function(postBack) {
                    if(postBack.response == '1'){
                        $(curRow).parents('tr').remove();
                    }else{
                        return false;
                    }
                }
            });
        });
    });
</script>
@endsection