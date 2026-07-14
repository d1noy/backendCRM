<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CategoryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Categories list
     *
     * @return Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::all()
        ]);

    }

    /**
     * @return Factory|View|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Create Category
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        Category::query()->create($request->validated());
        return redirect()->route('home');
    }

    /**
     * Category form
     *
     * @param Category $category
     * @return Factory|View|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }


    /**
     * Update Category
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('home');
    }

    /**
     * Destroy category
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('home');
    }
}
