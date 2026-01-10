<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 502 - Bad Gateway</title>
    <style>
        body {
            margin: 0;
            padding: 10px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            overflow-x: hidden;
        }

        .header {
            text-align: center;
            margin-bottom: 1rem;
            max-width: 600px;
            padding: 0 20px;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #ffa726;
            text-shadow: 0 0 10px rgba(255, 167, 38, 0.5);
        }

        .error-code {
            font-size: 4rem;
            font-weight: bold;
            color: #ffa726;
            margin-bottom: 0.25rem;
            text-shadow: 0 0 15px rgba(255, 167, 38, 0.7);
            animation: gateway-pulse 2s infinite;
        }

        @keyframes gateway-pulse {
            0%, 100% { 
                transform: scale(1);
                color: #ffa726;
            }
            33% { 
                transform: scale(1.05);
                color: #ffcc80;
            }
            66% { 
                transform: scale(1.03);
                color: #ffb74d;
            }
        }

        .header p {
            font-size: 1rem;
            line-height: 1.4;
            color: #ccc;
            margin: 0.5rem 0;
        }

        .gateway-info {
            background-color: rgba(255, 167, 38, 0.1);
            border-left: 4px solid #ffa726;
            padding: 0.8rem;
            margin-top: 1rem;
            border-radius: 4px;
            text-align: left;
            font-size: 0.9rem;
        }

        .gateway-info ul {
            margin: 0.5rem 0;
            padding-left: 1.2rem;
        }

        .gateway-info li {
            margin-bottom: 0.3rem;
        }

        .main_wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25em;
            height: 25em;
            margin: 0.5rem 0;
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 2em;
        }

        .antenna {
            width: 5em;
            height: 5em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #ffa726;
            margin-bottom: -6em;
            margin-left: 0em;
            z-index: 1;
            animation: antenna-connection 3s infinite;
        }
        
        @keyframes antenna-connection {
            0%, 100% { 
                transform: scale(1);
                background-color: #ffa726;
            }
            33% { 
                transform: scale(1.1);
                background-color: #ffcc80;
            }
            66% { 
                transform: scale(0.95);
                background-color: #ff9800;
            }
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
                inset 0px 16px #ff9800,
                inset 0px 16px 1px 1px #ff9800;
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
            background-color: #ffcc80;
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
            background-color: #ffcc80;
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
            background-color: #ef6c00;
            padding: 0.3em 0.5em;
            font-size: 0.65em;
            color: white;
            letter-spacing: 0.1em;
            border-radius: 5px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ffcc80;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            animation: gateway-text 3s infinite;
        }

        @keyframes gateway-text {
            0%, 100% {
                transform: translate(0);
                background-color: #ef6c00;
            }
            33% {
                transform: translate(1px, 0);
                background-color: #ff9800;
            }
            66% {
                transform: translate(-1px, 0);
                background-color: #f57c00;
            }
        }

        .error_text_mobile {
            background-color: #ef6c00;
            padding: 0.3em 0.5em;
            font-size: 0.5em;
            color: white;
            letter-spacing: 0.1em;
            border-radius: 5px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ffcc80;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        
        .tv {
            width: 17em;
            height: 9em;
            margin-top: 3em;
            border-radius: 15px;
            background-color: #ff9800;
            display: flex;
            justify-content: center;
            border: 2px solid #331800;
            box-shadow: 
                inset 0.2em 0.2em #ffcc80,
                0 0 20px rgba(255, 167, 38, 0.5);
            animation: tv-gateway 3s infinite;
        }
        
        @keyframes tv-gateway {
            0%, 100% {
                box-shadow: 
                    inset 0.2em 0.2em #ffcc80,
                    0 0 20px rgba(255, 167, 38, 0.5);
                transform: scale(1);
            }
            33% {
                box-shadow: 
                    inset 0.2em 0.2em #ffcc80,
                    0 0 40px rgba(255, 167, 38, 0.8);
                transform: scale(1.02);
            }
            66% {
                box-shadow: 
                    inset 0.2em 0.2em #ffcc80,
                    0 0 10px rgba(255, 167, 38, 0.3);
                transform: scale(0.98);
            }
        }
        
        .tv::after {
            content: "";
            position: absolute;
            width: 17em;
            height: 9em;
            border-radius: 15px;
            background:
                repeating-radial-gradient(#ff9800 0 0.0001%, #00000070 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#ff9800 0 0.0001%, #00000070 0 0.0002%) 60% 60%/2500px
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
            box-shadow: 3.5px 3.5px 0px #ffcc80;
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
            border: 2px solid #331800;
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
            color: #ffa726;
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
            background: linear-gradient(transparent 50%, rgba(255, 204, 128, 0.2) 50%);
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
                #ef6c00 0%,
                #e65100 14.2857142857%,
                #2a2a2a 14.2857142857%,
                #202020 28.5714285714%,
                #ef6c00 28.5714285714%,
                #e65100 42.8571428571%,
                #4c4c4c 42.8571428571%,
                #424242 57.1428571429%,
                #ef6c00 57.1428571429%,
                #e65100 71.4285714286%,
                #2a2a2a 71.4285714286%,
                #202020 85.7142857143%,
                #ef6c00 85.7142857143%,
                #e65100 100%
            );
            border-radius: 10px;
            border: 2px solid black;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffa726;
            letter-spacing: 0.1em;
            text-align: center;
            overflow: hidden;
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
                #ef6c00 0%,
                #e65100 14.2857142857%,
                #2a2a2a 14.2857142857%,
                #202020 28.5714285714%,
                #ef6c00 28.5714285714%,
                #e65100 42.8571428571%,
                #4c4c4c 42.8571428571%,
                #424242 57.1428571429%,
                #ef6c00 57.1428571429%,
                #e65100 71.4285714286%,
                #2a2a2a 71.4285714286%,
                #202020 85.7142857143%,
                #ef6c00 85.7142857143%,
                #e65100 100%
            );
        }
        
        .screenM:after {
            bottom: 0;
            height: 21.7391304348%;
            background: linear-gradient(
                to right,
                #b53d00 0%,
                #9c3500 16.6666666667%,
                #ef6c00 16.6666666667%,
                #e65100 33.3333333333%,
                #994200 33.3333333333%,
                #803600 50%,
                #4c4c4c 50%,
                #424242 66.6666666667%,
                #ef6c00 66.6666666667%,
                #e65100 83.3333333333%,
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
            background-color: #ffcc80;
            border: 2px solid #331800;
            padding: 0.6em;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            row-gap: 0.75em;
            box-shadow: 3px 3px 0px #ffcc80;
        }
        
        .b1 {
            width: 1.65em;
            height: 1.65em;
            border-radius: 50%;
            background-color: #ff9800;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #ffe0b2,
                -2px 0px #ef6c00,
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
            background-color: #ff9800;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #ffe0b2,
                -2px 0px #ef6c00,
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
            background-color: #ff9800;
            border: 2px solid black;
            box-shadow: inset 1.25px 1.25px 1px #ffe0b2;
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
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }
        
        .action-btn {
            background-color: #ffa726;
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
            background-color: #ffcc80;
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
            
            .gateway-info {
                font-size: 0.85rem;
                padding: 0.6rem;
            }
            
            .action-btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        @media only screen and (max-width: 495px) {
            .main_wrapper {
                transform: scale(0.6);
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
            
            .gateway-info {
                font-size: 0.8rem;
                padding: 0.5rem;
            }
            
            .action-btn {
                padding: 0.5rem 1.2rem;
                font-size: 0.85rem;
            }
        }
        
        @media only screen and (max-width: 395px) {
            .main_wrapper {
                transform: scale(0.5);
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="error-code">502</div>
        <h1>BAD GATEWAY ERROR</h1>
        <p>Gateway atau server perantara mengalami masalah saat meneruskan permintaan Anda ke server upstream.</p>
        
        <div class="gateway-info">
            <strong>🚧 Kemungkinan Penyebab:</strong>
            <ul>
                <li>Server upstream sedang maintenance</li>
                <li>Masalah koneksi antara gateway dan server</li>
                <li>Timeout saat menghubungi server backend</li>
                <li>Konfigurasi gateway yang salah</li>
                <li>Server backend tidak merespons</li>
            </ul>
        </div>
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
                                <span class="error_text">ERROR 502 - BAD GATEWAY</span>
                            </div>
                            <div class="screenM">
                                <span class="error_text_mobile">ERROR 502</span>
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
        <button class="action-btn" onclick="window.location.href='/'">Kembali ke Beranda</button>
    </div>
</body>
</html>