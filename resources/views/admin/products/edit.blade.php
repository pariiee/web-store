<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>

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

        .container {
            max-width:900px;
            margin:auto;
        }

        .header {
            display:flex;
            align-items:center;
            gap:10px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
            margin-bottom:25px;
        }

        .header i {
            color:var(--primary-color);
            font-size:22px;
        }

        .header h1 {
            font-size:24px;
        }

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
        input[type="file"],
        select,
        textarea {
            width:100%;
            padding:10px 14px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            font-size:14px;
            margin-bottom:16px;
            transition:.3s ease;
        }

        textarea {
            min-height:120px;
            resize:vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.2);
        }

        /* Thumbnail dengan crop persegi */
        .preview-thumb {
            width:100px;
            height:100px;
            object-fit:cover;
            border-radius:var(--radius);
            margin-bottom:10px;
            border:1px solid var(--border-color);
        }

        .checkbox-group label {
            display:flex;
            align-items:center;
            gap:8px;
            font-size:14px;
            margin-bottom:8px;
        }

        /* BUTTONS */
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

        .btn-primary { background:var(--primary-color); color:white; }
        .btn-secondary { background:#e5e7eb; color:var(--dark-color); }

        .btn-primary:hover { background:#314ad4; }
        .btn-secondary:hover { background:#d5d7da; }

        /* ERROR ALERT */
        .alert-danger {
            background:#fee2e2;
            padding:12px 16px;
            border-left:4px solid var(--danger-color);
            border-radius:var(--radius);
            margin-bottom:20px;
            color:#991b1b;
        }

        .alert-danger ul {
            margin:0;
            padding-left:20px;
        }

        /* New thumbnail preview */
        .new-preview {
            width:100px;
            height:100px;
            object-fit:cover;
            border-radius:var(--radius);
            margin-bottom:10px;
            border:1px dashed var(--primary-color);
            display:none;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-edit"></i>
        <h1>Edit Produk</h1>
    </div>

    <!-- ERROR VALIDATION -->
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
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- NAMA PRODUK -->
            <label>Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Masukkan nama produk ..." required>

            <!-- KATEGORI -->
            <label>Kategori</label>
            <select name="category_id" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <!-- DESKRIPSI -->
            <label>Deskripsi</label>
            <textarea name="description" placeholder="Masukkan deskripsi produk ...">{{ old('description', $product->description) }}</textarea>

            <!-- THUMBNAIL -->
            <label>Thumbnail (max 2MB, akan di-crop persegi saat ditampilkan)</label>
            
            <!-- Current thumbnail -->
            @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}" class="preview-thumb" id="currentThumbnail">
            @endif
            
            <!-- New thumbnail preview -->
            <img id="newThumbnailPreview" class="new-preview" src="#" alt="Preview Baru">
            
            <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*">
            
            <p style="font-size:12px; color:#6b7280; margin-top:-10px; margin-bottom:15px;">
                Biarkan kosong jika tidak ingin mengganti thumbnail
            </p>

            <!-- CHECKBOX FIELDS -->
            <label>Checklist Kolom Data</label>

            @php
                $selected = old('required_fields', $product->required_fields ?? []);
            @endphp

            <div class="checkbox-group">
                @foreach($fields as $field)
                <label>
                    <input type="checkbox" 
                           name="required_fields[]" 
                           value="{{ $field }}"
                        {{ is_array($selected) && in_array($field, $selected) ? 'checked' : '' }}>
                    {{ ucfirst(str_replace('_',' ',$field)) }}
                </label>
                @endforeach
            </div>

            <!-- STATUS AKTIF -->
            <label style="margin-top: 15px;">
                <input type="checkbox" name="is_active" value="1" 
                    {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                Produk Aktif
            </label>

            <!-- BUTTONS -->
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>

                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<script>
    // Preview new thumbnail
    document.getElementById('thumbnailInput').addEventListener('change', function(e) {
        const preview = document.getElementById('newThumbnailPreview');
        const current = document.getElementById('currentThumbnail');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                
                // Hide current thumbnail if exists
                if (current) {
                    current.style.display = 'none';
                }
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            
            // Show current thumbnail again
            if (current) {
                current.style.display = 'block';
            }
        }
    });
</script>

</body>
</html>