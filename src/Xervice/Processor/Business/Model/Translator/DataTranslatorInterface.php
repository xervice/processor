<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Translator;

interface DataTranslatorInterface
{
    /**
     * @param array $data
     * @param \Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface[] $translatorConfigPlugins
     *
     * @return array
     */
    public function translate(array $data, array $translatorConfigPlugins): array;
}