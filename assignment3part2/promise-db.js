var connection = require('./promise-connection');

module.exports = {
    select (id) {
        return new Promise( (resolve, reject) => {
            var sql = "SELECT * FROM users WHERE id = ?";
            var values = [id];
            connection.query(sql, values, (err, results) => {
                if (err) {
                    return reject(err);
                }
                resolve(results);
            });
        });
    },

    insert (fname, lname) {
        return new Promise( (resolve, reject) => {
            var sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            var values = [fname, lname];
            connection.query(sql, values, (err, result) => {
                if (err) {
                    return reject(err);
                }
                resolve(result.insertId);
            });
        });
    }
};