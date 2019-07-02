<?php
/**
 * Created by PhpStorm.
 * User: James Skinner
 * Date: 2/10/18
 */

namespace App\Classes;

use Exception;

abstract class Animal
{

    protected $age;
    protected $gender;
    protected $species;
    protected $max_age;
    protected $lifespan;

    /**
     * Builds the animal according to the params provided.
     *
     * @param $params
     * @throws Exception
     */
    public function build($params)
    {
        foreach (array_keys($params) as $param) {
            if (property_exists('App\Classes\Animal', $param)) {
                switch ($param) {
                    case ($param === 'gender'):
                        $this->determineGender($params['gender']);
                        break;
                    case ($param === 'age'):
                        $this->determineLifespan($params['age']);
                        break;
                    default:
                        $this->{$param} = $params[$param];
                }
            }
        }
    }


    /**
     * Determines if the gender is valid, and proceeds to set the gender if true.
     *
     * @param $gender
     * @throws Exception
     */
    protected function determineGender($gender)
    {
        $gender = strtolower($gender);
        if (in_array($gender, ['male', 'female'])) {
            $this->gender = $gender;
            return;
        }
        throw new Exception("Invalid gender");
    }


    /**
     * Determines if the age is valid, and sets `age` and `lifespan` based on age and max_age.
     *
     * @param $age
     * @throws Exception
     */
    protected function determineLifespan($age)
    {
        if (in_array($age, range(0, $this->max_age))) {
            $this->age = $age;
            $this->lifespan = rand($age, $this->max_age);
            return;
        }
        throw new Exception("Invalid age");
    }

    /**
     * Returns the provided attribute if it exists, otherwise null.
     *
     * @param $attribute
     * @return mixed
     */
    public function returnAttribute($attribute)
    {
        return (!empty($this->{$attribute})) ? $this->{$attribute} : null;
    }

    /**
     * Returns whether or not the animal is alive based on the age and lifespan.
     *
     * @return bool
     * @throws Exception
     */
    public function isAlive()
    {
        if (!empty($this->age) && !empty($this->lifespan)) {
            return ($this->age <= $this->lifespan);
        }
        throw new Exception("Cannot determine if the animal is alive");
    }

    /**
     * Returns if the animal has a gender of `male`.
     *
     * @return bool
     */
    public function isMale()
    {
        return $this->gender === 'male';
    }

    /**
     * Returns if the animal has a gender of `female`.
     *
     * @return bool
     */
    public function isFemale()
    {
        return $this->gender === 'female';
    }
}
