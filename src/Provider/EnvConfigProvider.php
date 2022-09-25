<?php

declare(strict_types=1);

namespace MathieuDumoutier\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class EnvConfigProvider extends AbstractProvider
{
    public string $scopes;
    public string $baseUrl;
    public string $apiBaseUrl;

    public function __construct(array $options = [], array $collaborators = [])
    {
        parent::__construct($options, $collaborators);
        $this->scopes = $options['scopes'];
        $this->baseUrl = $options['app_url'];
        $this->apiBaseUrl = $options['api_url'];
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getBaseAuthorizationUrl(): string
    {
        return $this->getBaseUrl().'/authorize';
    }

    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->getBaseUrl().'/token';
    }

    private function getApiBaseUrl():string
    {
        return $this->apiBaseUrl;
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return $this->getApiBaseUrl();
    }

    protected function getDefaultScopes(): array
    {
        return [
            $this->scopes,
        ];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (299 < $response->getStatusCode() || !empty($data['error'])) {
            throw new IdentityProviderException(
                $data['error'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token): ResourceOwnerInterface
    {
        return new ResourceOwner($response);
    }

    protected function getAuthorizationHeaders($token = null): array
    {
        return [
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json',
        ];
    }
}
