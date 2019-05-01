<?php
declare(strict_types=1);

namespace Xervice\Processor\Communication\Plugin;


use Xervice\ArrayHandler\Dependency\FieldHandlerPluginInterface;

class TranslatorFieldHandlerPlugin implements FieldHandlerPluginInterface
{
    /**
     * @var \Xervice\Processor\Business\Model\Translator\TranslatorInterface[]
     */
    private $translators;

    /**
     * TranslatorFieldHandlerPlugin constructor.
     *
     * @param \Xervice\Processor\Business\Model\Translator\TranslatorInterface[] $translators
     */
    public function __construct(array $translators)
    {
        $this->translators = $translators;
    }

    /**
     * @param array $data
     * @param mixed $fieldName
     * @param mixed $config
     *
     * @return array
     */
    public function handleSimpleConfig(array $data, $fieldName, $config): array
    {
        foreach ($this->translators as $translator) {
            if ($translator->getName() === $fieldName) {
                $data = $translator->translate($data);
            }
        }

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
        foreach ($this->translators as $translator) {
            if ($translator->getName() === $fieldName) {
                $data = $translator->translate($data, $config);
            }
        }

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
        foreach ($this->translators as $translator) {
            if ($translator->getName() === $config) {
                $data = $translator->translate($data);
            }
        }

        return $data;
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