
<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')

@section('content')
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
        .campaign-report td,.campaign-report th{border: 1px solid #ddd !important;}
    </style>

    @if ($data) 
    <h2>Clickthroughs: {{$campaign->campaign_title}}</h2>
    <hr>

    <div class="col-sm-7">
        <div class="col-sm-6"><strong>Sender's Name :</strong> {{ $campaign->name}}</div>
        <div class="col-sm-6"><strong>Sender's Email :</strong> {{$campaign->email}}</div>
    </div>

    <div class="clearfix"></div>
    <div class='form-group col-sm-10'>
        <h3></h3>
        <table class="table table-striped table-bordered campaign-report">
            <thead>
                <tr>
                    <th>S#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Email Date</th>
                    <th>Clickthrough Date</th>
                </tr>
            </thead>

            <?php
            $totalEmails = 0;
            $totalClickThrough = 0;
            ?>
            @foreach ($data as $ind => $row)
            <?php
           if(isset($row->clickthrough_date))
            $totalClickThrough += 1;
            ?>



            <tr class="contact-row">
                <td >{{$ind +1}}</td>
                <td ></td>
                <td ></td>
                <td >{{ $row->email }}</td>
                <td >{{ $row->email_date }}</td>
                <td >{{ $row->clickthrough_date }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-5">
        <table class="table table-striped table-bordered campaign-report">
            <thead>
                <tr>
                    <th>Emails Sent</th>
                    <th>Total Clickthroughs</th>
                    <th>Total CTR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ count($data) }}</td>
                    <td>{{ $totalClickThrough }}</td>
                    <td>{{ round($totalClickThrough/count($data) ,3) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <div class="col-sm-3">
        <h3> <em>No Data</em> </h3>
    </div>
    @endif
</div>

@endsection