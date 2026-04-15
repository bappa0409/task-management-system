<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="bg-gray-50 dark:bg-gray-900">

<nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-white">Task Manager</h1>
        <div class="text-sm text-gray-400">Simple Productivity System</div>
    </div>
</nav>

<main class="max-w-6xl mx-auto p-6">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const el = document.querySelector("#due_date");
        if (el) {
            flatpickr("#due_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                allowInput: true,
                disableMobile: true
            });
        }
    });
</script>
</body>
</html>