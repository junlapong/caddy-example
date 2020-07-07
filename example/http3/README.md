# Setup HTTPS Server

[How to run HTTP/3 with Caddy 2](https://ma.ttias.be/how-run-http-3-with-caddy-2/)

## Certificates

__Generate Certificates__

```
mkdir cert && cd cert
mkcert localhost 127.0.0.1 ::1 domain.com "*.domain.com"
```

```
./cert
├── localhost.pem
└── localhost-key.pem
```

__Create__ `Caddyfile`

```
{
    experimental_http3
}

localhost:8443 {
    root * ../../www

    header {
        -Server

        # enable HSTS
        Strict-Transport-Security max-age=31536000;

        # disable clients from sniffing the media type
        X-Content-Type-Options nosniff
        
        # clickjacking protection
        X-Frame-Options DENY

        # keep referrer data off of HTTP connections
        Referrer-Policy no-referrer-when-downgrade
    }

    # tls internal
    tls cert/localhost.pem cert/localhost-key.pem

    encode zstd gzip

    file_server browse
}
```

## Run

```
caddy run --config ./Caddyfile
```

__Check__

```
$ curl -Ik http://localhost/    

HTTP/1.1 308 Permanent Redirect
Connection: close
Location: https://localhost:8443/
Server: Caddy
Date: Wed, 06 May 2020 08:38:38 GMT


$ curl -Ik --http3 https://localhost:8443/

HTTP/2 200 
accept-ranges: bytes
content-type: text/html; charset=utf-8
etag: "q9wexae"
last-modified: Wed, 06 May 2020 07:17:34 GMT
referrer-policy: no-referrer-when-downgrade
strict-transport-security: max-age=31536000;
x-content-type-options: nosniff
x-frame-options: DENY
content-length: 14
date: Wed, 06 May 2020 08:39:00 GMT
```
