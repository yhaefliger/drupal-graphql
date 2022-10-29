<?php

namespace Drupal\Tests\graphql\Unit;

use Drupal\graphql\Utility\StringHelper;
use Drupal\Tests\UnitTestCase;
use InvalidArgumentException;

/**
 * Tests string helper functions.
 *
 * @group graphql
 */
class StringFormattingTest extends UnitTestCase {

  /**
   * @expectedException \InvalidArgumentException
   */
  public function testFailureOnInvalidInput() {
    $this->expectException(InvalidArgumentException::class);
    StringHelper::camelCase('^%!@#&');
  }

  /**
   * @dataProvider providerTestStringFormatting
   *
   * @param $input
   * @param $expected
   */
  public function testCamelCaseFormatting($input, $expected) {
    $this->assertSame($expected, call_user_func_array([StringHelper::class, 'camelCase'], $input));
  }

  /**
   * @dataProvider providerTestStringFormatting
   *
   * @param $input
   * @param $expected
   */
  public function testPropCaseFormatting($input, $expected) {
    $this->assertSame(lcfirst($expected), call_user_func_array([StringHelper::class, 'propCase'], $input));
  }

  public function providerTestStringFormatting() {
    return [
      [['simple-name'], 'SimpleName'],
      [['123-name-with*^&!@some-SPECIAL-chars'], '_123NameWithSomeSPECIALChars'],
      [['simple', 'name-of-string', 'components'], 'SimpleNameOfStringComponents'],
      [['123', 'array', '%^!@&#*', 'of', 'STRING', '(*&', 'components', 'with', 'SPEcial', 'chars'], '_123ArrayOfSTRINGComponentsWithSPEcialChars']
    ];
  }

}
