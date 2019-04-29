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
     * @param string $fieldName
     * @param string $config
     *
     * @return array
     */
    public function handleSimpleConfig(array $data, string $fieldName, string $config): array
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
     * @param string $fieldName
     * @param array $config
     *
     * @return array
     */
    public function handleNestedConfig(array $data, string $fieldName, array $config): array
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