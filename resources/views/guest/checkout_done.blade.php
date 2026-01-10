<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Berhasil {{ $product->name }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            background: #fff5f7; 
            font-family: 'Poppins', sans-serif; 
            padding: 20px;
            color: #333;
        }
        
        .card { 
            max-width: 900px; 
            margin: auto; 
            background: white; 
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(214, 51, 108, 0.15); 
            overflow: hidden; 
        }
        
        .header { 
            background: linear-gradient(135deg, #ff6b9d, #d6336c); 
            color: white; 
            text-align: center; 
            padding: 30px; 
        }
        
        .icon { 
            width: 80px; 
            height: 80px; 
            border-radius: 50%; 
            background: white; 
            color: #d6336c;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            margin: auto; 
            font-size: 36px;
            margin-bottom: 15px;
        }
        
        .body { 
            padding: 30px; 
            display: flex; 
            gap: 40px; 
            flex-wrap: wrap; 
        }
        
        .left, .right { 
            flex: 1; 
            min-width: 300px; 
        }
        
        .title { 
            font-size: 20px; 
            font-weight: 600; 
            margin-bottom: 20px;
            color: #d6336c;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .title i {
            font-size: 22px;
        }
        
        .detail { 
            display: flex; 
            justify-content: space-between; 
            border-bottom: 1px solid #f0f0f0;
            padding: 12px 0; 
            margin-bottom: 5px; 
        }
        
        .detail span {
            color: #666;
        }
        
        .detail b {
            color: #d6336c;
        }
        
        .stock-box { 
            background: #fff9fb; 
            border: 1px solid #ffd1dc; 
            padding: 20px; 
            border-radius: 8px; 
            max-height: 300px; 
            overflow-y: auto; 
        }
        
        .copy-btn { 
            margin-top: 15px; 
            background: #d6336c; 
            color: white; 
            padding: 12px 18px; 
            border: none;
            border-radius: 6px; 
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        
        .copy-btn:hover {
            background: #c2255c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(214, 51, 108, 0.2);
        }
        
        .footer { 
            background: #fff5f7; 
            padding: 25px; 
            display: flex; 
            justify-content: space-between; 
            flex-wrap: wrap;
            border-top: 1px solid #ffd1dc;
        }
        
        .btn-home { 
            background: #d6336c; 
            color: white; 
            padding: 12px 25px; 
            border-radius: 6px; 
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-home:hover {
            background: #c2255c;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(214, 51, 108, 0.2);
        }
        
        /* Modal Popup */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }
        
        .modal-overlay.active .modal {
            transform: translateY(0);
        }
        
        .modal-header {
            background: linear-gradient(135deg, #ff6b9d, #d6336c);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-weight: 600;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            line-height: 1;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-body p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .modal-footer {
            padding: 0 25px 25px;
            text-align: center;
        }
        
        .btn-modal {
            background: #d6336c;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 16px;
        }
        
        .btn-modal:hover {
            background: #c2255c;
        }
        
        /* Info box dalam modal */
        .info-box {
            background: #fff9fb;
            border: 1px solid #ffd1dc;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .info-item i {
            color: #d6336c;
            margin-top: 3px;
        }
        
        .warning {
            color: #e74c3c;
            font-weight: 500;
            background: #ffeaea;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .links {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .link-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .link-item a {
            color: #d6336c;
            text-decoration: none;
            font-weight: 500;
        }
        
        .link-item a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .body {
                flex-direction: column;
                gap: 30px;
            }
            
            .footer {
                flex-direction: column;
                gap: 15px;
            }
            
            .footer div {
                text-align: center;
            }
            
            .modal {
                width: 95%;
            }
        }
    </style>
</head>

<body>

<div class="card">

    <div class="header">
        <div class="icon"><i class="fas fa-check-circle"></i></div>
        <h2>Pembelian Berhasil!</h2>
        <p>Berikut data akun kamu. Jangan lupa simpan baik-baik!</p>
    </div>

    <div class="body">

        <div class="left">
            <div class="title"><i class="fas fa-shopping-bag"></i> Detail Pembelian</div>

            <div class="detail"><span>Produk</span><b>{{ $product->name }}</b></div>
            <div class="detail"><span>Item</span><b>{{ $item->name }}</b></div>
            <div class="detail"><span>Jumlah</span><b>{{ $quantity }}</b></div>
            <div class="detail"><span>Total</span><b>Rp {{ number_format($total) }}</b></div>
            <div class="detail"><span>Tanggal</span><b>{{ date('d F Y') }}</b></div>
            
            <div style="margin-top: 25px; padding: 15px; background: #fff5f7; border-radius: 8px; border-left: 4px solid #d6336c;">
                <div style="font-weight: 600; color: #d6336c; margin-bottom: 8px;">
                    <i class="fas fa-info-circle"></i> Catatan:
                </div>
                <div style="font-size: 14px; color: #666;">
                    Klik "Kembali ke Home" untuk informasi garansi dan lainnya.
                </div>
            </div>
        </div>

        <div class="right">
            <div class="title"><i class="fas fa-key"></i> Data Akun / Stok</div>

            <div class="stock-box">
                <ol>
                    @foreach($delivered as $line)
                        <li style="margin-bottom:10px; padding-bottom:8px; border-bottom:1px solid #ffd1dc;">
                            <pre style="white-space:pre-wrap;">{{ $line }}</pre>
                        </li>
                    @endforeach
                </ol>
            </div>

            <button id="copyBtn" class="copy-btn">
                <i class="fas fa-copy"></i> Salin Semua Data
            </button>
            
            <div style="margin-top: 20px; padding: 15px; background: #fff5f7; border-radius: 8px; border-left: 4px solid #d6336c;">
                <div style="font-weight: 600; color: #d6336c; margin-bottom: 5px;">
                    <i class="fas fa-lightbulb"></i> Penting:
                </div>
                <div style="font-size: 14px; color: #666;">
                    1. Simpan data akun dengan aman<br>
                    2. Jangan bagikan ke orang lain<br>
                    3. SS login dalam 1x24 jam untuk garansi
                </div>
            </div>
        </div>

    </div>

    <div class="footer">
        <div>ID Transaksi: <b>{{ substr(md5(time()),0,10) }}</b></div>
        <a href="/information" id="homeBtn" class="btn-home">Kembali ke Home</a>
    </div>

</div>


<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-info-circle"></i> Informasi Penting</h3>
            <button class="modal-close" id="modalClose">&times;</button>
        </div>
        <div class="modal-body">
            <p><strong>Terima kasih telah berbelanja!</strong></p>
            
            <div class="info-box">
                <div class="info-item">
                    <i class="fas fa-shield-alt"></i>
                    <div><strong>Garansi:</strong> SS Login wajib dalam 1x24 jam.</div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-link"></i>
                    <div><strong>Link Penting:</strong></div>
                </div>
                
                <div class="links">
                    <div class="link-item">
                        <i class="fas fa-camera"></i>
                        <a href="/bukti-garansi/" target="_blank">Upload SS Login (1x24 jam)</a>
                    </div>
                    
                    <div class="link-item">
                        <i class="fas fa-tools"></i>
                        <a href="/bukti-garansi" target="_blank">Klaim Garansi</a>
                    </div>
                </div>
                
                <div class="warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>Garansi hangus jika tidak SS login dalam 1x24 jam!</div>
                </div>
            </div>
            
            <div style="margin-top: 20px; padding: 15px; background: #f0f8ff; border-radius: 6px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: #0066cc;">
                    <i class="fas fa-users"></i>
                    <strong>Mau Jadi Reseller?</strong>
                </div>
                <p style="font-size: 14px; margin-bottom: 10px;">Dapatkan harga khusus!</p>
                <div class="link-item">
                    <i class="fab fa-telegram"></i>
                    <a href="https://t.me/paridevv" target="_blank">Hubungi Admin: @paridevv</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-modal" id="modalConfirm">
                <i class="fas fa-check"></i> Mengerti, Kembali ke Home
            </button>
        </div>
    </div>
</div>

<script>

document.getElementById("copyBtn").addEventListener("click", function () {
    const data = @json($delivered);
    const text = data.join("\n\n----------------------\n\n");

    navigator.clipboard.writeText(text).then(() => {
        this.innerHTML = "<i class='fas fa-check'></i> Data Berhasil Disalin!";
        this.style.background = "#27ae60";
        setTimeout(() => {
            this.innerHTML = "<i class='fas fa-copy'></i> Salin Semua Data";
            this.style.background = "#d6336c";
        }, 2000);
    }).catch(err => {
        console.error('Gagal menyalin teks: ', err);
        this.innerHTML = "<i class='fas fa-times'></i> Gagal Menyalin";
        this.style.background = "#e74c3c";
        setTimeout(() => {
            this.innerHTML = "<i class='fas fa-copy'></i> Salin Semua Data";
            this.style.background = "#d6336c";
        }, 2000);
    });
});


const modalOverlay = document.getElementById("modalOverlay");
const homeBtn = document.getElementById("homeBtn");
const modalClose = document.getElementById("modalClose");
const modalConfirm = document.getElementById("modalConfirm");


homeBtn.addEventListener("click", function(e) {
    e.preventDefault();
    modalOverlay.classList.add("active");
    document.body.style.overflow = "hidden";
});


modalClose.addEventListener("click", function() {
    modalOverlay.classList.remove("active");
    document.body.style.overflow = "auto";
});


modalConfirm.addEventListener("click", function() {
    modalOverlay.classList.remove("active");
    document.body.style.overflow = "auto";
    
    
    setTimeout(() => {
        window.location.href = "{{ route('guest.home') }}";
    }, 300);
});


modalOverlay.addEventListener("click", function(e) {
    if (e.target === modalOverlay) {
        modalOverlay.classList.remove("active");
        document.body.style.overflow = "auto";
    }
});
</script>

</body>
</html>