<?php
declare(strict_types=1);

namespace XerviceTest\Process\Helper\Models;


use Xervice\Processor\Business\Model\Translator\TranslatorInterface;

class TestTranslatorFunction implements TranslatorInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'TestTranslator';
    }

    /**
     * @param array $payload
     * @param array $options
     *
     * @return array
     */
    public function translate(array $payload, array $options = null): array
    {
        if (!isset($payload['isTranslated'])) {
            $payload['isTranslated'] = 0;
        }

        $payload['isTranslated']++;

        if (is_array($options)) {
            $payload[$options['field']] = $payload[$options['source']];
        }

        return $payload;
    }

}