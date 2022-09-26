<?php

declare(strict_types=1);

namespace PlaneteCroisiere\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class ResourceOwner implements ResourceOwnerInterface
{
    public function __construct(protected array $response = [])
    {
    }

    public function getId(): string
    {
        return $this->response['email'];
    }

    public function toArray(): array
    {
        return $this->response;
    }
}
