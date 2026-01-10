<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    // daftar field yang bisa dicentang
    private array $allFields = [
        'username',
        'password',
        'backup_code1',
        'backup_code2',
        'backup_code3',
        'id',
        'idml_plus',
        'email',
        'phone',
        'social_link',
        'noted',
    ];

    public function index()
    {
        $products = Product::with('category')
            ->orderByDesc('id')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $fields     = $this->allFields;

        return view('admin.products.create', compact('categories', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required|exists:categories,id',
                'name' => [
                    'required',
                    'string',
                    'max:150',
                    Rule::unique('products')
                        ->where(fn ($q) =>
                            $q->where('category_id', $request->category_id)
                        ),
                ],
                'description'     => 'nullable|string',
                'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // HAPUS: dimensions:ratio=1/1
                'required_fields' => 'array',
            ],
            [
                'name.unique' => 'Nama produk sudah ada di kategori ini.',
            ]
        );

        // upload thumbnail
        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // slug global unik
        $slugBase = Str::slug($request->name);
        $slug     = $slugBase;
        $i        = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $i++;
        }

        // sanitize required_fields
        $selectedFields = $request->required_fields ?? [];
        $selectedFields = is_array($selectedFields) ? $selectedFields : [];
        $selectedFields = array_values(array_intersect($selectedFields, $this->allFields));

        Product::create([
            'category_id'     => $request->category_id,
            'name'            => $request->name,
            'slug'            => $slug,
            'description'     => $request->description,
            'thumbnail'       => $path,
            'required_fields' => $selectedFields,
            'is_active'       => true,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dibuat.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $fields     = $this->allFields;

        return view('admin.products.edit', compact('product', 'categories', 'fields'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate(
            [
                'category_id' => 'required|exists:categories,id',
                'name' => [
                    'required',
                    'string',
                    'max:150',
                    Rule::unique('products')
                        ->where(fn ($q) =>
                            $q->where('category_id', $request->category_id)
                        )
                        ->ignore($product->id),
                ],
                'description'     => 'nullable|string',
                'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // HAPUS: dimensions:ratio=1/1
                'required_fields' => 'array',
                'is_active'       => 'nullable|boolean',
            ],
            [
                'name.unique' => 'Nama produk sudah ada di kategori ini.',
            ]
        );

        // thumbnail update
        $path = $product->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // update slug jika nama berubah
        if ($product->name !== $request->name) {
            $slugBase = Str::slug($request->name);
            $slug     = $slugBase;
            $i        = 1;

            while (
                Product::where('slug', $slug)
                    ->where('id', '!=', $product->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $i++;
            }

            $product->slug = $slug;
        }

        // sanitize required_fields
        $selectedFields = $request->required_fields ?? [];
        $selectedFields = is_array($selectedFields) ? $selectedFields : [];
        $selectedFields = array_values(array_intersect($selectedFields, $this->allFields));

        $product->update([
            'category_id'     => $request->category_id,
            'name'            => $request->name,
            'description'     => $request->description,
            'thumbnail'       => $path,
            'required_fields' => $selectedFields,
            'is_active'       => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}