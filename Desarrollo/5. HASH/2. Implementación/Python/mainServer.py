from http.server import BaseHTTPRequestHandler, HTTPServer
import logging
import json
from HASH import HASH


class BasicServer(BaseHTTPRequestHandler):
    def _set_response(self):
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.end_headers()

    def do_GET(self):
        self._set_response()
        self.wfile.write(json.dumps('Hola').encode('utf-8'))

    def do_POST(self):
        content_length = int(self.headers['Content-Length'])  # <--- Gets the size of data
        post_data = self.rfile.read(content_length)  # <--- Gets the data itself
        logging.info('POST request,\nPath: ' + str(self.path) + '\nHeaders:\n' +
                     str(self.headers) + 'Body:\n' + post_data.decode('utf-8') + '\n')

        requestJson = json.loads(post_data)

        if requestJson['type'] == 'encode':
            hash = HASH(requestJson['word'], requestJson['key'])
            requestJson['response'] = hash.encode256()

        if requestJson['type'] == 'decode':
            hash = HASH('decode', requestJson['key'])
            requestJson['response'] = hash.decode256(requestJson['word'])

        responseJson = json.dumps(requestJson).encode('utf-8')

        self._set_response()
        self.wfile.write(responseJson)


def run(server_class=HTTPServer, handler_class=BasicServer, port=8000):
    logging.basicConfig(level=logging.INFO)
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    logging.info('Starting httpd...\n')
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        pass
    httpd.server_close()
    logging.info('Stopping httpd...\n')


if __name__ == '__main__':
    from sys import argv

    if len(argv) == 2:
        run(port=int(argv[1]))
    else:
        run()

# {
#	"word":"contraseña",
#	"key": "key",
#	"type":"encode",
#	"response":""
# }