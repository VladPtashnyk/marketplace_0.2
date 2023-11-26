<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the Reviews.
     *
     * @return View
     */
    public function index(): View
    {
        $reviewModel = new Review();

        $reviews = $reviewModel->readAllReview();

        $statuses = [
            1 => trans('admin/reviews.status1'),
            2 => trans('admin/reviews.status2'),
        ];

        foreach ($reviews as $id => $review) {
            if (isset($review->product)) {
                $review->status_id = $review->status;
                $review->status = $statuses[$review->status];
                $review->client_id = $review->client->id_client;
                $review->client_name = $review->client->name;
                $review->client_surname = $review->client->surname;
                $review->seller_id = $review->product->seller->id_seller;
                $review->seller_name = $review->product->seller->name;
                $review->seller_surname = $review->product->seller->surname;
                $review->product_id = $review->product->id_product;
                $review->product_name = $review->product->name;
                $review->product_url = route('product.show', $review->product->id_product);
            }
        }

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Change Review's status or Delete Review if Product was soft_deleted.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function change(Request $request): RedirectResponse
    {
        $reviewModel = new Review();

        $idReview = $request->post('id_review');
        $reviewStatus = $reviewModel->readReview($idReview)->status;
            // Approve
        if ($request->has('approveReview') && $reviewStatus == 1) {
            $reviewModel->updateReview($idReview,['status' => 2]);

            // Disapprove
        } elseif ($request->has('disapproveReview') && $reviewStatus == 2) {
            $reviewModel->updateReview($idReview,['status' => 1]);

            // Delete
        } elseif ($request->has('deleteReview')) {
            $reviewModel->destroyReview($idReview);
        }

        return back();
    }
}
