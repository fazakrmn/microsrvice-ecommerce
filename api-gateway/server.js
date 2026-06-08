const express = require("express");
const app = express();
const PORT = 3000;

app.use(express.json());

app.get("/health", (req, res) => {
    res.json({ service: "keranjang-service", status: "running" });
});

app.get("/cart", (req, res) => {
    res.json({ service: "keranjang-service", data: [{ id: 1, name: "Laptop", price: 7500000, quantity: 2 }] });
});

app.listen(PORT, () => { console.log(`Keranjang Service berjalan pada port ${PORT}`); });

// Memastikan URL mengarah ke nama kontainer docker


app.use(express.json());

// Enable CORS
app.use((req, res, next) => {
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
    res.setHeader("Access-Control-Allow-Headers", "Content-Type, Authorization");
    if (req.method === "OPTIONS") {
        return res.sendStatus(200);
    }
    next();
});

const PRODUCT_SERVICE_URL = process.env.PRODUCT_SERVICE_URL || "http://produk-service:3001";
const ORDER_SERVICE_URL = process.env.ORDER_SERVICE_URL || "http://pesanan-service:3002";
const ACCOUNT_SERVICE_URL = process.env.ACCOUNT_SERVICE_URL || "http://akun-service:3003";
const CART_SERVICE_URL = process.env.CART_SERVICE_URL || "http://keranjang-service:3004";
const PAYMENT_SERVICE_URL = process.env.PAYMENT_SERVICE_URL || "http://payment-service:3005";

// Health check
app.get("/health", (req, res) => {
    res.json({ service: "api-gateway", status: "running" });
});

// Rute untuk Produk
app.get("/products", async (req, res) => {
    try {
        const response = await fetch(`${PRODUCT_SERVICE_URL}/products`);
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

app.post("/products", async (req, res) => {
    try {
        const response = await fetch(`${PRODUCT_SERVICE_URL}/products`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(req.body)
        });
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

// Rute untuk Akun
app.get("/accounts", async (req, res) => {
    try {
        const response = await fetch(`${ACCOUNT_SERVICE_URL}/accounts`);
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

// Rute untuk Pesanan
app.get("/orders", async (req, res) => {
    try {
        const response = await fetch(`${ORDER_SERVICE_URL}/orders`);
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

app.post("/orders", async (req, res) => {
    try {
        const response = await fetch(`${ORDER_SERVICE_URL}/orders`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(req.body)
        });
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

// Rute untuk Keranjang
app.get("/cart", async (req, res) => {
    try {
        const response = await fetch(`${CART_SERVICE_URL}/cart`);
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

app.post("/cart", async (req, res) => {
    try {
        const response = await fetch(`${CART_SERVICE_URL}/cart`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(req.body)
        });
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

app.delete("/cart/:id", async (req, res) => {
    try {
        const response = await fetch(`${CART_SERVICE_URL}/cart/${req.params.id}`, {
            method: "DELETE"
        });
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

// Rute untuk Pembayaran
app.get("/payments", async (req, res) => {
    try {
        const response = await fetch(`${PAYMENT_SERVICE_URL}/payments`);
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

app.post("/payments", async (req, res) => {
    try {
        const response = await fetch(`${PAYMENT_SERVICE_URL}/payments`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(req.body)
        });
        res.json(await response.json());
    } catch (e) { res.status(500).json({ error: e.message }); }
});

app.listen(PORT, () => {
    console.log(`API Gateway berjalan pada port ${PORT}`);
});