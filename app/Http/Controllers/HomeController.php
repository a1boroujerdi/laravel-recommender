<?php

namespace App\Http\Controllers;

use EcomAI\Recommender\Facades\Recommender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->except(['testProductRecommendations']);
    }


    public function index()
    {
        // Get recommendations for the current user
        $recommendations = Recommender::getUserRecommendations(1, 5);

        return view('home', [
            'recommendations' => $recommendations
        ]);
    }


    public function trackProductView($productId)
    {
        $metadata = [
            'duration' => request('duration', 0),
            'source' => request('source', 'direct'),
            'page' => request('page', 'product')
        ];

        $success = Recommender::trackBehavior(
            1,
            $productId,
            'view',
            $metadata
        );

        return response()->json([
            'success' => $success,
            'message' => $success ? 'View tracked successfully' : 'Failed to track view'
        ]);
    }


    public function trackAddToCart($productId)
    {
        $metadata = [
            'quantity' => request('quantity', 1),
            'price' => request('price', 0),
            'variant' => request('variant', null)
        ];

        $success = Recommender::trackBehavior(
            1,
            $productId,
            'cart',
            $metadata
        );

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Add to cart tracked successfully' : 'Failed to track add to cart'
        ]);
    }


    public function trackPurchase($productId)
    {
        $metadata = [
            'quantity' => request('quantity', 1),
            'price' => request('price', 0),
            'order_id' => request('order_id'),
            'payment_method' => request('payment_method', 'credit_card')
        ];

        $success = Recommender::trackBehavior(
            1,
            $productId,
            'purchase',
            $metadata
        );

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Purchase tracked successfully' : 'Failed to track purchase'
        ]);
    }


    public function testProductRecommendations($productId)
    {
        $limit = request('limit', 5);
        $recommendations = Recommender::getProductRecommendations($productId, $limit);

        return response()->json([
            'product_id' => $productId,
            'recommendations' => $recommendations,
            'count' => $recommendations->count()
        ]);
    }

    public function testUserRecommendations()
    {
        $limit = request('limit', 5);
        $recommendations = Recommender::getUserRecommendations(1, $limit);

        return response()->json([
            'user_id' => 1,
            'recommendations' => $recommendations,
            'count' => $recommendations->count()
        ]);
    }


    public function testRecommenderDashboard()
    {
        try {
            // Get all product IDs for testing
            $productIds = \DB::table('products')->take(5)->pluck('id');

            // If no products found, create a default array with IDs 1-5
            if ($productIds->isEmpty()) {
                $productIds = collect([1, 2, 3, 4, 5]);
            }
        } catch (\Exception $e) {
            // If the products table doesn't exist, use default IDs
            $productIds = collect([1, 2, 3, 4, 5]);
        }

        // Get recommendations for each product
        $productRecommendations = [];
        foreach ($productIds as $productId) {
            $productRecommendations[$productId] = Recommender::getProductRecommendations($productId, 3);
        }

        // Get user recommendations
        $userRecommendations = Recommender::getUserRecommendations(1, 5);

        return view('recommender.dashboard', [
            'productIds' => $productIds,
            'productRecommendations' => $productRecommendations,
            'userRecommendations' => $userRecommendations
        ]);
    }
}
