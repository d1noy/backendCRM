<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * List product of category
     *
     * @param Category $category
     * @return Factory|View|\Illuminate\View\View
     */
    public function index(Category $category)
    {
        return view('products.index', [
            'category' => $category,
            'product' => $category->products,
        ]);
    }

    public  function create(Category $category)
    {
        return view('products.create', compact('category'));
    }

    /**
     * List of products
     *
     * @return Factory|View
     */
    public function list(): Factory|View
    {
        return view('products.list', [
            'product' => Product::query()->orderBy('id', 'DESC')->paginate(3),
        ]);
    }

    /**
     * Create product
     *
     * @param Category $category
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(Category $category, ProductRequest $request)
    {
        $product = $category->products()->create($request->validated());

        $product->updateImages($request->file('images'));

        return redirect()->route('products.index', compact('category'));
    }


    /**
     * Show product
     *
     * @param Product $product
     * @return Factory|View|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    /**
     * Edit form
     *
     * @param Product $product
     * @return Factory|View|\Illuminate\View\View
     */

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }


    /**
     * Update product
     *
     * @param Product $product
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function update(Product $product, ProductRequest $request) {
        $product->update($request->validated());
        $product->updateImages($request->file('images'));
        return redirect()->route('products.index', $product->category);


    }


    /**
     * Destroy product
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {

        if(is_array($product->images)){
            foreach ($product->images as $image){
                @unlink(public_path($image));
            }
        }
        $product->delete();

        return redirect()->route('products.index',$product->category);
    }
}
