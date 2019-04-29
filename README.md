Processor
=====================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/processor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/processor/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/processor/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/processor/?branch=master)

Installation
-----------------
```
composer require xervice/processor
```

Configuration
-----------------
You must create a new process configuration class implementing \Xervice\Processor\Business\Dependency\ProcessConfigurationPluginInterface.
That class you have to register in the ProcessorDependencyProvider to add your process.

Using
-----------------
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