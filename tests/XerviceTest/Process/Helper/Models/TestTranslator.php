<?php
declare(strict_types=1);

namespace XerviceTest\Process\Helper\Models;


use Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface;

class TestTranslator implements ProcessTranslationPluginInterface
{
    /**
     * @return array
     */
    public function getTranslationConfiguration(): array
    {
        return [
            [
                'TestTranslator',
                'TestTranslator' => [
                    'field' => 'transOne',
                    'source' => 'newValues'
                ],
                'transTwo' => function (array $payload) {
                    return $payload['transOne'] ?? null;
                }
            ]
        ];
    }
}