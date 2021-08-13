
<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')

@section('content')
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
        .campaign-report td,.campaign-report th{border: 1px solid #ddd !important;}
    </style>

    @if ($data) 
    <h2>{{$campaign->campaign_title}}</h2>
    <hr>

    <div class='form-group col-sm-6'>
        <div>{!! $campaign->campaign_desc !!}</div>
    </div>

    <hr>

    <div class="clearfix"></div>
    <div class='form-group col-sm-6'>
        <h3></h3>
        <table class="table table-striped table-bordered campaign-report" id="table_dashboard">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Sender Email</th>
                    <th>Emails Sent</th>
                    <th>Clickthrough</th>
                    <th>CTR</th>
                </tr>
            </thead>

            <?php
            $totalEmails = 0;
            $totalClickThrough = 0;
            foreach ($data as $row):

//dd($row);
                $result = App\Campaign::campaign_user_report($campaign->id, $row->user_id);
//dd($result);
                $ctr = ($result['clickthrough'][0]->clickthrough) / ($result['email_sent'][0]->emails_sent);
                $totalEmails += $row->emails_sent;
                $totalClickThrough += $result['clickthrough'][0]->clickthrough;
                ?>


                <tr class="contact-row">
                    <td >{{ $row->name }}</td>
                    <td >{{ $row->email }}</td>
                    <td >{{ $result['email_sent'][0]->emails_sent }}</td>
                    @if( $result['clickthrough'][0]->clickthrough == 0)
                    <td >{{ $result['clickthrough'][0]->clickthrough }}</td>
                    @else
                    <td ><a class="hyperlink" href="{{ url('clickthrough_user_report',[request()->id,$row->user_id]) }}">{{ $result['clickthrough'][0]->clickthrough }}</a></td>
                    @endif
                    <td >{{ round($ctr, 3) }}</td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        <table class="table table-striped table-bordered campaign-report">
            <thead>
                <tr>
                    <th>Total Clickthroughs</th>
                    <th>Total CTR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a class="hyperlink" href="{{url('clickthrough_report\/').$campaign->id}}">{{ $totalClickThrough }}</a></td>
                    <td>{{ round($totalClickThrough/$totalEmails,3) }}</td>
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