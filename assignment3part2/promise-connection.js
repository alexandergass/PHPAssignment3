var mysql = require('mysql');
// var mysql = require('promise-mysql');

var connection = mysql.createConnection({
    host: "localhost", 
    port: 3306,
    user: "root",
    password: "root",
    database: "mynodedb"
});

connection.connect();

module.exports = connection;