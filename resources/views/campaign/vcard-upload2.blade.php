<!-- First, extends to the CRUDBooster Layout -->

@extends("layouts.app")
@section('content')
<!-- Your html goes here -->
<div class="container">
    <style>
        .container{margin-top: 50px;margin-bottom: 50px;}
    </style>
    <div class='panel panel-default'>
        <div class='panel-body'>  
            <p style="text-align: right;margin-top: 20px;"><a href="{{ Request::root().'/campaign/'.$campaignId }}">BACK TO PREVIOUS PAGE</a></p>

            <div class="col-sm-9">
                <h3>Please follow the instructions below and upload your contacts file.</h3>
                <p>1. Login into your email account and go to your contacts.</p>
                <p>2. Export your contacts, choose vCard format (recommended) or CSV format.</p>
                <p>3. Download the file to your computer.</p>
                <p>4. Upload the file you just downloaded using the form below.</p>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class='form-group col-sm-6'>

                {!! Form::open(['url' => 'processVcard2', 'files' => true,'class'=>'form-inline']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Vcard File:') !!}
                    {!! Form::file('vcard-file',  ['class' => 'form-control']) !!}
                    {!! Form::hidden('cid', $campaignId ,  ['class' => 'form-control']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-default'])  !!}
                </div>
                {!! Form::close() !!}

            </div>

            <!-- etc .... -->

            </form>
        </div>
    </div>
</div>  
@endsection