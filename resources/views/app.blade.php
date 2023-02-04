<!DOCTYPE html>
<html class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/css/app.css', 'vendor/chartello/build')
    @vite('resources/js/app.js', 'vendor/chartello/build')
    @inertiaHead
</head>
<body class="min-h-full flex flex-col bg-gray-50">
    @inertia
</body>
</html>
