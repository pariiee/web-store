<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Tutup - Pemberitahuan Resmi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 50%, #0f0f0f 100%);
            color: #fff;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background pattern */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(255, 255, 255, 0.03) 0%, transparent 20%),
                radial-gradient(circle at 85% 30%, rgba(255, 255, 255, 0.03) 0%, transparent 20%);
            z-index: 0;
        }
        
        .container {
            max-width: 550px;
            width: 100%;
            background: rgba(20, 20, 20, 0.9);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 
                0 10px 30px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                inset 0 0 0 1px rgba(255, 255, 255, 0.05);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 20px;
        }
        
        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #ff3333 0%, #ff9900 100%);
            border-radius: 3px;
        }
        
        .icon-container {
            width: 80px;
            height: 80px;
            background: rgba(255, 60, 60, 0.15);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            font-size: 36px;
            color: #ff5e5e;
            border: 2px solid rgba(255, 94, 94, 0.3);
        }
        
        h1 {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            background: linear-gradient(90deg, #fff 0%, #ffaaaa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .subtitle {
            color: #aaa;
            font-size: 16px;
            font-weight: 400;
        }
        
        /* Content Section */
        .content {
            margin: 30px 0;
        }
        
        .message-box {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #ff5e5e;
        }
        
        .message-box p {
            line-height: 1.6;
            font-size: 15px;
            color: #e0e0e0;
        }
        
        .highlight-box {
            background: rgba(255, 165, 0, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid rgba(255, 165, 0, 0.2);
        }
        
        .highlight-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffaa00;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 17px;
        }
        
        .highlight-title i {
            font-size: 20px;
        }
        
        .highlight-content {
            color: #ffcc80;
            font-size: 15px;
            line-height: 1.6;
        }
        
        strong {
            color: #fff;
            font-weight: 600;
        }
        
        /* Contact Section */
        .contact-section {
            background: rgba(0, 100, 200, 0.1);
            border-radius: 12px;
            padding: 25px;
            margin-top: 25px;
            border: 1px solid rgba(0, 150, 255, 0.2);
        }
        
        .contact-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #66ccff;
            text-align: center;
        }
        
        .contact-methods {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .contact-item:hover {
            background: rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
            border-color: rgba(0, 150, 255, 0.3);
        }
        
        .contact-icon {
            width: 48px;
            height: 48px;
            background: rgba(0, 150, 255, 0.15);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            color: #66ccff;
        }
        
        .contact-info {
            flex: 1;
            text-align: left;
        }
        
        .contact-label {
            font-size: 13px;
            color: #aaa;
            margin-bottom: 4px;
        }
        
        .contact-value {
            font-size: 16px;
            font-weight: 500;
        }
        
        .contact-value a {
            color: #66ccff;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .contact-value a:hover {
            color: #99ddff;
            text-decoration: underline;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            color: #888;
            font-size: 14px;
            line-height: 1.6;
            text-align: center;
        }
        
        .urgent-badge {
            display: inline-block;
            background: linear-gradient(90deg, #ff3333 0%, #ff6600 100%);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            animation: pulse 2s infinite;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 102, 0, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 102, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 102, 0, 0);
            }
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }
            
            h1 {
                font-size: 26px;
            }
            
            .icon-container {
                width: 70px;
                height: 70px;
                font-size: 32px;
            }
            
            .contact-methods {
                gap: 12px;
            }
            
            .contact-item {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon-container">
                <i class="fas fa-store-slash"></i>
            </div>
            <h1>STORE TUTUP</h1>
            <p class="subtitle">Pemberitahuan Resmi Penutupan Toko</p>
        </div>
        
        <div class="content">
            <div class="message-box">
                <p>Dengan hormat, kami mengumumkan bahwa web store kami <strong>telah resmi ditutup</strong> secara permanen. Terima kasih atas dukungan dan kepercayaan Anda selama ini.</p>
            </div>
            
            <div class="urgent-badge">
                <i class="fas fa-exclamation-circle"></i> PENGEMBALIAN DANA
            </div>
            
            <div class="highlight-box">
                <div class="highlight-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>PERHATIAN PENTING</span>
                </div>
                <div class="highlight-content">
                    Bagi pengguna yang memiliki <strong>saldo di atas Rp 1.000</strong>, mohon segera menghubungi kami melalui kontak di bawah untuk proses pengembalian dana.
                </div>
            </div>
        </div>
        
        <div class="contact-section">
            <div class="contact-title">
                <i class="fas fa-headset"></i> HUBUNGI KAMI
            </div>
            <div class="contact-methods">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="contact-info">
                        <div class="contact-label">WhatsApp</div>
                        <div class="contact-value">
                            <a href="https://wa.me/6287778032605">0877-7803-2605</a>
                        </div>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fab fa-telegram"></i>
                    </div>
                    <div class="contact-info">
                        <div class="contact-label">Telegram</div>
                        <div class="contact-value">
                            <a href="https://t.me/pariedev">@pariedev</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Mohon bersabar, proses pengembalian dana membutuhkan waktu untuk verifikasi data.</p>
            <p style="margin-top: 10px;">Terima kasih atas pengertian dan kerjasamanya.</p>
        </div>
    </div>
    
    <script>
        // Simple animation on load
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                container.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>