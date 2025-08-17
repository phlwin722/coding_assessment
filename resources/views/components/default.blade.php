<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/signin.js', 'resources/js/signup.js'])
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('access_token');

            if (token) {
                window.location.href = 'movie'
                return;
            } else {
                document.getElementById('body').classList.remove('hidden')
            }
        })
    </script>
</head>

<body id="body" class="hidden bg-gray-100 flex items-center justify-center py-4 px-6">
    {{ $slot }}
</body>

</html>
