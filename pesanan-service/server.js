const express = require("express");
const app = express();
const PORT = 3002;
app.use(express.json());

app.get("/health", (req, res) => {
    res.json({ service: "pesanan-service", status: "running" });
});

app.get("/orders", (req, res) => {
    res.json({ service: "pesanan-service", data: [{ id: 1, productId: 1, quantity: 2, total: 15000000 }] });
});

app.listen(PORT, () => { console.log(`Pesanan Service berjalan pada port ${PORT}`); });