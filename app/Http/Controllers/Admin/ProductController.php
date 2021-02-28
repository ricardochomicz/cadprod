<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $category = Category::find($request->category_id);
        $product = $category->products()->create($request->all());

        return redirect()
            ->route('products.index')
            ->withSuccess('Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = Product::with('category')->find($id))
            return redirect()->back();

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = Product::find($id))
            return redirect()->back();

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
