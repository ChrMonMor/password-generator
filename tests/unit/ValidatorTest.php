<?php declare(strict_types=1);
require_once("../password-generator/PasswordValidator.php");
class ValidatorTest extends PHPUnit\Framework\TestCase {
    public function testValidatorCorrect() : void {
        //arrange
        $password = "fhd78fFh47bn(98&d671";
        //act
        $value = PasswordValidator::validate($password);
        //assert
        $this->assertEquals($value[0], 'strong password');
    }
    public function testValidatorNoLowercaseLetters() : void {
        //arrange
        $password = "FDSFD78ER473(98&J671";
        //act
        $value = PasswordValidator::validate($password);

        //assert
        $this->assertEquals($value[0], 'Must contain at least one lowercase letter');
    }
}