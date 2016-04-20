var router = require('./router');
var server = require('./routerserver');

server.start(router.route);