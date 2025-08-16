<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/signin.js', 'resources/js/signup.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center py-4 px-6">
    {{ $slot }}
</body>
</html>