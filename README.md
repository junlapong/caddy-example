# Caddy v2

[Caddyfile Directives](https://caddyserver.com/docs/caddyfile/directives)

## Run

```
caddy run
## or
caddy run --config ./Caddyfile
## or
caddy run --config ./caddy.json
```

## Run as Background Service

```
caddy start
## and
caddy stop
## and
caddy reload
## or
caddy reload --config ./Caddyfile
```

## Notes

__Convert__ `Caddyfile` to `caddy.json`

```
caddy adapt --config ./Caddyfile > caddy.json
```
