<?php declare(strict_types=1);
require_once("../password-generator/PasswordGenerator.php");
class GeneratorTest extends PHPUnit\Framework\TestCase {
    public function testGeneratorSize() : void {
        //arrange
         $length = 8;
        $arr = array(2,2);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertEquals($length, strlen($generated));
    }
    public function testGeneratorIsString() : void {
        //arrange
         $length = 8;
        $arr = array(1,1,1,1);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        
        $this->assertIsString($generated);
    }
    public function testGeneratorHasUppercaseLetters() : void {
        //arrange
         $length = 8;
         $arr = array(1,1,1,1);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertMatchesRegularExpression('#[A-Z]#', $generated);
    }
    public function testGeneratorHasLowercaseLetters() : void {
        //arrange
        $length = 8;
        $arr = array(1,1,1,1);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertMatchesRegularExpression('#[a-z]#', $generated);
    }
    
    public function testGeneratorSizeButTooMuchWantedSymbols() : void {
        //arrange
         $length = 8;
        $arr = array(4,4,4,4);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertEquals($length, strlen($generated), 'checks the length');
    }
    public function testGeneratorSizeButTooFewWantedSymbols() : void {
        //arrange
         $length = 8;
        $arr = array();

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertEquals($length, strlen($generated), 'checks the length');
    }
    public function testGeneratorSizeButWantedArrayTooBig() : void {
        //arrange
         $length = 8;
        $arr = array(2,2,2,2,2,2,2,2,2);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertEquals($length, strlen($generated), 'checks the length');
    }
    public function testGeneratorSizeButEnormous() : void {
        //arrange
        $length = 10000000;
        $arr = array(10000,10000,10000,10000,10000,10000,10000,10000,10000);

        //act
        $generated = PasswordGenerator::generate($length, $arr);

        //assert
        $this->assertEquals($length, strlen($generated), 'checks the length');
    }
}