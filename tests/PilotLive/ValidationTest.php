<?php

namespace DarrynTen\PilotLive\Tests\PilotLive;

use DarrynTen\PilotLive\Exception\ValidationException;
use DarrynTen\PilotLive\Validation;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
    use Validation;
    /**
     * The object under test.
     *
     * @var object
     */
    private $traitObject;
    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->traitObject = $this->createObjectForTrait();
    }
    /**
     * *Creation Method* to create an object for the trait under test.
     *
     * @return object The newly created object.
     */
    private function createObjectForTrait()
    {
        return $this->getObjectForTrait(Validation::class);
    }
    public function testRegexpException()
    {
        $value = 'bar';
        $this->assertException(
            ValidationException::class,
            sprintf('value %s failed to validate', $value),
            ValidationException::STRING_REGEX_MISMATCH
        );
        $this->traitObject->validateRegex($value, '/^foo$/');
    }
    public function testRegexpSuccess()
    {
        $this->traitObject->validateRegex('bar', '/^bar$/');
    }
    public function testRangeExceptionInteger()
    {
        $value = 10;
        $min = 11;
        $max = 12;
        $this->assertException(
            ValidationException::class,
            sprintf(
                'value %s out of min(%s) max(%s)',
                $value,
                $min,
                $max
            ),
            ValidationException::INTEGER_OUT_OF_RANGE
        );
        $this->traitObject->validateRange($value, $min, $max);
    }
    public function testRangeSuccessInteger()
    {
        $this->traitObject->validateRange(10, 9, 11);
    }
    public function testRangeExceptionString()
    {
        $value = 'some string out of range';
        $min = 11;
        $max = 12;
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(
            sprintf(
                'value %s out of min(%s) max(%s)',
                $value,
                $min,
                $max
            )
        );
        $this->expectExceptionCode(ValidationException::STRING_LENGTH_OUT_OF_RANGE);
        $this->traitObject->validateRange($value, $min, $max);
    }
    public function testRangeSuccessString()
    {
        $this->traitObject->validateRange('some_string', 0, 20);
    }


    public function testValidPrimitiveException()
    {
        $this->assertTrue(
            $this->traitObject->isValidPrimitive('some string', 'string')
        );
        $this->assertFalse(
            $this->traitObject->isValidPrimitive('some string', 'integer')
        );
        $this->assertfalse(
            $this->traitObject->isValidPrimitive(1.02, 'float')
        );
    }
    public function testIsValidPrimitive()
    {
        $this->assertTrue($this->isValidPrimitive(5, 'integer'));
        $this->assertEquals(false, $this->isValidPrimitive(5, 'string'));
    }
    public function testBadRegexException()
    {
        $this->assertEquals(null, $this->validateRegex('2', '~[0-9]~'));
        $this->assertException(
            ValidationException::class,
            'value fergus failed to validate',
            ValidationException::STRING_REGEX_MISMATCH
        );
        $this->validateRegex('fergus', '~[0-9]~');
    }
    public function testValidateIntegerException()
    {
        $this->assertEquals(null, $this->validateRange(10, 5, 15));
        $this->assertException(
            ValidationException::class,
            'Validation error value 20 out of min(5) max(15) Integer value is out of range',
            ValidationException::INTEGER_OUT_OF_RANGE
        );
        $this->validateRange(20, 5, 15);
    }

    public function testValidateFilterVar()
    {
        $this->validateFilterVar('test@gmail.com', FILTER_VALIDATE_EMAIL);
        $this->assertException(
            ValidationException::class,
            'Validation error value  failed to validate filter_var failed to validate',
            ValidationException::FILTER_VAR_FAILED
        );
        $this->validateFilterVar(false, FILTER_VALIDATE_BOOLEAN);
    }


    //above tests reach 100% coverage, robustness tests below
    public function testValidateNull()
    {
        $this->assertException(
            ValidationException::class,
            'Validation error value  is type NULL Validation type is invalid',
            ValidationException::VALIDATION_TYPE_ERROR
        );
        $this->validateRange(null, 5, 15);
    }
    public function testValidateNullType()
    {
        //Should this be valid?
        $this->assertTrue($this->isValidPrimitive("\0foo", 'string'));
    }
    public function testValidateDifferentNullType()
    {
        //Should this be valid?
        $this->assertTrue($this->isValidPrimitive("\x00foo", 'string'));
    }
    public function testValidateURLHexEncodedType()
    {
        //URLEncoding
        //Should this be valid?
        $this->assertTrue($this->isValidPrimitive("foo%60%7ebar", 'string'));
        //Should this be valid?
        $this->assertTrue($this->isValidPrimitive(urldecode("foo%60%7ebar"), 'string'));
        //HexEncoding
        $this->assertTrue($this->isValidPrimitive(bin2hex("foobar"), 'string'));
        //Validate range is moved to bottom test
    }
    public function testValidateBaseSixtyFourEncodedType()
    {
        //b64 encoding tests
        $this->assertTrue($this->isValidPrimitive(base64_encode("foobar"), 'string'));
        $this->validateRange(base64_encode("foobar"), 5, 15);
    }
    public function testEmojiValidation()
    {
        //is this valid?
        $this->validateRange(json_decode('"\uD83D\uDE00"'), 0, 8);
    }

    public function testOutlierChars()
    {
        $this->validateRange(0x00, 0, 8);
        $this->assertException(
            ValidationException::class,
            "Validation error value 255 out of min(0) max(8) Integer value is out of range",
            ValidationException::INTEGER_OUT_OF_RANGE
        );
        $this->validateRange(0xFF, 0, 8);
    }
    private function assertException($class, String $message, int $code)
    {
        $this->expectException($class);
        $this->expectExceptionMessage($message);
        $this->expectExceptionCode($code);
    }
    /**
     * @dataProvider stringExceptionProvider
     */
    public function testLengthValidation($message, $test, $min, $max)
    {
        $this->assertException(
            ValidationException::class,
            sprintf("Validation error value %s String length is out of range", $message),
            ValidationException::STRING_LENGTH_OUT_OF_RANGE
        );
        $this->validateRange($test, $min, $max);
    }
    public static function stringExceptionProvider()
    {
        return [
            [
                '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0asdhd out of min(5) max(15)',
                '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0asdhd',
                5,
                15,
            ],
            [
                '666f6f0a626172 out of min(5) max(10)',
                bin2hex("foo\nbar"),
                5,
                10
            ],
            [
                'Zm9vYmFyIGJhcmZvbyAKIHpvbw== out of min(5) max(15)',
                base64_encode("foobar barfoo \n zoo"),
                5,
                15
            ],
            [
                '😀😀😀 out of min(1) max(2)',
                json_decode('"\uD83D\uDE00"')
                . json_decode('"\uD83D\uDE00"') . json_decode('"\uD83D\uDE00"'),
                1,
                2
            ],
        ];
    }
}
