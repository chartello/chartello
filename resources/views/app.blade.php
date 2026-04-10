<!DOCTYPE html>
<html class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/vendor/chartello/favicon.ico">
    <link rel="stylesheet" href="{{ mix('css/app.css', 'vendor/chartello') }}"/>
</head>
<body class="min-h-full flex flex-col bg-gray-50">
    <div id="app"></div>

    <script>window.__CHARTELLO__ = @json($chartello);</script>
    <script src="{{ mix('js/app.js', 'vendor/chartello') }}"></script>
</body>
</html>
