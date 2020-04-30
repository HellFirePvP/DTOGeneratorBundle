<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\Tests\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class TestDTOPerson
{

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="50")
     */
    private string $name = '';

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="50")
     */
    private string $lastName = '';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
}
