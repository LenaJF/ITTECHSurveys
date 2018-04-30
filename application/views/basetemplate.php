<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ITTECH Surveys</title>
    <link rel="stylesheet" type="text/css" href="/css/semantic.css" />
    <link rel="stylesheet" type="text/css" href="/css/ittech.css" />
    <script src="/js/jquery-1.8.3.js"></script>
    <script src="/js/script.js"></script>
</head>
<body>
<div class="ui borderless main menu">
    <div class="ui container">
        <div href="#" class="header item"><img class="logo" src="/img/logo.jpg"></div>
        <a href="#" class="item">Institutional</a>
        <a href="#" class="item">About</a>
    </div>
</div>
<?php include 'application/views/'.$view_name.'.php'; ?>
<!-- Footer -->
<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui horizontal inverted small divided link list">
            <a class="item" href="#">Site Map</a>
            <a class="item" href="#">Contact Us</a>
            <a class="item" href="#">Terms and Conditions</a>
            <a class="item" href="#">Privacy Policy</a>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
