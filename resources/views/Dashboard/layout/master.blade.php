<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>Panel</title>
    <link rel="stylesheet" href="/dashboards/css/style.css">
    <link rel="stylesheet" href="/dashboards/css/responsive_991.css" media="(max-width:991px)">
    <link rel="stylesheet" href="/dashboards/css/responsive_768.css" media="(max-width:768px)">
    <link rel="stylesheet" href="/dashboards/css/font.css">
</head>
<body>
    @include('Dashboard.layout.sidebar');

@yield('contentDashboard');
</body>
<script src="/dashboards/js/jquery-3.4.1.min.js"></script>
<script src="/dashboards/js/js.js"></script>
</html>