<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resource\Traits\Components;
use App\Http\Resource\Traits\Products;
use App\Models\Admin\Category;
use App\Models\Admin\Producer;
use App\Models\Admin\Subcategory;
use App\Models\Site\Product;
use App\Models\Site\Seller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProductController extends Controller
{
    use Components, Products;

    /**
    * Display a listing of the Products.
     *
     * @param Request $request
     * @return View
    */
    public function index(Request $request): View
    {
        $productModel = new Product();
        $producerModel = new Producer();
        $categoryModel = new Category();
        $subcategoryModel = new Subcategory();
        $sellerModel = new Seller();

        // Using the filters for Products
        $filters = $this->getFilters($request);

        // Getting Products based on filters
        $products = $productModel->readProducts($filters, 4);

        // Preparing Product for view
        foreach ($products as $product) {
            $this->formatProduct($product);
        }

        // Getting additional data
        $producers = $producerModel->readProducersNames();
        $categories = $categoryModel->readCategoriesNames();
        $subcategories = $subcategoryModel->readSubcategoriesNames();
        $sellers = $sellerModel->readSellersNames();

        $producersSelect = new HtmlString($this->customSelectData($producers, 'producer', $filters));
        $categoriesSelect = new HtmlString($this->customSelectData($categories, 'category', $filters));
        $subcategoriesSelect = new HtmlString($this->customSelectData($subcategories, 'subcategory', $filters));
        $sellersSelect = new HtmlString($this->customSelectData($sellers, 'seller', $filters));

        return view('site.products.index', compact('products', 'producersSelect', 'categoriesSelect', 'subcategoriesSelect', 'sellersSelect', 'filters'));
    }

    /**
     * Display a listing of the Products from given Seller.
     *
     * @param Request $request
     * @return View
     */
    public function sellerProducts(Request $request): View
    {
        $productModel = new Product();

        $idSeller = $request->session()->get('id_seller');
        $products = $productModel->readSellerProducts($idSeller);

        return view('site.seller.products', compact('products'));
    }

    /**
     * Display one chosen Product.
     *
     * @param int $idProduct
     * @return View
     */
    public function show(int $idProduct): View
    {
        $productModel = new Product();

        $product = $productModel->readProduct($idProduct);
        $this->formatProduct($product);

        return view('site.products.show', compact('product'));
    }

    /**
     * Display Product creation form
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $producerModel = new Producer();
        $categoryModel = new Category();
        $subcategoryModel = new Subcategory();

        $idSeller = $request->session()->get('id_seller');
        $producers = $producerModel->readProducersNames();
        $categories = $categoryModel->readCategoriesNames();
        $subcategories = $subcategoryModel->readSubcategoriesNames();

        return view('site.products.create', compact('idSeller', 'producers', 'categories', 'subcategories'));
    }

    /**
     * Create Product
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        if ($request->has('createProduct')) {
            $productModel = new Product();

            // Create Product
            $productModel->storeProduct($request->validated());

            // Save Media
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $productModel->addMedia($image)
                        ->toMediaCollection('products');
                }
            }
        }

        return redirect()->route('product.my_products');
    }

    /**
     * Display Product update form
     *
     * @param int $idProduct
     * @return View
     */
    public function edit(int $idProduct): View
    {
        $productModel = new Product();
        $producerModel = new Producer();
        $categoryModel = new Category();
        $subcategoryModel = new Subcategory();

        $product = $productModel->readProduct($idProduct);
        $producers = $producerModel->readProducersNames();
        $categories = $categoryModel->readCategoriesNames();
        $subcategories = $subcategoryModel->readSubcategoriesNames();

        return view('site.products.update', compact('product', 'producers', 'categories', 'subcategories'));
    }

    /**
     * Update Product
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function update(ProductRequest $request): RedirectResponse
    {
        if ($request->has('updateProduct')) {
            $productModel = new Product();

            // Update Product
            $idProduct = $request->post('id_product');
            $productModel->updateProduct($idProduct, $request->validated());

            // Update Media
            if ($request->hasFile('images')) {
                $product = $productModel->find($idProduct);
                // Optional Delete old media
                if ($request->post('delete_media')) {
                    $medias = $product->media;
                    foreach ($medias as $media) {
                        $media->delete($media->id);
                    }
                }
                // Save new Media
                $images = $request->file('images');
                foreach ($images as $image) {
                    $product->addMedia($image)
                        ->toMediaCollection('products');
                }
            }
        }

        return redirect()->route('product.my_products');
    }

    /**
     * Delete Product
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->has('deleteProduct')) {
            $productModel = new Product();

            $idProduct = $request->post('id_product');
            $productModel->deleteProduct($idProduct);
        }

        return back();
    }

    /**
     * Restore Product
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function restore(Request $request): RedirectResponse
    {
        if ($request->has('restoreProduct')) {
            $productModel = new Product();

            $idProduct = $request->post('id_product');
            $productModel->restoreProduct($idProduct);
        }

        return back();
    }
}
