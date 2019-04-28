<?php
namespace XerviceTest\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Xervice\Core\Business\Model\Locator\Locator;
use Xervice\Processor\Business\ProcessorFacade;

class XerviceTest extends \Codeception\Module
{
    /**
     * @return \Xervice\Processor\Business\ProcessorFacade
     */
    public function getFacade(): ProcessorFacade
    {
        return Locator::getInstance()->processor()->facade();
    }
}
