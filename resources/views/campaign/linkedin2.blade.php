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
                <h2>Please follow the steps below (better do this from your PC/desktop)</h2>
                <p>1. Go to <a href="http://www.linkedin.com" target="_blank">www.linkedin.com</a> and login into your linkedin account.</p>
                <p>2. Request data archive (Fast File Only) using this URL -> <a target="_blank" href="https://www.linkedin.com/settings/data-export-page" >www.linkedin.com/settings/data-export-page</a></p>
                <p>3. You will get an email from linkedin in the next few mintues.</p>
                <p>4. Download the zip file to your computer. Unzip the file into your computer.</p>
                <p>5. Go to the new folder and upload the file "Connections.csv" into the Social Email Tool using the form below.</p>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class='form-group col-sm-6'>

                {!! Form::open(['url' => 'linkedinContacts2', 'files' => true,'class'=>'form-inline']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Csv File:') !!}
                    {!! Form::file('csv-file',  ['class' => 'form-control']) !!}
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