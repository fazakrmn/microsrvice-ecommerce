const express = require("express");
const app = express();
const PORT = 3003;
app.use(express.json());

app.get("/health", (req, res) => {
    res.json({ service: "akun-service", status: "running" });
});

app.get("/users", (req, res) => {
    res.json({ service: "akun-service", data: [{ id: 1, name: "John Doe", email: "john.doe@example.com" }] });
});

app.listen(PORT, () => { console.log(`Akun Service berjalan pada port ${PORT}`); });