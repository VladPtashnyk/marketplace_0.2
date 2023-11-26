<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Site\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the Subcategories.
     *
     * @return View
     */
    public function index(): View
    {
        $subcategoryModel = new Subcategory();

        $subcategories = $subcategoryModel->readAllSubcategories();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Display Subcategory creation form
     *
     * @return View
     */
    public function create(): View
    {
        $categoryModel = new Category();

        $categories = $categoryModel->readCategoriesNames();

        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Create Subcategory
     *
     * @param SubcategoryRequest $request
     * @return RedirectResponse
     */
    public function store(SubcategoryRequest $request): RedirectResponse
    {
        if ($request->has('createSubcategory')) {
            $subcategoryModel = new Subcategory();

            $subcategoryModel->storeSubcategory($request->validated());

        }

        return redirect()->route('admin.subcategory');
    }

    /**
     * Display Subcategory update form
     *
     * @param int $idSubcategory
     * @return View
     */
    public function edit(int $idSubcategory): View
    {
        $categoryModel = new Category();
        $subcategoryModel = new Subcategory();

        $categories = $categoryModel->readCategoriesNames();
        $subcategory = $subcategoryModel->readSubcategory($idSubcategory);

        return view('admin.subcategories.update', compact('categories', 'subcategory'));
    }

    /**
     * Update Subcategory
     *
     * @param SubcategoryRequest $request
     * @return RedirectResponse
     */
    public function update(SubcategoryRequest $request): RedirectResponse
    {
        if ($request->has('updateSubcategory')) {
            $subcategoryModel = new Subcategory();

            $subcategoryModel->updateSubcategory($request->post('id_subcategory'), $request->validated());
        }

        return redirect()->route('admin.subcategory');
    }

    /**
     * Delete Subcategory & all its Products
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->has('deleteSubcategory')) {
            $subcategoryModel = new Subcategory();
            $productModel = new Product();

            $idSubcategory = $request->post('id_subcategory');
            $productModel->deleteSubcategoryProducts($idSubcategory);
            $subcategoryModel->deleteSubcategory($idSubcategory);
        }

        return back();
    }

    /**
     * Restore Subcategory & all its Products
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function restore(Request $request): RedirectResponse
    {
        if ($request->has('restoreSubcategory')) {
            $subcategoryModel = new Subcategory();
            $productModel = new Product();

            $idSubcategory = $request->post('id_subcategory');
            $productModel->restoreSubcategoryProducts($idSubcategory);
            $subcategoryModel->restoreSubcategory($idSubcategory);
        }

        return back();
    }
}
