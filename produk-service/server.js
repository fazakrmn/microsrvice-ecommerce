const express = require("express");
const app = express();
const PORT = 3001;
app.use(express.json());

app.get("/health", (req, res) => {
    res.json({ service: "produk-service", status: "running" });
});

app.get("/products", (req, res) => {
    res.json({ service: "produk-service", data: [{ id: 1, name: "Laptop", price: 7500000 }] });
});

app.listen(PORT, () => { console.log(`Product Service berjalan pada port ${PORT}`); });