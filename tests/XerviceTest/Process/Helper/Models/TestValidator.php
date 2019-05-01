<?php
declare(strict_types=1);

namespace XerviceTest\Process\Helper\Models;


use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;
use Xervice\Validator\Business\Dependency\ValidatorConfigurationProviderPluginInterface;
use Xervice\Validator\Business\Model\ValidatorType\IsType;

class TestValidator implements ValidatorConfigurationProviderPluginInterface
{
    /**
     * @return array
     */
    public function getValidatorConfiguration(): array
    {
        return [
            [
                'test' => [
                    'required' => true
                ]
            ]
        ];
    }

}