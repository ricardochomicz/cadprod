<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    protected $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function index()
    {
        $products = Product::paginate();

        return view('admin.products.index', compact('products'));
    }

    
    public function create()
    {
        return view('admin.products.create');
    }

    
    public function store(StoreUpdateProduct $request)
    {
        $category = Category::find($request->category_id);
        $category->products()->create($request->all());

        return redirect()
            ->route('products.index')
            ->withSuccess('Produto cadastrado com sucesso!');
    }

   
    public function show($id)
    {
        if (!$product = Product::with('category')->find($id))
            return redirect()->back();

        return view('admin.products.show', compact('product'));
    }

    
    public function edit($id)
    {
        if (!$product = Product::find($id))
            return redirect()->back();

        return view('admin.products.edit', compact('product'));
    }

   
    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = Product::find($id))
            return redirect()->back();

            $data = $request->all();
            $data['url'] = \Str::slug($request->name);
            $product->update($data);

        return redirect()
            ->route('products.index')->withSuccess('Produto atualizado com sucesso!');
    }

   
    public function destroy($id)
    {
        if (!$product = Product::find($id))
            return redirect()->back();

        $product->delete();
        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        $products = Product::with('category')
            ->where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', 'LIKE', "%{$request->name}%");
                }
                if ($request->price) {
                    $query->orWhere('price', 'LIKE', "{$request->price}%");
                }
                if ($request->category) {
                    $query->where('category_id', $request->category);
                }
            })
            ->orderBy('name', 'asc')
            ->paginate();

        return view('admin.products.index', compact('products', 'data'));
    }

    public function getProductsVue()
    {
        $products = Product::all();

        return response()->json($products);

    }
}
