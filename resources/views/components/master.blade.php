<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Thesis</title>
</head>

<body class="bg-page-gradient bg-no-repeat bg-cover min-h-screen">
  {{ $slot }}
</body>

</html>
