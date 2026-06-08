const express = require("express");
const app = express();
const PORT = 3005;
app.use(express.json());

app.get("/health", (req, res) => {
    res.json({ service: "payment-service", status: "running" });
});

app.get("/payments", (req, res) => {
    res.json({ service: "payment-service", data: [{ id: 1, orderId: 1, amount: 15000000, status: "completed" }] });
});

app.listen(PORT, () => { console.log(`Payment Service berjalan pada port ${PORT}`); });