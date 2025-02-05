<?php

namespace Domain\AI\Drivers;

use Domain\AI\Abstracts\AiDriverAbstract;

class Grok extends AiDriverAbstract
{

    public function sendRequest(string $input, array|null $system = [], $model = null): string|\Exception
    {
        try {
            $url = $this->credentials['api_url'];
            $apiKey = $this->credentials['api_key'];
            $data = [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $input ?? ''
                    ]
                ],
                'model' => $model ?? $this->credentials['model'] ?? 'grok-beta',
                'temperature' => (int)$this->credentials['temperature'] ?? 100,
            ];
            foreach ($system as $key => $value) {
                $data['messages'][] = [
                    'role' => 'system',
                    'content' => $value
                ];
            }
            $response = $this->sendCurl($url, $data, $apiKey);
            app('logs')(['grok' => $response]);
            return $response['choices'][0]['message']['content'];
        } catch (\Exception $e) {
            app('logs')($e);
            throw new \Exception($e->getMessage());
        }
    }

    private function sendCurl(string $url, array $data, string $apiKey): array
    {
        $ch = curl_init($url);
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
            'Authorization: Bearer ' . $apiKey,
        ]);
        $result = curl_exec($ch);
        app('logs')(['grok' => $result]);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200 || curl_errno($ch)) {

            throw new \Exception('Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($result, true);
    }
}
