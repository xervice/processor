<?php
declare(strict_types=1);

namespace Xervice\Processor\Communication\Plugin;


use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;

class HydratorFieldHandlerPlugin implements FieldHandlerPluginInterface
{
    /**
     * @param array $data
     * @param mixed $fieldName
     * @param mixed $config
     *
     * @return array
     */
    public function handleSimpleConfig(array $data, $fieldName, $config): array
    {
        unset($data[$fieldName]);

        return $data;
    }

    /**
     * @param array $data
     * @param mixed $fieldName
     * @param array $config
     *
     * @return array
     */
    public function handleNestedConfig(array $data, $fieldName, array $config): array
    {
        $data[$fieldName] = $config['value'];

        return $data;
    }

    /**
     * @param array $data
     * @param array $config
     *
     * @return array
     */
    public function handleArrayConfig(array $data, array $config): array
    {
        return $config;
    }


    /**
     * @param array $data
     * @param mixed $fieldName
     * @param callable $config
     *
     * @return array
     */
    public function handleCallableConfig(array $data, $fieldName, callable $config): array
    {
        $data[$fieldName] = $config($data);

        return $data;
    }
}