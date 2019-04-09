# rancherize-rabbitmq
rabbitmq rancherize plugin

## Install
If you are using the rancherize docker container:

	rancherize plugin:register ipunkt/rancherize-rabbitmq

If you are using rancherize via composer:

	rancherize plugin:install ipunkt/rancherize-rabbitmq:^1.0.0
	
## Use
Add the following section to your environment or `default`-section of your rancherize.json:

```json
"rabbitmq":{
	"port":PORT_TO_EXPOSE_ON
}
```

Example:
```json
"rabbitmq":{
	"port":9082
}
```

## Details
It will set the following variables on your main service:
RMQ_HOST: `rabbitmq`
RMQ_PORT: `5672`
RMQ_USERNAME: `guest`
RMQ_PASSWORD: `guest`
RMQ_VHOST: `/`
