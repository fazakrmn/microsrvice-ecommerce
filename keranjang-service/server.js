const express = require("express");
const app = express();
const PORT = 3004;
app.use(express.json());

<<<<<<< HEAD
// Mengambil URL servis lain dari environment variables yang diatur Docker Compose
const PRODUCT_SERVICE_URL = process.env.PRODUCT_SERVICE_URL || "http://produk-service:3001";
const ORDER_SERVICE_URL = process.env.ORDER_SERVICE_URL || "http://pesanan-service:3002";

app.get("/products", async (req, res) => {
    try {
        const response = await fetch(`${PRODUCT_SERVICE_URL}/products`);
        const data = await response.json();
        res.json(data);
    } catch (error) {
        res.status(500).json({ message: "Gagal menghubungi Product Service", error: error.message });
    }
});

// Tambahkan rute fetch untuk /orders, /accounts, /cart, /payments dengan pola yang sama
app.listen(PORT, () => { console.log(`API Gateway berjalan pada port ${PORT}`); });
=======
let cart = [
    { id: 1, name: "Laptop", price: 7500000, quantity: 2 }
];

app.get("/health", (req, res) => {
    res.json({ service: "keranjang-service", status: "running" });
});

app.get("/cart", (req, res) => {
    res.json({ service: "keranjang-service", data: cart });
});

app.post("/cart", (req, res) => {
    const { name, price, quantity } = req.body;
    const id = cart.length > 0 ? Math.max(...cart.map(i => i.id)) + 1 : 1;
    const newItem = { id, name, price: Number(price), quantity: Number(quantity) || 1 };
    cart.push(newItem);
    res.status(201).json({ service: "keranjang-service", message: "Item ditambahkan ke keranjang", data: newItem });
});

app.delete("/cart/:id", (req, res) => {
    const id = Number(req.params.id);
    cart = cart.filter(item => item.id !== id);
    res.json({ service: "keranjang-service", message: `Item dengan ID ${id} dihapus dari keranjang` });
});

app.listen(PORT, () => { console.log(`Keranjang Service berjalan pada port ${PORT}`); });
>>>>>>> d768543 (second commit)
