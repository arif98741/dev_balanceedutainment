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
            <h3>Upload CSV for Linkedin Contacts</h3>
              <ol class="breadcrumb">
            <li><a href="{{ Request::root().'/selectPlatform?i='.$i }}">Select Platform</a></li>
            <li><a href="#">Upload CSV</a></li>
        </ol>
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

                {!! Form::open(['url' => 'linkedinContacts2', 'files' => true,'class'=>'form-inline','onSubmit'=>'return validate();']) !!}
                <div class="form-group">
                    {!! Form::label('csv-file', 'Upload Csv File:') !!}
                    {!! Form::file('csv-file',  ['class' => 'form-control', 'id'=>'csv-file']) !!}
                    {!! Form::submit('Submit',['class'=>'btn btn-default'])  !!}
                </div>
                {!! Form::close() !!}
				<span id="error_message" style="padding-left:126px; color:red; display:none;"></span>
            </div>

            <!-- etc .... -->

            </form>
        </div>
    </div>
</div>
@endsection
<script>
function validate(){
$('#error_message').hide();
var ext = $('#csv-file').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['csv']) == -1) {
    $('#error_message').show();
	$('#error_message').html('Please upload .csv extension file');
	return false;
}else{
return true;	
}
}
</script>