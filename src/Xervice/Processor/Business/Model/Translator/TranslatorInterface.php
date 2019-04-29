<?php
declare(strict_types=1);

namespace Xervice\Processor\Business\Model\Translator;


interface TranslatorInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param array $payload
     * @param array $options
     *
     * @return array
     */
    public function translate(array $payload, array $options = null): array;
}