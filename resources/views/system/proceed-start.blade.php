<?php
//print_r($campaign);exit;
//dd($campaign);exit;
?>

@extends("layouts.app")

@section('content')

<div class='panel panel-default'>
    <div class='panel-body'>      
        <div class='form-group col-sm-8' style="margin: 50px auto;float: none;text-align: center;" >
            
            
            <iframe width="854" height="480" src="https://www.youtube.com/embed/y7B4yiioVkI?autoplay=1" frameborder="0" gesture="media" allowfullscreen></iframe>

         
            <a href="{{ Request::root().'/selectPlatform'}}"  title="click this button to proceed to select platform screen">
            <button type="button" class="btn btn-default" >Select Platform</button>
            </a>
        </div>


    </div>
</div>

@endsection