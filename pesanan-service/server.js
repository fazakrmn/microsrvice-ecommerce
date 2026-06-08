const express = require("express");
const app = express();
const PORT = 3002;
app.use(express.json());

<<<<<<< HEAD
=======
let orders = [
    { id: 1, productId: 1, quantity: 2, total: 15000000 }
];

>>>>>>> d768543 (second commit)
app.get("/health", (req, res) => {
    res.json({ service: "pesanan-service", status: "running" });
});

app.get("/orders", (req, res) => {
<<<<<<< HEAD
    res.json({ service: "pesanan-service", data: [{ id: 1, productId: 1, quantity: 2, total: 15000000 }] });
=======
    res.json({ service: "pesanan-service", data: orders });
});

app.post("/orders", (req, res) => {
    const { productId, quantity, total } = req.body;
    const id = orders.length > 0 ? Math.max(...orders.map(o => o.id)) + 1 : 1;
    const newOrder = {
        id,
        productId: Number(productId),
        quantity: Number(quantity),
        total: Number(total),
        status: "pending"
    };
    orders.push(newOrder);
    res.status(201).json({ service: "pesanan-service", message: "Order berhasil dibuat", data: newOrder });
>>>>>>> d768543 (second commit)
});

app.listen(PORT, () => { console.log(`Pesanan Service berjalan pada port ${PORT}`); });