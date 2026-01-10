<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 419 - Sesi Habis</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2a1a2a 0%, #3e1a3e 100%);
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
            color: #ff6b95;
            text-shadow: 0 0 10px rgba(255, 107, 149, 0.5);
        }

        .error-code {
            font-size: 3rem;
            font-weight: bold;
            color: #ff6b95;
            margin-bottom: 0.2rem;
            text-shadow: 0 0 20px rgba(255, 107, 149, 0.7);
            position: relative;
            display: inline-block;
            animation: session-pulse 3s infinite;
        }

        @keyframes session-pulse {
            0%, 100% { 
                transform: scale(1);
                color: #ff6b95;
            }
            25% { 
                transform: scale(1.05);
                color: #ff94b5;
            }
            50% { 
                transform: scale(1);
                color: #ff4d7d;
            }
            75% { 
                transform: scale(1.03);
                color: #ffb4cc;
            }
        }

        .error-code::after {
            content: "⏳";
            position: absolute;
            font-size: 1.5rem;
            top: 50%;
            right: -30px;
            transform: translateY(-50%);
            animation: session-fade 4s infinite;
        }

        @keyframes session-fade {
            0%, 100% { transform: translateY(-50%) scale(1); opacity: 1; }
            25% { transform: translateY(-50%) scale(1.2); opacity: 0.7; }
            50% { transform: translateY(-50%) scale(1); opacity: 1; }
            75% { transform: translateY(-50%) scale(0.9); opacity: 0.8; }
        }

        .header p {
            font-size: 0.9rem;
            line-height: 1.3;
            color: #ccc;
            margin: 0.2rem 0;
        }

        .session-info {
            background-color: rgba(255, 107, 149, 0.1);
            border-left: 3px solid #ff6b95;
            padding: 0.5rem;
            margin-top: 0.4rem;
            border-radius: 4px;
            text-align: left;
            font-size: 0.8rem;
        }

        .session-info strong {
            color: #ff94b5;
            display: block;
            margin-bottom: 0.15rem;
        }

        .session-info ul {
            margin: 0.15rem 0;
            padding-left: 0.8rem;
        }

        .session-info li {
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

        .session-fade {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .fade-dot {
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: rgba(255, 107, 149, 0.3);
            border-radius: 50%;
            animation: fade-dot-animation 4s infinite;
        }

        @keyframes fade-dot-animation {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 0.5; transform: scale(1); }
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
            background-color: #ff6b95;
            margin-bottom: -5em;
            z-index: 1;
            animation: antenna-session 4s infinite;
            position: relative;
        }
        
        @keyframes antenna-session {
            0%, 100% { 
                transform: scale(1);
                background-color: #ff6b95;
                box-shadow: 0 0 10px #ff6b95;
            }
            25% { 
                transform: scale(1.1);
                background-color: #ff94b5;
                box-shadow: 0 0 20px #ff94b5;
            }
            50% { 
                transform: scale(0.95);
                background-color: #ff4d7d;
                box-shadow: 0 0 5px #ff4d7d;
            }
            75% { 
                transform: scale(1.05);
                background-color: #ffb4cc;
                box-shadow: 0 0 15px #ffb4cc;
            }
        }

        .tv {
            width: 15em;
            height: 8em;
            margin-top: 2em;
            border-radius: 12px;
            background-color: #ff4d7d;
            display: flex;
            justify-content: center;
            border: 2px solid #3d1a29;
            box-shadow: 
                inset 0.2em 0.2em #ff94b5,
                0 0 20px rgba(255, 107, 149, 0.5);
            animation: tv-session 3s infinite;
            position: relative;
            overflow: hidden;
        }
        
        @keyframes tv-session {
            0%, 100% {
                box-shadow: 
                    inset 0.2em 0.2em #ff94b5,
                    0 0 20px rgba(255, 107, 149, 0.5);
                transform: scale(1);
            }
            33% {
                box-shadow: 
                    inset 0.2em 0.2em #ff94b5,
                    0 0 40px rgba(255, 107, 149, 0.8);
                transform: scale(1.02);
            }
            66% {
                box-shadow: 
                    inset 0.2em 0.2em #ff94b5,
                    0 0 10px rgba(255, 107, 149, 0.3);
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

        /* Container untuk tombol */
        .buttons-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            max-width: 350px;
            margin-top: 0.6rem;
        }
        
        .btn {
            background-color: #ff6b95;
            color: white;
            border: none;
            padding: 0.6rem 2rem;
            border-radius: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            text-align: center;
            font-size: 0.9rem;
            width: 100%;
            max-width: 250px;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }
        
        .btn:hover {
            background-color: #ff4d7d;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }
        
        .btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
        
        /* Responsif untuk mobile kecil */
        @media only screen and (max-width: 480px) {
            .main_wrapper {
                transform: scale(0.75);
                margin: 0.3rem auto;
            }
            
            .buttons-container {
                margin-top: 0.3rem;
            }
            
            .btn {
                max-width: 90%;
                width: 90%;
                padding: 0.5rem 1.5rem;
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
            
            .session-info {
                padding: 0.4rem;
                margin-top: 0.3rem;
                font-size: 0.75rem;
            }
            
            .session-info ul {
                margin: 0.1rem 0;
            }
            
            .session-info li {
                font-size: 0.75rem;
            }
            
            .btn {
                padding: 0.5rem 1.5rem;
                font-size: 0.85rem;
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
            
            .btn {
                padding: 0.45rem 1.2rem;
                font-size: 0.8rem;
                width: 90%;
            }
            
            .session-info {
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
            
            .btn {
                font-size: 0.75rem;
                padding: 0.4rem 1rem;
            }
        }
        
        @media only screen and (min-width: 769px) {
            .session-fade {
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
            
            .buttons-container {
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
                inset 0px 16px #ff4d7d,
                inset 0px 16px 1px 1px #ff4d7d;
        }
        
        .antenna::after {
            content: "🔄";
            position: absolute;
            margin-top: -7.5em;
            margin-left: 0.3em;
            transform: rotate(-25deg);
            width: 0.8em;
            height: 0.4em;
            border-radius: 50%;
            color: #ff94b5;
            font-size: 1.2em;
            animation: session-refresh 3s infinite;
        }
        
        .antenna::before {
            content: "🔄";
            position: absolute;
            margin-top: 0.2em;
            margin-left: 1em;
            transform: rotate(-20deg);
            width: 1.2em;
            height: 0.6em;
            border-radius: 50%;
            color: #ff94b5;
            font-size: 1.5em;
            animation: session-refresh 3s infinite 1.5s;
        }

        @keyframes session-refresh {
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
            animation: a1-session 5s infinite;
        }

        @keyframes a1-session {
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
            animation: a2-session 4s infinite;
        }

        @keyframes a2-session {
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
            background-color: #ff4d7d;
            padding: 0.2em 0.35em;
            font-size: 0.55em;
            color: white;
            letter-spacing: 0.08em;
            border-radius: 4px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ff94b5;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            animation: session-text 3s infinite;
        }

        .error_text_mobile {
            background-color: #ff4d7d;
            padding: 0.2em 0.35em;
            font-size: 0.4em;
            color: white;
            letter-spacing: 0.08em;
            border-radius: 4px;
            z-index: 10;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            border: 1px solid #ff94b5;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        
        .tv::before {
            content: "⌛";
            position: absolute;
            font-size: 3rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.15;
            z-index: 0;
            animation: session-icon 5s infinite;
        }

        @keyframes session-icon {
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
                repeating-radial-gradient(#ff4d7d 0 0.0001%, #00000070 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#ff4d7d 0 0.0001%, #00000070 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            opacity: 0.09;
            animation: session-static 2s infinite;
        }

        @keyframes session-static {
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
            box-shadow: 3px 3px 0px #ff94b5;
            z-index: 1;
            animation: display-session 2.5s infinite;
        }

        @keyframes display-session {
            0%, 100% { box-shadow: 3px 3px 0px #ff94b5; }
            50% { box-shadow: 3px 3px 0px #ffb4cc; }
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
            border: 2px solid #3d1a29;
            background:
                repeating-radial-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 50% 0/2500px
                    2500px,
                repeating-conic-gradient(#000 0 0.0001%, #ffffff 0 0.0002%) 60% 60%/2500px
                    2500px;
            background-blend-mode: difference;
            animation: b 0.1s infinite alternate, screen-session 4s infinite;
            border-radius: 8px;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ff6b95;
            letter-spacing: 0.08em;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        @keyframes screen-session {
            0%, 100% { 
                filter: brightness(1);
                color: #ff6b95;
            }
            50% { 
                filter: brightness(1.3);
                color: #ff94b5;
            }
        }
        
        .screen::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(transparent 50%, rgba(255, 148, 181, 0.2) 50%);
            background-size: 100% 3px;
            z-index: 1;
            pointer-events: none;
            animation: session-scanline 3s infinite;
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
            color: #ff6b95;
            letter-spacing: 0.08em;
            text-align: center;
            overflow: hidden;
            animation: session-flicker 2s infinite;
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
            background-color: #ff94b5;
            border: 2px solid #3d1a29;
            padding: 0.4em;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            row-gap: 0.5em;
            box-shadow: 2px 2px 0px #ff94b5;
            position: relative;
            animation: buttons-session 3s infinite;
        }
        
        .buttons_div::before {
            content: "🔄";
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1rem;
            animation: refresh-pulse 2s infinite;
        }
        
        .b1, .b2 {
            width: 1.3em;
            height: 1.3em;
            border-radius: 50%;
            background-color: #ff4d7d;
            border: 2px solid black;
            box-shadow:
                inset 2px 2px 1px #ffb4cc,
                -2px 0px #ff2e64,
                -2px 0px 0px 1px black;
            animation: button-session 2s infinite;
            position: relative;
        }
        
        .b1::before {
            content: "↻";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.8em;
            font-weight: bold;
        }
        
        .b2::before {
            content: "↺";
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
        
        /* Tambahan untuk animasi refresh */
        @keyframes refresh-pulse {
            0%, 100% { transform: translateX(-50%) scale(1); opacity: 1; }
            50% { transform: translateX(-50%) scale(1.3); opacity: 0.7; }
        }
        
        @keyframes button-session {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        @keyframes buttons-session {
            0%, 100% { box-shadow: 2px 2px 0px #ff94b5; }
            50% { box-shadow: 2px 2px 0px #ffb4cc; }
        }
        
        @keyframes session-text {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        @keyframes session-scanline {
            0% { transform: translateY(0); }
            100% { transform: translateY(6.6em); }
        }
        
        @keyframes session-flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }
        
        @keyframes b {
            100% {
                background-position: 50% 0, 60% 50%;
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
                <div class="error-code">419</div>
                <h1>SESI TELAH HABIS</h1>
                <p>Sesi autentikasi Anda telah berakhir karena tidak aktif dalam jangka waktu tertentu. Silakan login kembali untuk melanjutkan.</p>
                
                <div class="session-info">
                    <strong>⚠️ Informasi Sesi:</strong>
                    <ul>
                        <li>Sesi login telah kedaluwarsa</li>
                        <li>Tidak ada aktivitas dalam jangka waktu tertentu</li>
                        <li>Token autentikasi tidak valid lagi</li>
                        <li>Perlindungan keamanan terhadap akses yang tidak aktif</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Kontainer untuk TV dan tombol -->
        <div class="content-container">
            <div class="main_wrapper">
                <div class="session-fade" id="sessionFade"></div>
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
                                        <span class="error_text">SESSION EXPIRED - ERROR 419</span>
                                    </div>
                                    <div class="screenM">
                                        <span class="error_text_mobile">SESSION EXPIRED</span>
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
            
            <!-- Container untuk tombol -->
            <div class="buttons-container">
                <button id="refreshBtn" class="btn">Coba Lagi Nanti</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            createFadeDots();
            
            // Fungsi untuk refresh halaman dengan efek visual
            const refreshBtn = document.getElementById('refreshBtn');
            refreshBtn.addEventListener('click', function() {
                // Tambah efek visual sebelum refresh
                const btn = this;
                const originalText = btn.textContent;
                
                // Ubah teks dan nonaktifkan sementara
                btn.textContent = 'Memuat ulang...';
                btn.disabled = true;
                
                // Tambah efek visual
                createRefreshEffect();
                
                // Tunggu sebentar untuk efek visual, lalu refresh
                setTimeout(() => {
                    location.reload();
                }, 800);
            });
            
            const tv = document.querySelector('.tv');
            tv.addEventListener('click', function() {
                const messages = ["SESSION EXPIRED", "LOGIN REQUIRED", "AUTHENTICATION TIMEOUT", "REFRESH SESSION"];
                const message = messages[Math.floor(Math.random() * messages.length)];
                
                const msg = document.createElement('div');
                msg.textContent = message;
                msg.style.cssText = `
                    position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    background: linear-gradient(135deg, #ff6b95, #ff4d7d); color: white;
                    padding: 0.8rem 1.5rem; border-radius: 5px; font-weight: bold;
                    z-index: 1000; box-shadow: 0 0 30px rgba(255, 107, 149, 0.8);
                    animation: sessionPulse 2s forwards;
                `;
                
                document.body.appendChild(msg);
                
                // Tambah efek fade dots
                for (let i = 0; i < 5; i++) {
                    setTimeout(() => {
                        createRandomFadeDot();
                    }, i * 100);
                }
                
                setTimeout(() => msg.remove(), 2000);
            });
            
            // Tambah event listener untuk tombol TV
            const tvButtons = document.querySelectorAll('.b1, .b2');
            tvButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation(); // Mencegah trigger event pada TV
                    
                    // Animasi tombol ditekan
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                    
                    // Refresh halaman setelah delay kecil
                    createRefreshEffect();
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                });
            });
        });
        
        function createFadeDots() {
            if (window.innerWidth < 769) return;
            
            const container = document.getElementById('sessionFade');
            const dotsCount = 12;
            
            for (let i = 0; i < dotsCount; i++) {
                const dot = document.createElement('div');
                dot.className = 'fade-dot';
                
                const angle = (i / dotsCount) * Math.PI * 2;
                const radius = 120;
                const centerX = 50;
                const centerY = 50;
                
                const x = centerX + Math.cos(angle) * radius;
                const y = centerY + Math.sin(angle) * radius;
                
                dot.style.left = `${x}%`;
                dot.style.top = `${y}%`;
                
                const delay = Math.random() * 4;
                const duration = 3 + Math.random() * 2;
                
                dot.style.animation = `fade-dot-animation ${duration}s infinite ${delay}s`;
                
                container.appendChild(dot);
            }
        }
        
        function createRandomFadeDot() {
            const container = document.getElementById('sessionFade');
            const dot = document.createElement('div');
            dot.className = 'fade-dot';
            
            const x = 25 + Math.random() * 50;
            const y = 25 + Math.random() * 50;
            
            dot.style.left = `${x}%`;
            dot.style.top = `${y}%`;
            
            dot.style.animation = `fade-dot-animation 2s forwards`;
            
            container.appendChild(dot);
            
            setTimeout(() => {
                if (container.contains(dot)) {
                    container.removeChild(dot);
                }
            }, 2000);
        }
        
        function createRefreshEffect() {
            // Buat efek visual refresh
            const refreshEffect = document.createElement('div');
            refreshEffect.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(107, 149, 255, 0.3), rgba(255, 107, 149, 0.3));
                z-index: 9999;
                opacity: 0;
                animation: refreshFade 0.8s forwards;
                pointer-events: none;
            `;
            
            document.body.appendChild(refreshEffect);
            
            // Tambah efek titik-titik refresh
            for (let i = 0; i < 8; i++) {
                setTimeout(() => {
                    createRefreshDot();
                }, i * 100);
            }
            
            setTimeout(() => {
                document.body.removeChild(refreshEffect);
            }, 800);
        }
        
        function createRefreshDot() {
            const dot = document.createElement('div');
            dot.style.cssText = `
                position: fixed;
                width: 10px;
                height: 10px;
                background-color: #6b95ff;
                border-radius: 50%;
                z-index: 10000;
                pointer-events: none;
                animation: refreshDot 0.8s forwards;
            `;
            
            // Posisi acak
            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;
            
            dot.style.left = `${x}px`;
            dot.style.top = `${y}px`;
            
            document.body.appendChild(dot);
            
            setTimeout(() => {
                document.body.removeChild(dot);
            }, 800);
        }
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes sessionPulse {
                0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0; }
                50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
                100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            }
            
            @keyframes refreshFade {
                0% { opacity: 0; }
                50% { opacity: 0.7; }
                100% { opacity: 0; }
            }
            
            @keyframes refreshDot {
                0% { transform: scale(0); opacity: 1; }
                50% { transform: scale(1); opacity: 0.7; }
                100% { transform: scale(0); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>