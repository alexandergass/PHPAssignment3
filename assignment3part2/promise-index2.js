const http = require('http');
const { parse } = require('querystring');
var db = require('./promise-db');

function collectRequestData(request, callback) {
    const FORM_URLENCODED = 'application/x-www-form-urlencoded';
    if(request.headers['content-type'] === FORM_URLENCODED) {
        let body = '';
        request.on('data', chunk => {
            body += chunk.toString();
        });
        request.on('end', () => {
            callback(parse(body));
        });
    }
    else {
        callback(null);
    }
}

const server = http.createServer((req, res) => {
    if (req.method === 'POST') {
        collectRequestData(req, result => {
            
            //Present the data
            res.end(`First Name: ${result.fname} \n`+
                    `Last Name : ${result.lname}`);

            //Insert data from submit form into database table mynodedb
            var fname = result.fname;
            var lname = result.lname;

            db.insert(fname, lname)
                .then(insertId => {
                    return db.select(insertId);
                })
                .then(result=>{
                    console.log('result', result);
                })
                .catch( err => {
                    console.log("Something went wrong", err);
                });

        });
    } 
    else {
        //Form to submit data
        res.end(`
            <!doctype html>
            <html>
            <body>
                <form action="/" method="post">
                    First Name <input type="text" name="fname" /><br /><br />
                    Last Name <input type="text" name="lname" /><br /><br />
                    <button>Submit</button>
                </form>
            </body>
            </html>
        `);
    }
});
server.listen(3000);