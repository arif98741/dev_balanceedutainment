
<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')

@section('content')
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
        .campaign-report td,.campaign-report th{border: 1px solid #ddd !important;}
        .dataTables_wrapper
        {
            width: 96%;
        }
    </style>

    @if ($data) 


    <hr>

    <div class="clearfix"></div>

    <div class="box">
        <div class="box-body">
            <div class='col-md-12 table-responsive no-padding'>
            <div class="col-md-12">
                  <table class="table table-striped table-bordered  datatables-simple">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Campaign</th>
                    <th>Emails Sent</th>
                    <th>Emails Inqueue</th>
                </tr>
            </thead>

           @foreach ($data as $row)

                <tr class="contact-row">
                    <td >{{ ($row->user_name)?$row->user_name:'Anonymous'}}</td>
                    <td >{{ $row->campaign_title }}</td>
                    @if(!empty($row->user_id))
                    <td ><a class="hyperlink" href="{{ url('user_report/'.$row->user_id.'/'.$row->campaign_id) }}">{{ $row->sentEmail }}</a></td>
                    <td ><a class="hyperlink" href="{{ url('user_report/'.$row->user_id.'/'.$row->campaign_id) }}">{{ $row->emails_sent - $row->sentEmail }}</a></td>
             @else
             <td>{{ $row->emails_sent }}</td>
             @endif
                </tr>
            @endforeach
        </table>
            </div>
            
    </div>
        </div>
        
    </div>

    @else
    <div class="col-sm-3">
        <h3> <em>No Data</em> </h3>
    </div>
    @endif
</div>

@endsection