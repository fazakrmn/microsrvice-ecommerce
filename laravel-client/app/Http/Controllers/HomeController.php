<?php

namespace App\Http\Controllers;

use App\Services\MicroserviceService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected MicroserviceService $microservice;

    public function __construct(MicroserviceService $microservice)
    {
        $this->microservice = $microservice;
    }

    public function index()
    {
        // Load data from all microservices via API Gateway
        $productsResponse = $this->microservice->getProducts();
        $cartResponse = $this->microservice->getCart();
        $ordersResponse = $this->microservice->getOrders();
        $accountsResponse = $this->microservice->getAccounts();
        $paymentsResponse = $this->microservice->getPayments();

        $products = $productsResponse['data'] ?? [];
        $cart = $cartResponse['data'] ?? [];
        $orders = $ordersResponse['data'] ?? [];
        $account = ($accountsResponse['data'] ?? [[]])[0] ?? null;
        $payments = $paymentsResponse['data'] ?? [];

        // Sum cart total
        $cartTotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('dashboard', compact('products', 'cart', 'orders', 'account', 'payments', 'cartTotal'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        $this->microservice->addProduct($request->name, $request->price);

        return redirect()->route('home')->with('success', 'Produk berhasil ditambahkan ke katalog!');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1'
        ]);

        $this->microservice->addToCart($request->name, $request->price, $request->quantity);

        return redirect()->route('home')->with('success', 'Item berhasil ditambahkan ke keranjang!');
    }

    public function removeFromCart($id)
    {
        $this->microservice->removeFromCart((int)$id);

        return redirect()->route('home')->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cartResponse = $this->microservice->getCart();
        $cart = $cartResponse['data'] ?? [];

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang belanja Anda kosong!');
        }

        // Process checkout
        foreach ($cart as $item) {
            $productId = $item['id'] ?? 1;
            $total = $item['price'] * $item['quantity'];

            // 1. Create order
            $orderRes = $this->microservice->createOrder($productId, $item['quantity'], $total);
            
            if (isset($orderRes['data']['id'])) {
                $orderId = $orderRes['data']['id'];
                
                // 2. Create payment record
                $this->microservice->createPayment($orderId, $total, 'completed');
            }

            // 3. Remove from cart
            if (isset($item['id'])) {
                $this->microservice->removeFromCart($item['id']);
            }
        }

        return redirect()->route('home')->with('success', 'Checkout berhasil! Pesanan Anda telah diproses dan pembayaran dikonfirmasi.');
    }
}
