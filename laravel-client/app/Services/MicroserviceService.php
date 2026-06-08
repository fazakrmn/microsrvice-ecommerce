<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MicroserviceService
{
    protected string $gatewayUrl;

    public function __construct()
    {
        $this->gatewayUrl = env('MICROSERVICE_GATEWAY_URL', 'http://localhost:3000');
    }

    public function getProducts()
    {
        try {
            $response = Http::get("{$this->gatewayUrl}/products");
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to get products: " . $e->getMessage());
            return ['service' => 'produk-service', 'data' => []];
        }
    }

    public function addProduct(string $name, float $price)
    {
        try {
            $response = Http::post("{$this->gatewayUrl}/products", [
                'name' => $name,
                'price' => $price
            ]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to add product: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function getCart()
    {
        try {
            $response = Http::get("{$this->gatewayUrl}/cart");
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to get cart: " . $e->getMessage());
            return ['service' => 'keranjang-service', 'data' => []];
        }
    }

    public function addToCart(string $name, float $price, int $quantity = 1)
    {
        try {
            $response = Http::post("{$this->gatewayUrl}/cart", [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to add to cart: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function removeFromCart(int $id)
    {
        try {
            $response = Http::delete("{$this->gatewayUrl}/cart/{$id}");
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to remove from cart: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function getAccounts()
    {
        try {
            $response = Http::get("{$this->gatewayUrl}/accounts");
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to get accounts: " . $e->getMessage());
            return ['service' => 'akun-service', 'data' => []];
        }
    }

    public function getOrders()
    {
        try {
            $response = Http::get("{$this->gatewayUrl}/orders");
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to get orders: " . $e->getMessage());
            return ['service' => 'pesanan-service', 'data' => []];
        }
    }

    public function createOrder(int $productId, int $quantity, float $total)
    {
        try {
            $response = Http::post("{$this->gatewayUrl}/orders", [
                'productId' => $productId,
                'quantity' => $quantity,
                'total' => $total
            ]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to create order: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function getPayments()
    {
        try {
            $response = Http::get("{$this->gatewayUrl}/payments");
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to get payments: " . $e->getMessage());
            return ['service' => 'payment-service', 'data' => []];
        }
    }

    public function createPayment(int $orderId, float $amount, string $status = 'completed')
    {
        try {
            $response = Http::post("{$this->gatewayUrl}/payments", [
                'orderId' => $orderId,
                'amount' => $amount,
                'status' => $status
            ]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Failed to create payment: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}
