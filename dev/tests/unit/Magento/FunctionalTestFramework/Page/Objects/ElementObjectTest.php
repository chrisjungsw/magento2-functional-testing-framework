<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace tests\unit\Magento\FunctionalTestFramework\Page\Objects;

use Magento\FunctionalTestingFramework\Exceptions\XmlException;
use Magento\FunctionalTestingFramework\Page\Objects\ElementObject;
use PHPUnit\Framework\TestCase;

/**
 * Class ElementObjectTest
 */
class ElementObjectTest extends TestCase
{
    /**
     * Timeout should be null when instantiated with '-'
     */
    public function testTimeoutDefault()
    {
        $element = new ElementObject('name', 'type', 'selector', null, '-', false);
        $this->assertNull($element->getTimeout());
    }

    /**
     * Timeout should be cast to an integer
     */
    public function testTimeoutNotNull()
    {
        $element = new ElementObject('name', 'type', 'selector', null, '15', false);
        $timeout = $element->getTimeout();
        $this->assertEquals(15, $timeout);
        $this->assertInternalType('int', $timeout);
    }

    /**
     * Timeout should be 0 when a string is the value
     */
    public function testTimeoutCastFromString()
    {
        $element = new ElementObject('name', 'type', 'selector', null, 'helloString', true);
        $timeout = $element->getTimeout();
        $this->assertEquals(0, $timeout);
        $this->assertInternalType('int', $timeout);
    }


    /**
     * An exception should be thrown if both a selector and locatorFunction are passed
     */
    public function testBothSelectorAndLocatorFunction()
    {
        $this->expectException(XmlException::class);
        new ElementObject('name', 'type', 'selector', 'cantDoThis', 'helloString', true);
    }
}
