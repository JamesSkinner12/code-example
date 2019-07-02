<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2/10/18
 * Time: 7:32 PM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\Chicken;
use Exception;

class ChickenTest extends TestCase
{
    /*
     * PHPUnit Test For Chicken Class located in App\Classes\Chicken -> Extends App\Classes\Animal
     */
    public $max_age = 11;

    /**
     * @dataProvider additionalProvider()
     * @param $gender
     * @param $age
     * @param $valid
     * @throws Exception
     */
    public function test_can_create_chicken($gender, $age, $valid)
    {
        if ($valid == true) {
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertInstanceOf(Chicken::class, $test_subject);
        } else {
            $this->expectException(Exception::class);
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertInstanceOf(Chicken::class, $test_subject);
        }
    }

    /**
     * @dataProvider    additionalProvider()
     * @param $gender
     * @param $age
     * @param $valid
     * @throws \Exception
     * @depends         test_can_create_chicken
     */
    public function test_params_were_set($gender, $age, $valid)
    {
        if ($valid == true) {
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertSame($gender, $test_subject->returnAttribute('gender'));
            $this->assertSame($age, $test_subject->returnAttribute('age'));
        } else {
            $this->expectException(Exception::class);
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertSame($gender, $test_subject->returnAttribute('gender'));
            $this->assertSame($age, $test_subject->returnAttribute('age'));
        }
    }

    /**
     * @dataProvider    additionalProvider
     * @param $gender
     * @param $age
     * @param $valid
     * @throws Exception
     * @depends         test_can_create_chicken
     * @depends         test_params_were_set
     */
    function test_chicken_gender($gender, $age, $valid)
    {
        if ($valid == true) {
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            if ($gender == 'male') {
                $this->assertTrue($test_subject->isMale());
                $this->assertFalse($test_subject->isFemale());
            } elseif ($gender == 'female') {
                $this->assertFalse($test_subject->isMale());
                $this->assertTrue($test_subject->isFemale());
            }
        } else {
            $this->expectException(Exception::class);
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertFalse($test_subject->isMale());
            $this->assertFalse($test_subject->isFemale());
        }
    }


    /**
     * @dataProvider additionalProvider
     * @param $gender
     * @param $age
     * @param $valid
     * @throws Exception
     */
    function test_chicken_can_lay_egg($gender, $age, $valid)
    {
        if ($valid == true) {
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            if ($gender == 'male') {
                $this->assertFalse($test_subject->layEgg());
            } elseif ($gender == 'female') {
                $this->assertTrue($test_subject->layEgg());
            }
        } else {
            $this->expectException(Exception::class);
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertFalse($test_subject->layEgg());
        }
    }


    /**
     * @dataProvider additionalProvider
     * @param $gender
     * @param $age
     * @param $valid
     * @throws Exception
     */
    function test_chicken_can_make_sound($gender, $age, $valid)
    {
        if ($valid == true) {
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            if ($gender == 'male') {
                $this->assertEquals('Cock-a-doodle-doo', $test_subject->makeSound());
            } elseif ($gender == 'female') {
                $this->assertEquals('Cluck-cluck-cluck', $test_subject->makeSound());
            }
        } else {
            $this->expectException(Exception::class);
            $test_subject = new Chicken(array('gender' => $gender, 'age' => $age));
            $this->assertNull($test_subject->makeSound());

        }
    }


    /**
     * @return array
     */
    public function additionalProvider()
    {
        return [
            ['male', 1, true],
            ['female', 1, true],
            ['tamale', 1, false],
            ['male', -1, false],
            ['female', -1, false],
            ['tamale', -1, false],
            ['male', 100, false],
            ['female', 100, false],
            ['tamale', 100, false],
        ];
    }

}
