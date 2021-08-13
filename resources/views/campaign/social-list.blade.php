<!-- First, extends to the CRUDBooster Layout -->

@extends('crudbooster::admin_template')
@section('content')
<!-- Your html goes here -->
<div class='panel panel-default'>
    <div class='panel-body'>      
        <div class='form-group col-sm-4'>
            <table class="table table-striped table-bordered">
                <tr><td class="text-center"><h2><a href="<?php echo url('yahooContacts'); ?>">Yahoo</a></h2></td></tr>
                <tr><td class="text-center"><h2><a href="<?php echo url('googleContacts'); ?>">Google</a></h2></td></tr>
                <tr><td class="text-center">
                        <h2><a href="<?php echo url('facebookContacts'); ?>">Facebook</a>
                            <span class="glyphicon glyphicon-question-sign" data-toggle="modal" data-target=".facebook-modal" aria-hidden="true"></span>
                        </h2>

                    </td></tr>
                <tr><td class="text-center"><h2><a href="<?php echo url('linkedin'); ?>">LinkedIn</a></h2></td></tr>
                <tr><td class="text-center"><h2><a href="<?php echo url('uploadVcard'); ?>">Upload Vcard File</a></h2></td></tr>
            </table>
        </div>

        <!-- etc .... -->

        </form>
    </div>
</div>

<!--modal-->
<div class="modal fade facebook-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <img src="{{URL::asset('/images/facebook-info.png')}}" alt="" />
        </div>
    </div>
</div>

<div class="modal fade linkedin-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <img src="{{URL::asset('/images/linkedin-info.png')}}" alt="" />
        </div>
    </div>
</div>
<!--end modal-->


<script type="text/javascript">
    $('#how-to-facebook').on('click', function() {
        $('#myModal').modal();
    })
</script>
@endsection

