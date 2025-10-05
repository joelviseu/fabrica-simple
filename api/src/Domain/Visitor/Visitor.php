<?php

declare(strict_types=1);

namespace App\Domain\Visitor;

use JsonSerializable;

class Visitor implements JsonSerializable
{
    private ?int $id;
    private string $ipAddress;
    private string $userAgent;
    private string $page;
    private string $action;
    private ?string $data;
    private string $createdAt;
    private int $viewportWidth;
    private bool $isMobile;

    public function __construct(
        ?int $id,
        string $ipAddress,
        string $userAgent,
        string $page,
        string $action,
        ?string $data = null,
        int $viewportWidth = 0,
        bool $isMobile = false,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
        $this->page = $page;
        $this->action = $action;
        $this->data = $data;
        $this->viewportWidth = $viewportWidth;
        $this->isMobile = $isMobile;
        $this->createdAt = $createdAt ?? date('Y-m-d H:i:s');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function getViewportWidth(): int
    {
        return $this->viewportWidth;
    }

    public function isMobile(): bool
    {
        return $this->isMobile;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
            'page' => $this->page,
            'action' => $this->action,
            'data' => $this->data,
            'viewport_width' => $this->viewportWidth,
            'is_mobile' => $this->isMobile,
            'created_at' => $this->createdAt,
        ];
    }
}