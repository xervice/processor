<?php
declare(strict_types=1);

namespace Xervice\Processor\Communication\Plugin;


use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;

class TranslatorFieldHandlerPlugin implements FieldHandlerPluginInterface
{
    /**
     * @param array $data
     * @param string $fieldName
     * @param string $config
     *
     * @return array
     */
    public function handleSimpleConfig(array $data, string $fieldName, string $config): array
    {
        return $data;
    }

    /**
     * @param array $data
     * @param string $fieldName
     * @param array $config
     *
     * @return array
     */
    public function handleNestedConfig(array $data, string $fieldName, array $config): array
    {
        $data[$fieldName] = $data[$config['field']];

        return $data;
    }

    /**
     * @param array $data
     * @param string $fieldName
     * @param callable $config
     *
     * @return array
     */
    public function handleCallableConfig(array $data, string $fieldName, callable $config): array
    {
        $data[$fieldName] = $config($data);

        return $data;
    }
}