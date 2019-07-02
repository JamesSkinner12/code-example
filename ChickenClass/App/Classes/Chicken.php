<?php
/**
 * Created by PhpStorm.
 * User: James Skinner
 * Date: 2/10/18
 */

namespace App\Classes;

use Exception;

class Chicken extends Animal
{
    public $max_age = 11;

    /**
     * Chicken constructor.
     *
     * @param $params
     * @throws Exception
     */
    public function __construct($params)
    {
        $this->species = "Chicken";
        $this->build($params);
    }

    /**
     * Returns whether or not the chicken successfully laid an egg.
     *
     * @return bool
     * @throws Exception
     */
    public function layEgg()
    {
        return ($this->isFemale() && $this->isAlive()) ? true : false;
    }

    /**
     * Returns the noise the chicken makes. Since dead chickens don't make any noise, they go `null`.
     *
     * @return string
     * @throws Exception
     */
    public function makeSound()
    {
        if ($this->isAlive()) {
            return (self::isMale()) ? 'Cock-a-doodle-doo' : 'Cluck-cluck-cluck';
        }
        return null;
    }
}
