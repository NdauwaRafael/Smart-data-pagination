<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Customers</title>

 <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <div class="grid-container">
        <data-viewer source="api/customer" title="Customer Data"></data-viewer>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>
