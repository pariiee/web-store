<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 401 - Tidak Diizinkan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a2e2e 0%, #163e3e 100%);
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
            color: #ffa500;
            text-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
        }

        .error-code {
            font-size: 3rem;
            font-weight: bold;
            color: #ffa500;
            margin-bottom: 0.2rem;
            text-shadow: 0 0 20px rgba(255, 165, 0, 0.7);
            position: relative;
            display: inline-block;
            animation: code-pulse 3s infinite;
        }

        @keyframes code-pulse {
            0%, 100% { 
                transform: scale(1);
                color: #ffa500;
            }
            25% { 
                transform: scale(1.05);
                color: #ffc966;
            }
            50% { 
                transform: scale(1);
                color: #ffb347;
            }
            75% { 
                transform: scale(1.03);
                color: #ffd8a6;
            }
        }

        .error-code::after {
            content: "🔒";
            position: absolute;
            font-size: 1.5rem;
            top: 50%;
            right: -30px;
            transform: translateY(-50%);
            animation: lock-shake 4s infinite;
        }

        @keyframes lock-shake {
            0%, 100% { transform: translateY(-50%) rotate(0deg); }
            25% { transform: translateY(-50%) rotate(-5deg); }
            50% { transform: translateY(-50%) rotate(5deg); }
            75% { transform: translateY(-50%) rotate(-3deg); }
        }

        .header p {
            font-size: 0.9rem;
            line-height: 1.3;
            color: #ccc;
            margin: 0.2rem 0;
        }

        .auth-info {
            background-color: rgba(255, 165, 0, 0.1);
            border-left: 3px solid #ffa500;
            padding: 0.5rem;
            margin-top: 0.4rem;
            border-radius: 4px;
            text-align: left;
            font-size: 0.8rem;
        }

        .auth-info strong {
            color: #ffc966;
            display: block;
            margin-bottom: 0.15rem;
        }

        .auth-info ul {
            margin: 0.15rem 0;
            padding-left: 0.8rem;
        }

        .auth-info li {
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
            background-color: #ffa500;
            margin-bottom: -5em;
            z-index: 1;
            animation: antenna-auth 4s infinite;
            position: relative;
        }
        
        @keyframes antenna-auth {
            0%, 100% { 
                transform: scale(1);
                background-color: #ffa500;
                box-shadow: 0 0 10px #ffa500;
            }
            25% { 
                transform: scale(1.1);
                background-color: #ffc966;
                box-shadow: 0 0 20px #ffc966;
            }
            50% { 
                transform: scale(0.95);
                background-color: #ffb347;
                box-shadow: 0 0 5px #ffb347;
            }
            75% { 
                transform: scale(1.05);
                background-color: #ffd8a6;
                box-shadow: 0 0 15px #ffd8a6;
            }
        }

        .tv {
            width: 15em;
            height: 8em;
            margin-top: 2em;
            border-radius: 12px;
            background-color: #cc8400;
            display: flex;
            justify-content: center;
            border: 2px solid #331800;
            box-shadow: 
                inset 0.2em 0.2em #ffc966,
                0 0 20px rgba(255, 165, 0, 0.5);
            animation: tv-auth 3s infinite;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes tv-auth {
            0%, 100% {
                box-shadow: 
                    inset 0.2em 0.2em #ffc966,
                    0 0 20px rgba(255, 165, 0, 0.5);
                transform: scale(1);
            }
            33% {
                box-shadow: 
                    inset 0.2em 0.2em #ffc966,
                    0 0 40px rgba(255, 165, 0, 0.8);
                transform: scale(1.02);
            }
            66% {
                box-shadow: 
                    inset 0.2em 0.2em #ffc966,
                    0 0 10px rgba(255, 165, 0, 0.3);
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
            background-color: #ffa500;
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
            background-color: #cc8400;
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
            
            .auth-info {
                padding: 0.4rem;
                margin-top: 0.3rem;
                font-size: 0.75rem;
            }
            
            .auth-info ul {
                margin: 0.1rem 0;
            }
            
            .auth-info li {
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
            
            .auth-info {
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
                inset 0px 16px #cc8400,
                inset 0px 16px 1px 1px #cc8400;
        }
        
        .antenna::after {
            content: "✗";
            position: absolute;
            margin-top: -7.5em;
            margin-left: 0.3em;
            transform: rotate(-25deg);
            width: 0.8em;
            height: 0.4em;
            border-radius: 50%;
            color: #ffc966;
            font-size: 1.2em;
            animation: auth-x 3s infinite;
        }
        
        .antenna::before {
            content: "✗";
            position: absolute;
            margin-top: 0.2em;
            margin-left: 1em;
            transform: rotate(-20deg);
            width: 1.2em;
            height: 0.6em;
            border-radius: 50%;
            color: #ffc966;
            font-size: 1.5em;
            animation: auth-x 3s infinite 1.5s;
        }

        @keyframes auth-x {
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
            animation: a1-auth 5s infinite;
        }

        @keyframes a1-auth {
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
            animation: a2-auth 4s infinite;
        }

        @keyframes a2-auth {
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
            background-color: #805300;
            padding: 0.2em 0.35em;
            font-size: 0.55em;
            color: white;
            letter-spacing: 0.08em;
            border-radius: 4px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ffc966;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            animation: auth-text 3s infinite;
        }

        .error_text_mobile {
            background-color: #805300;
            padding: 0.2em 0.35em;
            font-size: 0.4em;
            color: white;
            letter-spacing: 0.08em;
            border-radius: 4px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ffc966;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        
        .tv::before {
            content: "🔒";
            position: absolute;
            font-size: 3rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.15;
            z-index: 0;
            animation: lock-animation 5s infinite;
        }

        @keyframes lock-animation {
            0%, 100% { 
                transform: translate(-50%, -50%) rotate(0deg);
                opacity: 0.1;
            }
            25% { 
                transform: translate(-50%, -50%) rotate(5deg);
                opacity: 0.2;
            }
            50% { 
                transform: translate(-50%, -50%) rotate(0deg);
                opacity: 0.15;
            }
            75% { 
                transform: translate(-50%, -50%) rotate(-5deg);
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
                repeating-radial-gradient(#cc8400 0 0.0001%, #00000070 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#cc8400 0 0.0001%, #00000070 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            opacity: 0.09;
            animation: auth-static 2s infinite;
        }

        @keyframes auth-static {
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
            box-shadow: 3px 3px 0px #ffc966;
            z-index: 1;
            animation: display-auth 2.5s infinite;
        }

        @keyframes display-auth {
            0%, 100% { box-shadow: 3px 3px 0px #ffc966; }
            50% { box-shadow: 3px 3px 0px #ffd8a6; }
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
            border: 2px solid #331800;
            background:
                repeating-radial-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            animation: b 0.1s infinite alternate, screen-auth 4s infinite;
            border-radius: 8px;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffa500;
            letter-spacing: 0.08em;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        @keyframes screen-auth {
            0%, 100% { 
                filter: brightness(1);
                color: #ffa500;
            }
            50% { 
                filter: brightness(1.3);
                color: #ffc966;
            }
        }
        
        .screen::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(transparent 50%, rgba(255, 201, 102, 0.2) 50%);
            background-size: 100% 3px;
            z-index: 1;
            pointer-events: none;
            animation: auth-scanline 3s infinite;
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
            color: #ffa500;
            letter-spacing: 0.08em;
            text-align: center;
            overflow: hidden;
            animation: auth-flicker 2s infinite;
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
            background-color: #ffc966;
            border: 2px solid #331800;
            padding: 0.4em;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            row-gap: 0.5em;
            box-shadow: 2px 2px 0px #ffc966;
            position: relative;
            animation: buttons-auth 3s infinite;
        }
        
        .buttons_div::before {
            content: "⚠️";
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1rem;
            animation: warning-pulse 2s infinite;
        }
        
        .b1, .b2 {
            width: 1.3em;
            height: 1.3em;
            border-radius: 50%;
            background-color: #cc8400;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #ffd8a6,
                -2px 0px #805300,
                -2px 0px 0px 1px black;
            animation: button-auth 2s infinite;
            position: relative;
        }
        
        .b1::before {
            content: "✗";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.8em;
            font-weight: bold;
        }
        
        .b2::before {
            content: "!";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.8em;
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
                <div class="error-code">401</div>
                <h1>AKSES TIDAK DIIZINKAN</h1>
                <p>Anda tidak memiliki izin untuk mengakses sumber daya ini. Autentikasi diperlukan namun gagal atau belum diberikan.</p>
                
                <div class="auth-info">
                    <strong>🔒 Masalah Autentikasi:</strong>
                    <ul>
                        <li>Token akses tidak valid atau kedaluwarsa</li>
                        <li>Sesi login telah berakhir</li>
                        <li>Kredensial yang diberikan tidak mencukupi</li>
                        <li>Izin akses ditolak oleh sistem</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Kontainer untuk TV dan tombol -->
        <div class="content-container">
            <div class="main_wrapper">
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
                                        <span class="error_text">ERROR 401 - UNAUTHORIZED</span>
                                    </div>
                                    <div class="screenM">
                                        <span class="error_text_mobile">UNAUTHORIZED</span>
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
                const messages = ["ACCESS DENIED", "AUTHENTICATION FAILED", "LOGIN REQUIRED", "INVALID CREDENTIALS"];
                const message = messages[Math.floor(Math.random() * messages.length)];
                
                const msg = document.createElement('div');
                msg.textContent = message;
                msg.style.cssText = `
                    position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    background: linear-gradient(135deg, #ffa500, #cc8400); color: white;
                    padding: 0.8rem 1.5rem; border-radius: 5px; font-weight: bold;
                    z-index: 1000; box-shadow: 0 0 30px rgba(255, 165, 0, 0.8);
                    animation: authPulse 2s forwards;
                `;
                
                document.body.appendChild(msg);
                setTimeout(() => msg.remove(), 2000);
            });
        });
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes authPulse {
                0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0; }
                50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
                100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            }
            @keyframes warning-pulse {
                0%, 100% { transform: translateX(-50%) scale(1); opacity: 1; }
                50% { transform: translateX(-50%) scale(1.2); opacity: 0.7; }
            }
            @keyframes button-auth {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
            @keyframes buttons-auth {
                0%, 100% { box-shadow: 2px 2px 0px #ffc966; }
                50% { box-shadow: 2px 2px 0px #ffd8a6; }
            }
            @keyframes auth-text {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
            }
            @keyframes auth-scanline {
                0% { transform: translateY(0); }
                100% { transform: translateY(6.6em); }
            }
            @keyframes auth-flicker {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.9; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>