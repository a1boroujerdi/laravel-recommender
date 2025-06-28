<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EcomAI\Recommender\Recommender;

class RecommendationController extends Controller
{
    protected $recommender;

    public function __construct()
    {
        // Initialize the recommender with the Flask API URL from config
        $this->recommender = new Recommender(config('services.recommender.url'));
    }


    public function index()
    {
        return view('home');
    }


    public function getRecommendations(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
        ]);

        $productName = $request->input('product');

        try {
            $recommendations = $this->recommender->getRecommendations($productName);
            return response()->json($recommendations);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function trainModel(Request $request)
    {
        $request->validate([
            'min_support' => 'sometimes|numeric|min:0|max:1',
            'min_confidence' => 'sometimes|numeric|min:0|max:1',
        ]);

        $minSupport = $request->input('min_support', 0.01);
        $minConfidence = $request->input('min_confidence', 0.1);

        try {
            $result = $this->recommender->trainModel($minSupport, $minConfidence);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function addOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*' => 'required|string|max:255',
        ]);

        $orderId = $request->input('order_id');
        $products = $request->input('products');

        try {
            $result = $this->recommender->addOrder($orderId, $products);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

  
    public function addProduct(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*' => 'required|string|max:255',
        ]);

        $orderId = $request->input('order_id');
        $products = $request->input('products');

        try {
            // Call the recommender's addOrder method
            $result = $this->recommender->addOrder($orderId, $products);

            if (isset($result['error'])) {
                return response()->json(['error' => $result['error']], 500);
            }

            return response()->json([
                'message' => $result['message'],
                'order_id' => $orderId,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
