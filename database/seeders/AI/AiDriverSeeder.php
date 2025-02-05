<?php
namespace Database\Seeders\AI;
use Domain\AI\Drivers\Grok;
use Domain\AI\Drivers\QwenV25P32B;
use Domain\AI\Repository\AiRepository;
use Illuminate\Database\Seeder;

class AiDriverSeeder extends Seeder
{
    public function __construct(protected AiRepository $aiRepository)
    {
    }

    public function run(): void
    {
        $this->aiRepository->createDriver([
            'name' => 'Qwen-2.5-32b',
            'class' => QwenV25P32B::class,
            'credentials' => json_encode([
                'api_key' => env('QWEN_API_TOKEN'),
                'api_url' => env('QWEN_API_URL'),
                'model' => env('QWEN_API_MODEL'),
                'max_tokens' => env('QWEN_API_MAX_TOKENS'),
            ]),
            'enabled' => true,
        ]);
        $this->aiRepository->createDriver([
            'name' => 'grok',
            'class' => Grok::class,
            'credentials' => json_encode([
                'api_key' => env('GROK_API_TOKEN'),
                'api_url' => env('GROK_API_URL'),
                'model' => env('GROK_API_MODEL'),
                'temperature' => env('GROK_API_TEMPERATURE'),
            ]),
            'enabled' => true,
        ]);
    }
}
