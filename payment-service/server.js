const express = require("express");
const app = express();
const PORT = 3005;
app.use(express.json());

<<<<<<< HEAD
=======
let payments = [
    { id: 1, orderId: 1, amount: 15000000, status: "completed" }
];

>>>>>>> d768543 (second commit)
app.get("/health", (req, res) => {
    res.json({ service: "payment-service", status: "running" });
});

app.get("/payments", (req, res) => {
<<<<<<< HEAD
    res.json({ service: "payment-service", data: [{ id: 1, orderId: 1, amount: 15000000, status: "completed" }] });
=======
    res.json({ service: "payment-service", data: payments });
});

app.post("/payments", (req, res) => {
    const { orderId, amount, status } = req.body;
    const id = payments.length > 0 ? Math.max(...payments.map(p => p.id)) + 1 : 1;
    const newPayment = {
        id,
        orderId: Number(orderId),
        amount: Number(amount),
        status: status || "completed"
    };
    payments.push(newPayment);
    res.status(201).json({ service: "payment-service", message: "Pembayaran berhasil dicatat", data: newPayment });
>>>>>>> d768543 (second commit)
});

app.listen(PORT, () => { console.log(`Payment Service berjalan pada port ${PORT}`); });