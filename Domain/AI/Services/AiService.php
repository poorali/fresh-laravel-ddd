<?php

namespace Domain\AI\Services;

use Domain\AI\Abstracts\AiDriverAbstract;
use Domain\AI\Events\AiRequestWasRespondEvent;
use Domain\AI\Models\AiDriver;
use Domain\AI\Models\AiRequest;
use Domain\AI\Repository\AiRepository;
use Illuminate\Database\Eloquent\Model;

class AiService
{
    public function __construct(protected AiRepository $aiRepository)
    {
    }

    public function createRequest(Model $target, string $input, string $driver, array $system = [], string $tag = null): AiRequest|\Exception
    {
        try {
            //check if the target drive exists
            $driver = $this->aiRepository->getDriver($driver);
            if (!$driver) {
                throw new \Exception('Driver not found');
            }
            //create the request
            return $this->aiRepository->createRequest($target, $input, $driver, $system, $tag);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function executeRequest(AiRequest $aiRequest): string|\Exception
    {
        try {
            //get the driver
            $driver = $this->initializeDriverClass($aiRequest->driver);

            //send the request
            $response = $driver->sendRequest($aiRequest->user_prompt, json_decode($aiRequest->system_prompt,true), $aiRequest->tag);
            //update the request
            if($response){
                event(new AiRequestWasRespondEvent($this->aiRepository->updateRequest($aiRequest, $response)));
            }
            return $response;
        } catch (\Exception $e) {
            app('logs')($e);
            throw new \Exception($e->getMessage());
        }
    }


    public function initializeDriverClass(AiDriver $driver): AiDriverAbstract|\Exception
    {
        try {
            //check if the target drive exists
            if (!$driver->enabled) {
                throw new \Exception('Driver not found');
            }
            //initialize the driver
            return $driver->initialize();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
