<?php
session_start();
$_SESSION['userIP'] = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generic Medicine</title>
    <style>
        body {
            background-color: #a12929;
            font-family: 'Times New Roman', Times, serif;
        }
        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            background-color: #fff;
            text-align: center;
            color: #d61616;
            font-size: 50px;
            padding: 30px 60px;
            transform: translate(-50%, -50%);
            box-shadow: 0px 25px 50px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: 25s;
            text-shadow: 0px 25px 50px rgba(0, 0, 0, 0.8);
            letter-spacing: 2px;
            word-spacing: 3px;
            font-weight: 800;
        }

        .center:before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .center span:nth-child(1) {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, #f0ecec, #ff6863);
            animation: anim1 2s linear infinite;
            animation-delay: 2;
        }

        @keyframes anim1 {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .center span:nth-child(2) {
            position: absolute;
            top: 0;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, #f0ecec, #ff1717);
            animation: anim2 2s linear infinite;
            animation-delay: 1;
        }

        @keyframes anim2 {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(100%);
            }
        }

        .center span:nth-child(3) {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to left, #f0ecec, #ff1717);
            animation: anim3 2s linear infinite;
            animation-delay: 1;
        }

        @keyframes anim3 {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .center span:nth-child(4) {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(to top, #f0ecec, #ff1717);
            animation: anim4 2s linear infinite;
            animation-delay: 2;
        }

        @keyframes anim4 {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-100%);
            }
        }
    </style>
</head>

<body onload="setTimeout(function(){window.location.href = './index.php';}, 3000)">
    <div class="center">
        Welcome to Generic Medicine
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</body>

</html>