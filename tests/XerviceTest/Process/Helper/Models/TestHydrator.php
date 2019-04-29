<?php
declare(strict_types=1);

namespace XerviceTest\Process\Helper\Models;


use Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface;

class TestHydrator implements ProcessHydratorPluginInterface
{
    /**
     * @return array
     */
    public function getHydratorConfiguration(): array
    {
        return [
            [
                'newValues' => function (array $payload) {
                    return [
                        [
                            $payload['test'][0]
                        ],
                        [
                            $payload['test'][1]
                        ]
                    ];
                },
                'test'
            ]
        ];
    }
}