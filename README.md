# CORS Proxy

All requests send to this proxy will be proxied to the GET parameter ?route=

Traffic listens to port 80

Example docker-compose.yml
```
version: "2"
services:
    cors-proxy:
        image: nielsvermaut/cors-proxy
        ports:
            - 82:80
```

````
$ curl https://localhost:82/?route=https://requestb.in/15n7upf1
````

## Check logs

````
$ docker exec -ti {DOCKER-CONTAINER} tail -f /var/log/nginx/error.log
````