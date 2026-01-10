<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 504 - Gateway Timeout</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            overflow-x: hidden;
        }

        /* Wrapper utama untuk semua konten */
        .page-center {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translateY(-20px);
            padding: 0 15px;
            box-sizing: border-box;
        }

        /* Container untuk header */
        .header-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 0.8rem;
        }

        .header {
            text-align: center;
            max-width: 600px;
            padding: 0 15px;
            width: 100%;
        }

        .header h1 {
            font-size: 1.6rem;
            margin-bottom: 0.2rem;
            color: #9c27b0;
            text-shadow: 0 0 10px rgba(156, 39, 176, 0.5);
        }

        .error-code {
            font-size: 3rem;
            font-weight: bold;
            color: #9c27b0;
            margin-bottom: 0.2rem;
            text-shadow: 0 0 20px rgba(156, 39, 176, 0.7);
            position: relative;
            display: inline-block;
            animation: timeout-pulse 3s infinite;
        }

        @keyframes timeout-pulse {
            0%, 100% { 
                transform: scale(1);
                color: #9c27b0;
            }
            25% { 
                transform: scale(1.05);
                color: #ba68c8;
            }
            50% { 
                transform: scale(1);
                color: #7b1fa2;
            }
            75% { 
                transform: scale(1.03);
                color: #ce93d8;
            }
        }

        .error-code::after {
            content: "⏱️";
            position: absolute;
            font-size: 1.5rem;
            top: 50%;
            right: -30px;
            transform: translateY(-50%);
            animation: timer-spin 4s infinite;
        }

        @keyframes timer-spin {
            0%, 100% { transform: translateY(-50%) rotate(0deg); }
            25% { transform: translateY(-50%) rotate(90deg); }
            50% { transform: translateY(-50%) rotate(180deg); }
            75% { transform: translateY(-50%) rotate(270deg); }
        }

        .header p {
            font-size: 0.9rem;
            line-height: 1.3;
            color: #ccc;
            margin: 0.2rem 0;
        }

        .timeout-info {
            background-color: rgba(156, 39, 176, 0.1);
            border-left: 3px solid #9c27b0;
            padding: 0.5rem;
            margin-top: 0.4rem;
            border-radius: 4px;
            text-align: left;
            font-size: 0.8rem;
        }

        .timeout-info strong {
            color: #ba68c8;
            display: block;
            margin-bottom: 0.15rem;
        }

        .timeout-info ul {
            margin: 0.15rem 0;
            padding-left: 0.8rem;
        }

        .timeout-info li {
            margin-bottom: 0.05rem;
            color: #ddd;
            font-size: 0.8rem;
        }

        /* Kontainer untuk TV dan konten tengah */
        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: relative;
            padding-bottom: 1rem;
        }

        .main_wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 350px;
            height: auto;
            position: relative;
            margin: 0.5rem auto;
        }

        .timeout-waves {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .timeout-wave {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 2px solid rgba(156, 39, 176, 0.3);
            border-radius: 50%;
            opacity: 0;
        }

        .wave-1 {
            animation: wave-expand 3s infinite;
        }

        .wave-2 {
            animation: wave-expand 3s infinite 1s;
        }

        .wave-3 {
            animation: wave-expand 3s infinite 2s;
        }

        @keyframes wave-expand {
            0% {
                width: 10em;
                height: 10em;
                opacity: 0.8;
            }
            100% {
                width: 25em;
                height: 25em;
                opacity: 0;
            }
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .antenna {
            width: 4em;
            height: 4em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #9c27b0;
            margin-bottom: -5em;
            z-index: 1;
            animation: antenna-timeout 4s infinite;
            position: relative;
        }
        
        @keyframes antenna-timeout {
            0%, 100% { 
                transform: scale(1);
                background-color: #9c27b0;
                box-shadow: 0 0 10px #9c27b0;
            }
            25% { 
                transform: scale(1.1);
                background-color: #ba68c8;
                box-shadow: 0 0 20px #ba68c8;
            }
            50% { 
                transform: scale(0.95);
                background-color: #7b1fa2;
                box-shadow: 0 0 5px #7b1fa2;
            }
            75% { 
                transform: scale(1.05);
                background-color: #ce93d8;
                box-shadow: 0 0 15px #ce93d8;
            }
        }

        .tv {
            width: 15em;
            height: 8em;
            margin-top: 2em;
            border-radius: 12px;
            background-color: #7b1fa2;
            display: flex;
            justify-content: center;
            border: 2px solid #2d0a3d;
            box-shadow: 
                inset 0.2em 0.2em #ba68c8,
                0 0 20px rgba(156, 39, 176, 0.5);
            animation: tv-timeout 3s infinite;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes tv-timeout {
            0%, 100% {
                box-shadow: 
                    inset 0.2em 0.2em #ba68c8,
                    0 0 20px rgba(156, 39, 176, 0.5);
                transform: scale(1);
            }
            33% {
                box-shadow: 
                    inset 0.2em 0.2em #ba68c8,
                    0 0 40px rgba(156, 39, 176, 0.8);
                transform: scale(1.02);
            }
            66% {
                box-shadow: 
                    inset 0.2em 0.2em #ba68c8,
                    0 0 10px rgba(156, 39, 176, 0.3);
                transform: scale(0.98);
            }
        }
        
        .bottom {
            width: 100%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 7em;
            margin-top: -0.1em;
        }
        
        .base3 {
            position: absolute;
            height: 0.15em;
            width: 15.5em;
            background-color: #171717;
            margin-top: 0.7em;
        }

        /* Tombol di bawah TV dengan jarak 10px */
        .back-btn {
            margin: 0.6rem 0 0.3rem;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        
        .back-link {
            background-color: #9c27b0;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-size: 0.85rem;
        }
        
        .back-link:hover {
            background-color: #7b1fa2;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }
        
        /* Responsif untuk mobile kecil */
        @media only screen and (max-width: 480px) {
            .main_wrapper {
                transform: scale(0.75);
                margin: 0.3rem auto;
            }
            
            .back-btn {
                margin-top: 0.3rem;
            }
        }
        
        /* Media Queries lainnya */
        @media only screen and (max-width: 768px) {
            .header h1 {
                font-size: 1.3rem;
                margin-bottom: 0.15rem;
            }
            
            .header p {
                font-size: 0.8rem;
                margin: 0.15rem 0;
                line-height: 1.2;
            }
            
            .error-code {
                font-size: 2.5rem;
                margin-bottom: 0.15rem;
            }
            
            .error-code::after {
                font-size: 1.2rem;
                right: -25px;
            }
            
            .timeout-info {
                padding: 0.4rem;
                margin-top: 0.3rem;
                font-size: 0.75rem;
            }
            
            .timeout-info ul {
                margin: 0.1rem 0;
            }
            
            .timeout-info li {
                font-size: 0.75rem;
            }
            
            .back-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }
        
        @media only screen and (max-width: 495px) {
            .header h1 {
                font-size: 1.1rem;
                margin-bottom: 0.1rem;
            }
            
            .error-code {
                font-size: 2rem;
                margin-bottom: 0.1rem;
            }
            
            .error-code::after {
                font-size: 1rem;
                right: -20px;
            }
            
            .header p {
                font-size: 0.75rem;
                margin: 0.1rem 0;
            }
            
            .back-link {
                padding: 0.35rem 0.7rem;
                font-size: 0.75rem;
                width: 90%;
            }
            
            .timeout-info {
                font-size: 0.7rem;
                padding: 0.3rem;
                margin-top: 0.2rem;
            }
        }
        
        @media only screen and (max-width: 395px) {
            .header h1 {
                font-size: 1rem;
            }
            
            .error-code {
                font-size: 1.8rem;
            }
            
            .error-code::after {
                font-size: 0.9rem;
                right: -15px;
            }
            
            .back-link {
                font-size: 0.7rem;
                padding: 0.3rem 0.6rem;
            }
        }
        
        @media only screen and (min-width: 769px) {
            .timeout-waves {
                display: block;
            }
        }
        
        @media only screen and (max-height: 700px) {
            .page-center {
                transform: translateY(-15px);
            }
            
            .main_wrapper {
                transform: scale(0.75);
                margin: 0.3rem auto;
            }
            
            .back-btn {
                margin: 0.3rem 0 0.1rem;
            }
        }
        
        /* CSS untuk elemen TV lainnya */
        .antenna_shadow {
            position: absolute;
            background-color: transparent;
            width: 40px;
            height: 46px;
            margin-left: 1.3em;
            border-radius: 45%;
            transform: rotate(140deg);
            border: 4px solid transparent;
            box-shadow:
                inset 0px 16px #7b1fa2,
                inset 0px 16px 1px 1px #7b1fa2;
        }
        
        .antenna::after {
            content: "⏰";
            position: absolute;
            margin-top: -7.5em;
            margin-left: 0.3em;
            transform: rotate(-25deg);
            width: 0.8em;
            height: 0.4em;
            border-radius: 50%;
            color: #ba68c8;
            font-size: 1.2em;
            animation: timeout-alarm 3s infinite;
        }
        
        .antenna::before {
            content: "⏰";
            position: absolute;
            margin-top: 0.2em;
            margin-left: 1em;
            transform: rotate(-20deg);
            width: 1.2em;
            height: 0.6em;
            border-radius: 50%;
            color: #ba68c8;
            font-size: 1.5em;
            animation: timeout-alarm 3s infinite 1.5s;
        }

        @keyframes timeout-alarm {
            0%, 100% { opacity: 1; transform: rotate(-25deg) scale(1); }
            50% { opacity: 0.7; transform: rotate(-25deg) scale(1.3); }
        }
        
        .a1 {
            position: relative;
            top: -102%;
            left: -130%;
            width: 10em;
            height: 4.5em;
            border-radius: 50px;
            transform: rotate(-29deg);
            clip-path: polygon(50% 0%, 49% 100%, 52% 100%);
            animation: a1-timeout 5s infinite;
        }

        @keyframes a1-timeout {
            0%, 100% { 
                transform: rotate(-29deg);
                opacity: 1;
            }
            33% { 
                transform: rotate(-28deg);
                opacity: 0.8;
            }
            66% { 
                transform: rotate(-30deg);
                opacity: 0.6;
            }
        }
        
        .a1d {
            position: relative;
            top: -211%;
            left: -35%;
            transform: rotate(45deg);
            width: 0.4em;
            height: 0.4em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #979797;
            z-index: 99;
        }
        
        .a2 {
            position: relative;
            top: -210%;
            left: -10%;
            width: 10em;
            height: 3.2em;
            border-radius: 50px;
            background-color: #171717;
            margin-right: 4.5em;
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
            animation: a2-timeout 4s infinite;
        }

        @keyframes a2-timeout {
            0%, 100% { transform: rotate(-8deg); }
            50% { transform: rotate(-7deg); }
        }
        
        .a2d {
            position: relative;
            top: -294%;
            left: 94%;
            width: 0.4em;
            height: 0.4em;
            border-radius: 50%;
            border: 2px solid black;
            background-color: #979797;
            z-index: 99;
        }

        .error_text {
            background-color: #7b1fa2;
            padding: 0.2em 0.35em;
            font-size: 0.55em;
            color: white;
            letter-spacing: 0.08em;
            border-radius: 4px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ba68c8;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            animation: timeout-text 3s infinite;
        }

        .error_text_mobile {
            background-color: #7b1fa2;
            padding: 0.2em 0.35em;
            font-size: 0.4em;
            color: white;
            letter-spacing: 0.08em;
            border-radius: 4px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ba68c8;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        
        .tv::before {
            content: "⏳";
            position: absolute;
            font-size: 3rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.15;
            z-index: 0;
            animation: sandglass-animation 5s infinite;
        }

        @keyframes sandglass-animation {
            0%, 100% { 
                transform: translate(-50%, -50%) rotate(0deg);
                opacity: 0.1;
            }
            25% { 
                transform: translate(-50%, -50%) rotate(90deg);
                opacity: 0.2;
            }
            50% { 
                transform: translate(-50%, -50%) rotate(180deg);
                opacity: 0.15;
            }
            75% { 
                transform: translate(-50%, -50%) rotate(270deg);
                opacity: 0.2;
            }
        }
        
        .tv::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background:
                repeating-radial-gradient(#7b1fa2 0 0.0001%, #00000070 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#7b1fa2 0 0.0001%, #00000070 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            opacity: 0.09;
            animation: timeout-static 2s infinite;
        }

        @keyframes timeout-static {
            0%, 100% { opacity: 0.09; }
            50% { opacity: 0.15; }
        }
        
        .curve_svg {
            position: absolute;
            margin-top: 0.2em;
            margin-left: -0.2em;
            height: 10px;
            width: 10px;
        }
        
        .display_div {
            display: flex;
            align-items: center;
            align-self: center;
            justify-content: center;
            border-radius: 12px;
            box-shadow: 3px 3px 0px #ba68c8;
            z-index: 1;
            animation: display-timeout 2.5s infinite;
        }

        @keyframes display-timeout {
            0%, 100% { box-shadow: 3px 3px 0px #ba68c8; }
            50% { box-shadow: 3px 3px 0px #ce93d8; }
        }
        
        .screen_out {
            width: auto;
            height: auto;
            border-radius: 8px;
        }
        
        .screen_out1 {
            width: 9.5em;
            height: 6.5em;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        .screen {
            width: 11.5em;
            height: 6.6em;
            font-family: 'Courier New', monospace;
            border: 2px solid #2d0a3d;
            background:
                repeating-radial-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            animation: b 0.1s infinite alternate, screen-timeout 4s infinite;
            border-radius: 8px;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #9c27b0;
            letter-spacing: 0.08em;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        @keyframes screen-timeout {
            0%, 100% { 
                filter: brightness(1);
                color: #9c27b0;
            }
            50% { 
                filter: brightness(1.3);
                color: #ba68c8;
            }
        }
        
        .screen::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(transparent 50%, rgba(186, 104, 200, 0.2) 50%);
            background-size: 100% 3px;
            z-index: 1;
            pointer-events: none;
            animation: timeout-scanline 3s infinite;
        }

        .screenM {
            width: 11.5em;
            height: 6.6em;
            position: relative;
            font-family: 'Courier New', monospace;
            border-radius: 8px;
            border: 2px solid black;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #9c27b0;
            letter-spacing: 0.08em;
            text-align: center;
            overflow: hidden;
            animation: mobile-timeout 2s infinite;
        }

        .lines {
            display: flex;
            column-gap: 0.08em;
            align-self: flex-end;
        }
        
        .line1,
        .line3 {
            width: 2px;
            height: 0.4em;
            background-color: black;
            border-radius: 20px 20px 0px 0px;
            margin-top: 0.4em;
        }
        
        .line2 {
            flex-grow: 1;
            width: 2px;
            height: 0.8em;
            background-color: black;
            border-radius: 20px 20px 0px 0px;
        }
        
        .buttons_div {
            width: 3.5em;
            align-self: center;
            height: 6.8em;
            background-color: #ba68c8;
            border: 2px solid #2d0a3d;
            padding: 0.4em;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            row-gap: 0.5em;
            box-shadow: 2px 2px 0px #ba68c8;
            position: relative;
            animation: buttons-timeout 3s infinite;
        }
        
        .buttons_div::before {
            content: "⏳";
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1rem;
            animation: sandglass-pulse 2s infinite;
        }
        
        .b1, .b2 {
            width: 1.3em;
            height: 1.3em;
            border-radius: 50%;
            background-color: #7b1fa2;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #e1bee7,
                -2px 0px #6a1b9a,
                -2px 0px 0px 1px black;
            animation: button-timeout 2s infinite;
            position: relative;
        }
        
        .b1::before {
            content: "⏱";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.7em;
            font-weight: bold;
        }
        
        .b2::before {
            content: "⏰";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.7em;
            font-weight: bold;
        }
        
        .base1, .base2 {
            height: 0.8em;
            width: 1.6em;
            border: 2px solid #171717;
            background-color: #4d4d4d;
            margin-top: -0.1em;
            z-index: -1;
        }
        
        @media only screen and (min-width: 1025px) {
            .screen {
                display: flex;
            }
            .screenM {
                display: none;
            }
        }
        
        @media only screen and (max-width: 1024px) {
            .screenM {
                display: flex;
            }
            .screen {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Wrapper baru untuk semua konten -->
    <div class="page-center">
        <!-- Container header -->
        <div class="header-container">
            <div class="header">
                <div class="error-code">504</div>
                <h1>GATEWAY TIMEOUT</h1>
                <p>Gateway server tidak menerima respons tepat waktu dari server upstream. Permintaan Anda telah melebihi batas waktu yang ditentukan.</p>
                
                <div class="timeout-info">
                    <strong>⏱️ Penyebab Timeout:</strong>
                    <ul>
                        <li>Server upstream terlalu lambat merespons</li>
                        <li>Jaringan antara gateway dan server bermasalah</li>
                        <li>Server upstream sedang overload</li>
                        <li>Konfigurasi timeout gateway terlalu singkat</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Kontainer untuk TV dan tombol -->
        <div class="content-container">
            <div class="main_wrapper">
                <div class="timeout-waves">
                    <div class="timeout-wave wave-1"></div>
                    <div class="timeout-wave wave-2"></div>
                    <div class="timeout-wave wave-3"></div>
                </div>
                <div class="main">
                    <div class="antenna">
                        <div class="antenna_shadow"></div>
                        <div class="a1"></div>
                        <div class="a1d"></div>
                        <div class="a2"></div>
                        <div class="a2d"></div>
                    </div>
                    <div class="tv">
                        <div class="cruve">
                            <svg class="curve_svg" viewBox="0 0 189.929 189.929">
                                <path d="M70.343,70.343c-30.554,30.553-44.806,72.7-39.102,115.635l-29.738,3.951C-5.442,137.659,11.917,86.34,49.129,49.13
                                C86.34,11.918,137.664-5.445,189.928,1.502l-3.95,29.738C143.041,25.54,100.895,39.789,70.343,70.343z"></path>
                            </svg>
                        </div>
                        <div class="display_div">
                            <div class="screen_out">
                                <div class="screen_out1">
                                    <div class="screen">
                                        <span class="error_text">GATEWAY TIMEOUT - ERROR 504</span>
                                    </div>
                                    <div class="screenM">
                                        <span class="error_text_mobile">TIMEOUT</span>
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
                            <div class="b1"></div>
                            <div class="b2"></div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="base1"></div>
                        <div class="base2"></div>
                        <div class="base3"></div>
                    </div>
                </div>
            </div>
            
            <!-- Tombol dengan jarak 10px dari TV -->
            <div class="back-btn">
                <a href="/" class="back-link">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tv = document.querySelector('.tv');
            
            tv.addEventListener('click', function() {
                const timeoutMessages = [
                    "WAITING FOR RESPONSE...",
                    "UPSTREAM TIMEOUT",
                    "GATEWAY WAITING...",
                    "RESPONSE DELAYED"
                ];
                const randomMessage = timeoutMessages[Math.floor(Math.random() * timeoutMessages.length)];
                
                const timeoutMsg = document.createElement('div');
                timeoutMsg.textContent = randomMessage;
                timeoutMsg.style.cssText = `
                    position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    background: linear-gradient(135deg, #9c27b0, #7b1fa2); color: white;
                    padding: 0.8rem 1.5rem; border-radius: 5px; font-weight: bold;
                    z-index: 1000; box-shadow: 0 0 30px rgba(156, 39, 176, 0.8);
                    animation: timeoutPulse 2s forwards;
                `;
                
                document.body.appendChild(timeoutMsg);
                
                for (let i = 0; i < 3; i++) {
                    setTimeout(() => {
                        const newWave = document.createElement('div');
                        newWave.className = 'timeout-wave';
                        newWave.style.animation = `wave-expand 3s ${i}s`;
                        document.querySelector('.timeout-waves').appendChild(newWave);
                        
                        setTimeout(() => {
                            document.querySelector('.timeout-waves').removeChild(newWave);
                        }, 3000);
                    }, i * 500);
                }
                
                setTimeout(() => {
                    document.body.removeChild(timeoutMsg);
                }, 2000);
            });
        });
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes timeoutPulse {
                0% { 
                    transform: translate(-50%, -50%) scale(0.8); 
                    opacity: 0;
                }
                50% { 
                    transform: translate(-50%, -50%) scale(1.2); 
                    opacity: 1;
                }
                100% { 
                    transform: translate(-50%, -50%) scale(1); 
                    opacity: 1;
                }
            }
            @keyframes sandglass-pulse {
                0%, 100% { transform: translateX(-50%) scale(1); opacity: 1; }
                50% { transform: translateX(-50%) scale(1.3); opacity: 0.7; }
            }
            @keyframes button-timeout {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
            @keyframes buttons-timeout {
                0%, 100% { box-shadow: 2px 2px 0px #ba68c8; }
                50% { box-shadow: 2px 2px 0px #ce93d8; }
            }
            @keyframes timeout-text {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
            }
            @keyframes timeout-scanline {
                0% { transform: translateY(0); }
                100% { transform: translateY(6.6em); }
            }
            @keyframes mobile-timeout {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.9; }
            }
            @keyframes b {
                100% {
                    background-position: 50% 0, 60% 50%;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>