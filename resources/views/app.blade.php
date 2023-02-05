<!DOCTYPE html>
<html class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ mix('css/app.css', 'vendor/chartello') }}"/>
    @inertiaHead
</head>
<body class="min-h-full flex flex-col bg-gray-50">
    @inertia

    <script src="{{ mix('js/app.js', 'vendor/chartello') }}"></script>
</body>
</html>
