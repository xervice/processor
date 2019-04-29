# Processor

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/processor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/processor/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/processor/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/processor/?branch=master)

## Installation
```
composer require xervice/processor
```

## Configuration
You must create a new process configuration plugin implementing \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface.
That class you have to register in the ProcessorDependencyProvider to add your process.

A process is a data livecycle with the following steps:
1. Read input
2. Validate data
3. Hydrate data
4. Translate data
5. Process data
6. Write data

All login for the given steps can be configured in the process configuration plugin.

### Read input
You can define an InputHandler in your process configuration to read the data.

```php
    /**
     * @return \Xervice\Processor\Business\Model\InputHandler\InputHandlerInterface
     */
    public function getInputHandler(): InputHandlerInterface
    {
        return new RawJsonFileRowInputHandler();
    }
```

### Validate data
For validating you can add one or more ValidatorPlugins to your process configuration to validate your data. The config syntax is based on the xervice/validator module.

```php
    /**
     * @return \Xervice\Validator\Business\Dependency\ValidatorConfigurationProviderPluginInterface[]
     */
    public function getValidatorConfigurationPlugins(): array
    {
        return [
            new TestValidator()
        ];
    }
```

```php
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
                        'required' => true,
                        'type' => IsType::TYPE_ARRAY
                    ]
                ]
            ];
        }
    
    }
```

### Hydrating

After your data is validated you can hydrate the information by adding HydratePlugins to your process configuration. Syntax of the configuration is based on the xervice/array-handler module.  
Giving only the fieldname in the config will remove this entry from the data.

```php
    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessHydratorPluginInterface[]
     */
    public function getHydratorPlugins(): array
    {
        return [
            new TestHydrator()
        ];
    }
```

```php
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
```

### Translating
After hydrating the information you can translate them into your needed structure. For that you can add translate plugins to your process configuration.
Syntax is also based on the xervice/array-handler module. Here you can define TranslationFunction. You can add new TranslationFunctions to the ProcessorDependencyProvider.

```php
    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessTranslationPluginInterface[]
     */
    public function getTranslatorPlugins(): array
    {
        return [
            new TestTranslator()
        ];
    }
```

```php
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
```

```php
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
```

```php
class ProcessorDependencyProvider extends \Xervice\Processor\ProcessorDependencyProvider
{
    /**
     * @return \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface[]
     */
    protected function getProcessConfigurationPlugins(): array
    {
        return [
            new ProcessConfiguration()
        ];
    }

    /**
     * @return \Xervice\Processor\Business\Model\Translator\TranslatorInterface[]
     */
    protected function getTranslatorFunctions(): array
    {
        return [
            new TestTranslatorFunction()
        ];
    }
}
```


### Processing

Processing the data is the jump into your module business logic. For that you've a hook method in your process configuration. The return value is data payload you want to write.

```php
    /**
     * @param array $data
     *
     * @return array
     */
    public function process(array $data): array
    {
        $data['isProcessed'] = true;
        // $this->getFacade()->processYourOwnData($data);

        return $data;
    }
```

### Write data

At the end the data will be given to your OutputHandler to persist them. You can define the OutputHandler in your process configuration.

```php
    /**
     * @return \Xervice\Processor\Business\Model\OutputHandler\OutputHandlerInterface
     */
    public function getOutputHandler(): OutputHandlerInterface
    {
        return new RawJsonFileOutputHandler();
    }
```


## Using
You can run a process by using the console command:  

```
vendor/bin/xervice process:run -p YOUR_PROCESS_NAME

# With input and/or output info
vendor/bin/xervice process:run -p YOUR_PROCESS_NAME -i input
vendor/bin/xervice process:run -p YOUR_PROCESS_NAME -o output
vendor/bin/xervice process:run -p YOUR_PROCESS_NAME -i input -o output
```

Also you can use the ProcessorFacade to trigger a process:
```php
$processConfig = (new ProcessRunDataProvider())
   ->setName('YOUR_PROCESS_PROCESS')
   ->setInput('input')
   ->setOutput('output');

$processorFacade->runProcess($processConfig);
```