<?php
namespace Infrastructure\Shared\Concerns;
trait HasPagination
{
    public function getPaginateInfo(): array
    {
        return [
            'total' => $this->total(),
            'currentPage' => $this->currentPage(),
            'lastPage' => $this->lastPage(),
            'perPage' => $this->perPage()
        ];
    }
}
