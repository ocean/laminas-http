<?php

/**
 * @see       https://github.com/laminas/laminas-http for the canonical source repository
 * @copyright https://github.com/laminas/laminas-http/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-http/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Http\Header;

use Laminas\Http\Header\Exception\InvalidArgumentException;
use Laminas\Http\Header\HeaderInterface;
use Laminas\Http\Header\Pragma;
use PHPUnit\Framework\TestCase;

class PragmaTest extends TestCase
{
    public function testPragmaFromStringCreatesValidPragmaHeader()
    {
        $pragmaHeader = Pragma::fromString('Pragma: xxx');
        $this->assertInstanceOf(HeaderInterface::class, $pragmaHeader);
        $this->assertInstanceOf(Pragma::class, $pragmaHeader);
    }

    public function testPragmaGetFieldNameReturnsHeaderName()
    {
        $pragmaHeader = new Pragma();
        $this->assertEquals('Pragma', $pragmaHeader->getFieldName());
    }

    public function testPragmaGetFieldValueReturnsProperValue()
    {
        $this->markTestIncomplete('Pragma needs to be completed');

        $pragmaHeader = new Pragma();
        $this->assertEquals('xxx', $pragmaHeader->getFieldValue());
    }

    public function testPragmaToStringReturnsHeaderFormattedString()
    {
        $this->markTestIncomplete('Pragma needs to be completed');

        $pragmaHeader = new Pragma();

        // @todo set some values, then test output
        $this->assertEmpty('Pragma: xxx', $pragmaHeader->toString());
    }

    /** Implementation specific tests here */

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaFromString()
    {
        $this->expectException(InvalidArgumentException::class);
        Pragma::fromString("Pragma: xxx\r\n\r\nevilContent");
    }

    /**
     * @see http://en.wikipedia.org/wiki/HTTP_response_splitting
     * @group ZF2015-04
     */
    public function testPreventsCRLFAttackViaConstructor()
    {
        $this->expectException(InvalidArgumentException::class);
        new Pragma("xxx\r\n\r\nevilContent");
    }
}
