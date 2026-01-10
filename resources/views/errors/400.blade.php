<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 400 - Bad Request</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100svh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2e1a1a 0%, #3e1621 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            overflow-x: hidden;
        }

        .page-center {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
            transform: translateY(-12px);
        }

        .header {
            text-align: center;
            max-width: 600px;
            padding: 0 20px;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #ff3b3b;
            text-shadow: 0 0 10px rgba(255, 59, 59, 0.5);
        }

        .error-code {
            font-size: 4rem;
            font-weight: bold;
            color: #ff3b3b;
            margin-bottom: 0.25rem;
            text-shadow: 0 0 15px rgba(255, 59, 59, 0.7);
        }

        .header p {
            font-size: 1rem;
            line-height: 1.4;
            color: #ccc;
            margin: 0.5rem 0;
        }

        .main_wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25em;
            height: 25em;
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 0;
        }

        .antenna {
            width: 5em;
            height: 5em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #ff3b3b;
            margin-bottom: -6em;
            margin-left: 0em;
            z-index: -1;
            animation: antenna-blink 2s infinite;
        }
        
        @keyframes antenna-blink {
            0%, 50%, 100% { opacity: 1; }
            25%, 75% { opacity: 0.5; }
        }
        
        .antenna_shadow {
            position: absolute;
            background-color: transparent;
            width: 50px;
            height: 56px;
            margin-left: 1.68em;
            border-radius: 45%;
            transform: rotate(140deg);
            border: 4px solid transparent;
            box-shadow:
                inset 0px 16px #cc2f2f,
                inset 0px 16px 1px 1px #cc2f2f;
        }
        
        .antenna::after {
            content: "";
            position: absolute;
            margin-top: -9.4em;
            margin-left: 0.4em;
            transform: rotate(-25deg);
            width: 1em;
            height: 0.5em;
            border-radius: 50%;
            background-color: #ff6b6b;
        }
        
        .antenna::before {
            content: "";
            position: absolute;
            margin-top: 0.2em;
            margin-left: 1.25em;
            transform: rotate(-20deg);
            width: 1.5em;
            height: 0.8em;
            border-radius: 50%;
            background-color: #ff6b6b;
        }
        
        .a1 {
            position: relative;
            top: -102%;
            left: -130%;
            width: 12em;
            height: 5.5em;
            border-radius: 50px;
            background-image: linear-gradient(
                #171717,
                #171717,
                #353535,
                #353535,
                #171717
            );
            transform: rotate(-29deg);
            clip-path: polygon(50% 0%, 49% 100%, 52% 100%);
        }
        
        .a1d {
            position: relative;
            top: -211%;
            left: -35%;
            transform: rotate(45deg);
            width: 0.5em;
            height: 0.5em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #979797;
            z-index: 99;
        }
        
        .a2 {
            position: relative;
            top: -210%;
            left: -10%;
            width: 12em;
            height: 4em;
            border-radius: 50px;
            background-color: #171717;
            background-image: linear-gradient(
                #171717,
                #171717,
                #353535,
                #353535,
                #171717
            );
            margin-right: 5em;
            clip-path: polygon(
                47% 0,
                47% 0,
                34% 34%,
                54% 25%,
                32% 100%,
                29% 96%,
                49% 32%,
                30% 38%
            );
            transform: rotate(-8deg);
        }
        
        .a2d {
            position: relative;
            top: -294%;
            left: 94%;
            width: 0.5em;
            height: 0.5em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #979797;
            z-index: 99;
        }

        .error_text {
            background-color: #8b0000;
            padding: 0.3em 0.5em;
            font-size: 0.65em;
            color: white;
            letter-spacing: 0.1em;
            border-radius: 5px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ff6b6b;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        .error_text_mobile {
            background-color: #8b0000;
            padding: 0.3em 0.5em;
            font-size: 0.5em;
            color: white;
            letter-spacing: 0.1em;
            border-radius: 5px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ff6b6b;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        
        .tv {
            width: 17em;
            height: 9em;
            margin-top: 3em;
            border-radius: 15px;
            background-color: #cc2f2f;
            display: flex;
            justify-content: center;
            border: 2px solid #1d0101;
            box-shadow: inset 0.2em 0.2em #ff6b6b;
            animation: tv-pulse 1.5s infinite alternate;
        }
        
        @keyframes tv-pulse {
            0% {
                box-shadow: inset 0.2em 0.2em #ff6b6b, 0 0 5px rgba(255, 59, 59, 0.5);
            }
            100% {
                box-shadow: inset 0.2em 0.2em #ff6b6b, 0 0 25px rgba(255, 59, 59, 0.9);
            }
        }
        
        .tv::after {
            content: "";
            position: absolute;
            width: 17em;
            height: 9em;
            border-radius: 15px;
            background:
                repeating-radial-gradient(#cc2f2f 0 0.0001%, #00000070 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#cc2f2f 0 0.0001%, #00000070 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            opacity: 0.09;
        }
        
        .curve_svg {
            position: absolute;
            margin-top: 0.25em;
            margin-left: -0.25em;
            height: 12px;
            width: 12px;
        }
        
        .display_div {
            display: flex;
            align-items: center;
            align-self: center;
            justify-content: center;
            border-radius: 15px;
            box-shadow: 3.5px 3.5px 0px #ff6b6b;
        }
        
        .screen_out {
            width: auto;
            height: auto;
            border-radius: 10px;
        }
        
        .screen_out1 {
            width: 11em;
            height: 7.75em;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }
        
        .screen {
            width: 13em;
            height: 7.85em;
            font-family: 'Courier New', monospace;
            border: 2px solid #1d0101;
            background:
                repeating-radial-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            animation: b 0.1s infinite alternate;
            border-radius: 10px;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ff6b6b;
            letter-spacing: 0.1em;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .screen::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(transparent 50%, rgba(255, 107, 107, 0.2) 50%);
            background-size: 100% 4px;
            z-index: 1;
            pointer-events: none;
        }
        
        .screenM {
            width: 13em;
            height: 7.85em;
            position: relative;
            font-family: 'Courier New', monospace;
            background: linear-gradient(
                to right,
                #8b0000 0%,
                #700000 14.2857142857%,
                #2a2a2a 14.2857142857%,
                #202020 28.5714285714%,
                #8b0000 28.5714285714%,
                #700000 42.8571428571%,
                #4c4c4c 42.8571428571%,
                #424242 57.1428571429%,
                #8b0000 57.1428571429%,
                #700000 71.4285714286%,
                #2a2a2a 71.4285714286%,
                #202020 85.7142857143%,
                #8b0000 85.7142857143%,
                #700000 100%
            );
            border-radius: 10px;
            border: 2px solid black;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ff6b6b;
            letter-spacing: 0.1em;
            text-align: center;
            overflow: hidden;
            animation: error-flicker 1s infinite;
        }
        
        @keyframes error-flicker {
            0%, 12%, 15%, 18%, 22%, 25%, 28%, 32%, 35%, 38%, 42%, 45%, 48%, 52%, 55%, 58%, 62%, 65%, 68%, 72%, 75%, 78%, 82%, 85%, 88%, 92%, 95%, 98%, 100% {
                opacity: 1;
            }
            13%, 16%, 19%, 23%, 26%, 29%, 33%, 36%, 39%, 43%, 46%, 49%, 53%, 56%, 59%, 63%, 66%, 69%, 73%, 76%, 79%, 83%, 86%, 89%, 93%, 96%, 99% {
                opacity: 0.6;
            }
        }
        
        .screenM:before,
        .screenM:after {
            content: "";
            position: absolute;
            left: 0;
            z-index: 1;
            width: 100%;
        }
        
        .screenM:before {
            top: 0;
            height: 68.4782608696%;
            background: linear-gradient(
                to right,
                #8b0000 0%,
                #700000 14.2857142857%,
                #2a2a2a 14.2857142857%,
                #202020 28.5714285714%,
                #8b0000 28.5714285714%,
                #700000 42.8571428571%,
                #4c4c4c 42.8571428571%,
                #424242 57.1428571429%,
                #8b0000 57.1428571429%,
                #700000 71.4285714286%,
                #2a2a2a 71.4285714286%,
                #202020 85.7142857143%,
                #8b0000 85.7142857143%,
                #700000 100%
            );
        }
        
        .screenM:after {
            bottom: 0;
            height: 21.7391304348%;
            background: linear-gradient(
                to right,
                #4c0000 0%,
                #3d0000 16.6666666667%,
                #8b0000 16.6666666667%,
                #700000 33.3333333333%,
                #750000 33.3333333333%,
                #610000 50%,
                #4c4c4c 50%,
                #424242 66.6666666667%,
                #8b0000 66.6666666667%,
                #700000 83.3333333333%,
                #2a2a2a 83.3333333333%,
                #202020 100%
            );
        }
        
        @keyframes b {
            100% {
                background-position:
                    50% 0,
                    60% 50%;
            }
        }
        
        .lines {
            display: flex;
            column-gap: 0.1em;
            align-self: flex-end;
        }
        
        .line1,
        .line3 {
            width: 2px;
            height: 0.5em;
            background-color: black;
            border-radius: 25px 25px 0px 0px;
            margin-top: 0.5em;
        }
        
        .line2 {
            flex-grow: 1;
            width: 2px;
            height: 1em;
            background-color: black;
            border-radius: 25px 25px 0px 0px;
        }
        
        .buttons_div {
            width: 4.25em;
            align-self: center;
            height: 8em;
            background-color: #ff6b6b;
            border: 2px solid #1d0101;
            padding: 0.6em;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            row-gap: 0.75em;
            box-shadow: 3px 3px 0px #ff6b6b;
        }
        
        .b1 {
            width: 1.65em;
            height: 1.65em;
            border-radius: 50%;
            background-color: #a83a34;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #ff9d9d,
                -2px 0px #702521,
                -2px 0px 0px 1px black;
        }
        
        .b1::before {
            content: "";
            position: absolute;
            margin-top: 1em;
            margin-left: 0.5em;
            transform: rotate(47deg);
            border-radius: 5px;
            width: 0.1em;
            height: 0.4em;
            background-color: #000000;
        }
        
        .b1::after {
            content: "";
            position: absolute;
            margin-top: 0.9em;
            margin-left: 0.8em;
            transform: rotate(47deg);
            border-radius: 5px;
            width: 0.1em;
            height: 0.55em;
            background-color: #000000;
        }
        
        .b1 div {
            content: "";
            position: absolute;
            margin-top: -0.1em;
            margin-left: 0.65em;
            transform: rotate(45deg);
            width: 0.15em;
            height: 1.5em;
            background-color: #000000;
        }
        
        .b2 {
            width: 1.65em;
            height: 1.65em;
            border-radius: 50%;
            background-color: #a83a34;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #ff9d9d,
                -2px 0px #702521,
                -2px 0px 0px 1px black;
        }
        
        .b2::before {
            content: "";
            position: absolute;
            margin-top: 1.05em;
            margin-left: 0.8em;
            transform: rotate(-45deg);
            border-radius: 5px;
            width: 0.15em;
            height: 0.4em;
            background-color: #000000;
        }
        
        .b2::after {
            content: "";
            position: absolute;
            margin-top: -0.1em;
            margin-left: 0.65em;
            transform: rotate(-45deg);
            width: 0.15em;
            height: 1.5em;
            background-color: #000000;
        }
        
        .speakers {
            display: flex;
            flex-direction: column;
            row-gap: 0.5em;
        }
        
        .speakers .g1 {
            display: flex;
            column-gap: 0.25em;
        }
        
        .speakers .g1 .g11,
        .g12,
        .g13 {
            width: 0.65em;
            height: 0.65em;
            border-radius: 50%;
            background-color: #a83a34;
            border: 2px solid black;
            box-shadow: inset 1.25px 1.25px 1px #ff9d9d;
        }
        
        .speakers .g {
            width: auto;
            height: 2px;
            background-color: #171717;
        }
        
        .bottom {
            width: 100%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 8.7em;
        }
        
        .base1 {
            height: 1em;
            width: 2em;
            border: 2px solid #171717;
            background-color: #4d4d4d;
            margin-top: -0.15em;
            z-index: -1;
        }
        
        .base2 {
            height: 1em;
            width: 2em;
            border: 2px solid #171717;
            background-color: #4d4d4d;
            margin-top: -0.15em;
            z-index: -1;
        }
        
        .base3 {
            position: absolute;
            height: 0.15em;
            width: 17.5em;
            background-color: #171717;
            margin-top: 0.8em;
        }
        
        .actions {
            display: flex;
            justify-content: center;
        }
        
        .action-btn {
            background-color: #ff3b3b;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            font-size: 1rem;
        }
        
        .action-btn:hover {
            background-color: #ff6b6b;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }
        
        .action-btn:active {
            transform: translateY(0);
        }
        
        @media only screen and (max-width: 1024px) {
            .screenM {
                display: flex;
            }
            .screen {
                display: none;
            }
        }
        
        @media only screen and (min-width: 1025px) {
            .screen {
                display: flex;
            }
            .screenM {
                display: none;
            }
        }

        @media only screen and (max-width: 768px) {
            .main_wrapper {
                transform: scale(0.7);
                margin: -1rem 0;
            }
            
            .header h1 {
                font-size: 1.75rem;
            }
            
            .header p {
                font-size: 0.9rem;
            }
            
            .error-code {
                font-size: 3.5rem;
            }
            
            .action-btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        @media only screen and (max-width: 480px) {
            .main_wrapper {
                transform: scale(0.6);
                margin: -2rem 0;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
            
            .header p {
                font-size: 0.85rem;
            }
            
            .error-code {
                font-size: 3rem;
            }
            
            .action-btn {
                padding: 0.5rem 1.2rem;
                font-size: 0.85rem;
            }
        }
        
        @media only screen and (max-width: 395px) {
            .main_wrapper {
                transform: scale(0.5);
                margin: -3rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="page-center">
        <div class="header">
            <div class="error-code">400</div>
            <h1>BAD REQUEST ERROR</h1>
            <p>Permintaan ke server ditolak karena format, data, atau parameter yang dikirim tidak valid atau tidak sesuai dengan yang diharapkan server.</p>
        </div>
        
        <div class="main_wrapper">
            <div class="main">
                <div class="antenna">
                    <div class="antenna_shadow"></div>
                    <div class="a1"></div>
                    <div class="a1d"></div>
                    <div class="a2"></div>
                    <div class="a2d"></div>
                    <div class="a_base"></div>
                </div>
                <div class="tv">
                    <div class="cruve">
                        <svg
                            class="curve_svg"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 189.929 189.929"
                            xml:space="preserve"
                        >
                            <path
                                d="M70.343,70.343c-30.554,30.553-44.806,72.7-39.102,115.635l-29.738,3.951C-5.442,137.659,11.917,86.34,49.129,49.13
                            C86.34,11.918,137.664-5.445,189.928,1.502l-3.95,29.738C143.041,25.54,100.895,39.789,70.343,70.343z"
                            ></path>
                        </svg>
                    </div>
                    <div class="display_div">
                        <div class="screen_out">
                            <div class="screen_out1">
                                <div class="screen">
                                    <span class="error_text">ERROR 400 - BAD REQUEST</span>
                                </div>
                                <div class="screenM">
                                    <span class="error_text_mobile">ERROR 400</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lines">
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="line3"></div>
                    </div>
                    <div class="buttons_div">
                        <div class="b1"><div></div></div>
                        <div class="b2"></div>
                        <div class="speakers">
                            <div class="g1">
                                <div class="g11"></div>
                                <div class="g12"></div>
                                <div class="g13"></div>
                            </div>
                            <div class="g"></div>
                            <div class="g"></div>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="base1"></div>
                    <div class="base2"></div>
                    <div class="base3"></div>
                </div>
            </div>
        </div>
        
        <div class="actions">
            <button class="action-btn" onclick="window.location.href='/'">Back to Home</button>
        </div>
    </div>
</body>
</html>