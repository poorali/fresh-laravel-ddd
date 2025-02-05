<?php
namespace Domain\AI\Abstracts;


abstract class AiDriverAbstract
{
    public function __construct(protected array $credentials) {

    }

    abstract public function sendRequest(string $input, array | null $system, string|null $model): string|\Exception;
}
