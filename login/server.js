const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'dasboard_db'
});

db.connect(err => {
    if (err) {
        console.error('Error connecting to the database:', err);
        return;
    }
    console.log('Connected to the MySQL database.');
});

app.post('/api/menus', (req, res) => {
    const { title, link, subItems } = req.body;
    db.query('INSERT INTO menus (title, link) VALUES (?, ?)', [title, link], (err, result) => {
        if (err) {
            return res.status(500).send(err);
        }
        const menuId = result.insertId;
        const subMenuQueries = subItems.map(subItem => {
            return new Promise((resolve, reject) => {
                db.query('INSERT INTO submenus (menu_id, title, link) VALUES (?, ?, ?)', [menuId, subItem.title, subItem.link], (err, result) => {
                    if (err) {
                        return reject(err);
                    }
                    resolve(result);
                });
            });
        });
        Promise.all(subMenuQueries)
            .then(() => res.status(201).send('Menu created successfully'))
            .catch(err => res.status(500).send(err));
    });
});

app.get('/api/menus', (req, res) => {
    db.query('SELECT * FROM menus', (err, menus) => {
        if (err) {
            return res.status(500).send(err);
        }
        const menuQueries = menus.map(menu => {
            return new Promise((resolve, reject) => {
                db.query('SELECT * FROM submenus WHERE menu_id = ?', [menu.id], (err, submenus) => {
                    if (err) {
                        return reject(err);
                    }
                    menu.subItems = submenus;
                    resolve(menu);
                });
            });
        });
        Promise.all(menuQueries)
            .then(results => res.status(200).json(results))
            .catch(err => res.status(500).send(err));
    });
});

app.put('/api/menus/:id', (req, res) => {
    const { id } = req.params;
    const { title, link, subItems } = req.body;
    db.query('UPDATE menus SET title = ?, link = ? WHERE id = ?', [title, link, id], (err, result) => {
        if (err) {
            return res.status(500).send(err);
        }
        db.query('DELETE FROM submenus WHERE menu_id = ?', [id], (err, result) => {
            if (err) {
                return res.status(500).send(err);
            }
            const subMenuQueries = subItems.map(subItem => {
                return new Promise((resolve, reject) => {
                    db.query('INSERT INTO submenus (menu_id, title, link) VALUES (?, ?, ?)', [id, subItem.title, subItem.link], (err, result) => {
                        if (err) {
                            return reject(err);
                        }
                        resolve(result);
                    });
                });
            });
            Promise.all(subMenuQueries)
                .then(() => res.status(200).send('Menu updated successfully'))
                .catch(err => res.status(500).send(err));
        });
    });
});

app.delete('/api/menus/:id', (req, res) => {
    const { id } = req.params;
    db.query('DELETE FROM menus WHERE id = ?', [id], (err, result) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.status(200).send('Menu deleted successfully');
    });
});

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});