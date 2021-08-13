
<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')
@section('content')
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
        .campaign-report td,.campaign-report th{border: 1px solid #ddd !important;}
    </style>


    @if ($data)
    <h2>Campaigns Report</h2>
    <hr>
    <div class='form-group col-sm-6'>
        <table class="table table-striped table-bordered campaign-report" id="table_dashboard">
            <thead>
                <tr>
                    <th>Campaign</th>
                    <th>Emails Sent</th>
                    <th>Senders</th>
                    <th>Clickthrough</th>
                    <th>CTR</th>
                </tr>
            </thead>
            @foreach ($data as $row)
            <tr class="contact-row">
                <td ><a href="campaign_report/{{$row->id}}">{{ $row->campaign_title }}</a></td>
                <td >{{ $row->emails_sent or '-' }}</td>
                <td >{{ $row->senders or '-' }}</td>
                @if($row->clickthrough == '0')
                <td >{{ $row->clickthrough or '-' }}</td>
                @else
                <td ><a class="hyperlink" href="{{url('clickthrough_report\/').$row->id}}">{{ $row->clickthrough or '-' }}</a></td>
                @endif
                <td >{{ $row->ctr or '-'}}</td>
            </tr>
            @endforeach
        </table>
    </div>


    @endif
</div>

@endsection