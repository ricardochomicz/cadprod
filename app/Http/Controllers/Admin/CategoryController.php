<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('title', 'asc')->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        Category::create($request->all());

        return redirect()
            ->route('categories.index')
            ->withSuccess('Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$category = Category::find($id)) {
            return redirect()->back();
        }

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$category = Category::find($id)) {
            return redirect()->back();
        }
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$category = Category::find($id)) {
            return redirect()->back();
        }
        $data = $request->all();
        $data['url'] = \Str::slug($request->title);
        $category->update($data);
       

        return redirect()
            ->route('categories.index')
            ->withSuccess('Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$category = Category::find($id)) {
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        /*
        $categories = DB::table('categories')
            ->where('title', 'LIKE',  "%{$filter}%")
            ->orWhere('url', $filter)
            ->get();
        */
        $categories = DB::table('categories')
            ->where(function ($query) use ($data) {
                if (isset($data['title'])) {
                    $title = $data['title'];
                    $query->where('title', 'LIKE', "%{$title}%");
                }
                if (isset($data['url'])) {
                    $url = $data['url'];
                    $query->orWhere('url', 'LIKE', "%{$url}%");
                }
            })
            ->orderBy('title', 'asc')
            ->paginate();

        return view('admin.categories.index', compact('categories', 'data'));
    }
}
