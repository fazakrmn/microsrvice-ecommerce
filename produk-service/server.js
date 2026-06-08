const express = require("express");
const app = express();
const PORT = 3001;
app.use(express.json());

<<<<<<< HEAD
=======
let products = [
    { id: 1, name: "Laptop", price: 7500000 },
    { id: 2, name: "Smartphone", price: 3500000 },
    { id: 3, name: "Headphones", price: 800000 }
];

>>>>>>> d768543 (second commit)
app.get("/health", (req, res) => {
    res.json({ service: "produk-service", status: "running" });
});

app.get("/products", (req, res) => {
<<<<<<< HEAD
    res.json({ service: "produk-service", data: [{ id: 1, name: "Laptop", price: 7500000 }] });
=======
    res.json({ service: "produk-service", data: products });
});

app.post("/products", (req, res) => {
    const { name, price } = req.body;
    if (!name || !price) {
        return res.status(400).json({ service: "produk-service", error: "Name and price are required" });
    }
    const id = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
    const newProduct = { id, name, price: Number(price) };
    products.push(newProduct);
    res.status(201).json({ service: "produk-service", message: "Produk berhasil ditambahkan", data: newProduct });
>>>>>>> d768543 (second commit)
});

app.listen(PORT, () => { console.log(`Product Service berjalan pada port ${PORT}`); });