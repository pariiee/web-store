<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --success-color: #10b981;
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
            max-width:700px;
            margin:auto;
        }

        .header {
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:25px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
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

        .form-group {
            margin-bottom:18px;
        }

        label {
            font-size:14px;
            font-weight:600;
            margin-bottom:5px;
            display:block;
        }

        input[type="text"] {
            width:100%;
            padding:10px 14px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            font-size:14px;
            transition:.3s;
        }

        input[type="text"]:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.15);
        }

        .btn {
            padding:10px 18px;
            border-radius:var(--radius);
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
            display:inline-block;
            font-weight:500;
        }

        .btn-primary {
            background:var(--primary-color);
            color:white;
        }

        .btn-primary:hover {
            background:#314ad4;
        }

        .btn-secondary {
            background:#e5e7eb;
            color:var(--dark-color);
        }

        .btn-secondary:hover {
            background:#d5d7da;
        }

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
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-edit" style="color:var(--primary-color);font-size:22px;"></i>
        <h1>Edit Kategori</h1>
    </div>

    <!-- ERROR VALIDATION -->
    @if($errors->any())
        <div class="alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <div class="card">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Masukkan nama kategori...">
            </div>

            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
