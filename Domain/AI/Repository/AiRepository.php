<?php
namespace Domain\AI\Repository;
use Domain\AI\Models\AiDriver;
use Domain\AI\Models\AiRequest;
use Illuminate\Database\Eloquent\Model;

class AiRepository {
    public function __construct(protected AiRequest $aiRequest, protected AiDriver $aiDriver)
    {
    }

    public function createDriver(array $data): AiDriver
    {
        return $this->aiDriver->updateOrCreate(['name' => $data['name']],$data);
    }

    public function getDriver(string $name): AiDriver|null
    {
        return $this->aiDriver->byActive($name)->first();
    }

    public function createRequest(Model $target,string $input, AiDriver $driver, array $system = [], string $tag = null): AiRequest
    {
        return $this->aiRequest->create([
            'target_id' => $target->id,
            'target_type' => get_class($target),
            'ai_driver_id' => $driver->id,
            'system_prompt' => json_encode($system),
            'user_prompt' => $input,
            'tag' => $tag,
        ]);
    }

    public function updateRequest(AiRequest $aiRequest, string $response): AiRequest
    {
        $aiRequest->response = $response;
        $aiRequest->status = 'success';
        $aiRequest->save();
        return $aiRequest;
    }
}
