# OAuth2 Client generic provider for config by .env file

This package provides OAuth 2.0 generic support from config .env file for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require planete-croisiere/oauth2-envconfig
```

## Usage

Usage is the same as The League's OAuth client, using `\PlaneteCroisiere\OAuth2\Client\Provider\EnvConfig` as the provider.

## knpuniversity/oauth2-client-bundle configuration example

```yaml
knpu_oauth2_client:
    clients:
        youapp_oauth:
            type: generic
            provider_class: PlaneteCroisiere\OAuth2\Client\Provider\EnvConfigProvider
            provider_options:
                "scopes": '%env(OAUTH2_SCOPES)%'
                "app_url": '%env(OAUTH2_BASE_APP_URL)%'    
                "api_url": '%env(OAUTH2_BASE_API_URL)%'    
            client_id: '%env(OAUTH2_CLIENT_ID)%'
            client_secret: '%env(OAUTH2_CLIENT_SECRET)%'
            redirect_route: oauth2_check
            redirect_params: {}
            use_state: false
```

You must define the 6 environment variables :
* OAUTH2_CLIENT_ID 
* OAUTH2_CLIENT_SECRET
* OAUTH2_SCOPES
* OAUTH2_BASE_APP_URL
* OAUTH2_BASE_API_URL

You must create the route "oauth2_check".
