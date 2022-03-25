<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Response\Bits;

use Padhie\TwitchApiBundle\Response\ResponseInterface;

final class ExtensionTransaction implements ResponseInterface
{
    private string $id;
    private string $timestamp;
    private string $broadcasterId;
    private string $broadcasterLogin;
    private string $broadcasterName;
    private string $userId;
    private string $userLogin;
    private string $userName;
    private string $productType;
    private ProductData $productData;

    public static function createFromArray(array $data): self
    {
        $self = new self();

        $self->id = $data['id'];
        $self->timestamp = $data['timestamp'];
        $self->broadcasterId = $data['broadcaster_id'];
        $self->broadcasterLogin = $data['broadcaster_login'];
        $self->broadcasterName = $data['broadcaster_name'];
        $self->userId = $data['user_id'];
        $self->userLogin = $data['use_r-login'];
        $self->userName = $data['user_name'];
        $self->productType = $data['product_type'];
        $self->productData = ProductData::createFromArray($data['product_data']);

        return $self;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'timestamp' => $this->timestamp,
            'broadcasterId' => $this->broadcasterId,
            'broadcasterLogin' => $this->broadcasterLogin,
            'broadcasterName' => $this->broadcasterName,
            'userId' => $this->userId,
            'userLogin' => $this->userLogin,
            'userName' => $this->userName,
            'productType' => $this->productType,
            'productData' => $this->productData,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function getBroadcasterId(): string
    {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string
    {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string
    {
        return $this->broadcasterName;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getProductType(): string
    {
        return $this->productType;
    }

    public function getProductData(): ProductData
    {
        return $this->productData;
    }
}