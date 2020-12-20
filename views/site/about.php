<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        html {
            box-sizing: border-box;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .column {

            width: 50%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
        }


        .container {
            padding: 0 16px;
        }

        .container::after, .row::after {
            content: "";
            clear: both;
            display: table;
        }
        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: black;
            background-color: white;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }
        .button:hover {
            background-color: lightgrey;
        }
        .title {
            color: grey;
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }

        .container2 {
            padding: 0 0;
            position: relative;
        }

        .text-block {
            position: absolute;
            bottom: 10px;
            background-color: black;
            color: white;
            padding-left:50px;
            padding-right: 50px;
            opacity: 0.7;
        }
    </style>
</head>
<body>



<div class="container2">
    <img src="web/uploads/1.jpg" alt="Nature" style="width:100%;">
    <div class="text-block">
        <h1>About Travelling</h1>
        <p>Travel is fun. It is a fantastic adventure. More than that, however, travel can enrich your life in numerous ways. Heading out into the wild, taking to the open road or embarking on a journey to another country is so much more than just a good time.</p>
        <p><a href="https://www.newsgram.com/6-great-benefits-travel/?gclid=Cj0KCQiAifz-BRDjARIsAEElyGLWe7dVIpKB9MUvDO0F5Yv05tWKTES5fRELurvvpdMA6E7yeZLX8V8aApdMEALw_wcB" class="button">Read more</a></p>

    </div>
</div>


<h2 style="text-align:center">Our Team</h2>
<div class="row">
    <div class="column">
        <div class="card">
            <img src="web/uploads/alona.jpg" alt="alona" style="width:100%">
            <div class="container">
                <h2>Alona Byrchenko</h2>
                <p  class="title">Student of SSU</p>

            </div>
        </div>
    </div>

    <div class="column">
        <div class="card">
            <img src="web/uploads/nastya.jpg" alt="nastya" style="width:100%">
            <div class="container">
                <h2>Anastasiia Havrylenko</h2>
                <p  class="title">Student of SSU</p>
            </div>
        </div>
    </div>

</div>

</body>
</html>

