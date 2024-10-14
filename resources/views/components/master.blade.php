<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Thesis</title>
</head>
<body class="bg-gray-100 bg-no-repeat bg-cover min-h-screen">
    {{ $slot }}
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('status') && session('message'))
            @if (session('status') == '200')
            console.log('message : ', "{{ session('message') }}"); // Properly include the message in quotes
                Swal.fire({
                    position: "top-end",
                    title: "{{ session('message') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    backdrop: false,
                    customClass: {
                        popup: 'small-swal success-swal' // Add success class here
                    }
                });
            @elseif (session('status') == '500')
            console.log('message : ', "{{ session('message') }}"); // Properly include the message in quotes
                Swal.fire({
                    position: "top-end",
                    title: "{{ session('message') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    backdrop: false,
                    customClass: {
                        popup: 'small-swal error-swal' // Add error class here
                    }
                });
            @elseif (session('status') == '400')
            console.log('message : ', "{{ session('message') }}"); // Properly include the message in quotes
                Swal.fire({
                    position: "top-end",
                    title: "{{ session('message') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    backdrop: false,
                    customClass: {
                        popup: 'small-swal bad-request-swal' // Add error class here
                    }
                });
            @endif
        @endif
    });
</script>

<style>
    .small-swal {
        width: 250px; /* Set your desired width */
        height: 40px; /* Set your desired height */
        font-size: 6px; /* Adjust font size */
        color: white; /* Font color */
        display: flex; /* Enable flexbox for centering */
        align-items: center; /* Center vertically */
        justify-content: center; /* Center horizontally */
        text-align: center; /* Center text */
        overflow: hidden; /* Prevent overflow */
        white-space: nowrap; /* Prevent text from wrapping */
        text-overflow: ellipsis; /* Show ellipsis for overflowing text */
    }

    .success-swal {
        background-color: rgb(21, 202, 21); /* Success color */
    }

    .error-swal {
        background-color: rgb(255, 0, 0); /* Error color */
    }

    .bad-request-swal {
        background-color: rgba(204, 176, 49, 0.889); /* Error color */
    }
</style>
