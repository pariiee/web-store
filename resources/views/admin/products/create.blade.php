<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --gray-color: #6b7280;
            --border-color: #e5e7eb;
            --radius: 8px;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:#f5f7fa;
            padding:20px;
            color:var(--dark-color);
        }

        .container { max-width:900px; margin:auto; }

        .header {
            display:flex;
            align-items:center;
            gap:10px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
            margin-bottom:25px;
        }

        .header i { color:var(--primary-color); font-size:22px; }
        .header h1 { font-size:24px; margin:0; }

        .card {
            background:white;
            padding:25px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
        }

        label {
            font-size:14px;
            font-weight:600;
            margin-bottom:6px;
            display:block;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width:100%;
            padding:10px 14px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            font-size:14px;
            margin-bottom:15px;
            transition:.3s;
        }

        textarea { min-height:120px; resize:vertical; }

        input:focus,
        select:focus,
        textarea:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.15);
        }

        .checkbox-group label {
            display:flex;
            align-items:center;
            gap:8px;
            font-size:14px;
            margin-bottom:8px;
            font-weight:500;
        }

        .btn {
            padding:10px 18px;
            border-radius:var(--radius);
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
            font-weight:500;
            display:inline-flex;
            align-items:center;
            gap:6px;
        }

        .btn-primary { background:var(--primary-color); color:white; border:0; }
        .btn-secondary { background:#e5e7eb; color:var(--dark-color); }

        .btn-primary:hover { background:#314ad4; }
        .btn-secondary:hover { background:#d5d7da; }

        .alert-danger {
            background:#fee2e2;
            padding:12px 16px;
            border-left:4px solid var(--danger-color);
            border-radius:var(--radius);
            margin-bottom:20px;
            color:#991b1b;
        }

        .alert-danger ul { margin:0; padding-left:20px; }
        
        /* Thumbnail Preview */
        .preview-container {
            margin-bottom: 15px;
        }
        
        .preview-thumb {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            display: none;
        }
    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-plus-circle"></i>
        <h1>Tambah Produk</h1>
    </div>

    <!-- ERRORS -->
    @if($errors->any())
        <div class="alert-danger">
            <strong>Perhatikan kesalahan berikut:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <div class="card">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- NAMA PRODUK -->
            <label>Nama Produk</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama produk ..." required>

            <!-- KATEGORI -->
            <label>Kategori</label>
            <select name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <!-- DESKRIPSI -->
            <label>Deskripsi</label>
            <textarea name="description" placeholder="Masukkan deskripsi produk ...">{{ old('description') }}</textarea>

            <!-- THUMBNAIL -->
            <label>Thumbnail (max 2MB, akan di-crop persegi saat ditampilkan)</label>
            
            <div class="preview-container">
                <img id="thumbnailPreview" class="preview-thumb" src="#" alt="Preview">
            </div>
            
            <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*">

            <!-- CHECKBOX FIELDS -->
            <label>Checklist Kolom Data (yang diminta ke pembeli)</label>
            <div class="checkbox-group">
                @foreach($fields as $field)
                    @php
                        $labels = [
                            'username' => 'Username',
                            'password' => 'Password',
                            'backup_code1' => 'Backup Code 1',
                            'backup_code2' => 'Backup Code 2',
                            'backup_code3' => 'Backup Code 3',
                            'id' => 'ID Akun',
                            'idml_plus' => 'ID ML Plus',
                            'email' => 'Email',
                            'phone' => 'Nomor Tujuan',
                            'social_link' => 'Link Sosial Media',
                            'noted' => 'Noted (Catatan Pembeli)',
                        ];
                    @endphp

                    <label>
                        <input type="checkbox"
                               name="required_fields[]"
                               value="{{ $field }}"
                               {{ is_array(old('required_fields')) && in_array($field, old('required_fields')) ? 'checked' : '' }}>
                        {{ $labels[$field] ?? ucfirst(str_replace('_',' ',$field)) }}
                    </label>
                @endforeach
            </div>

            <p style="margin-top:6px;font-size:12px;color:#6b7280;">
                Admin bisa memilih data apa saja yang perlu diisi pembeli (opsional per produk)
            </p>

            <!-- BUTTONS -->
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<script>
    // Preview thumbnail
    document.getElementById('thumbnailInput').addEventListener('change', function(e) {
        const preview = document.getElementById('thumbnailPreview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>

</body>
</html>