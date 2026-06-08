const express = require("express");
const app = express();
const PORT = 3004;
app.use(express.json());

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