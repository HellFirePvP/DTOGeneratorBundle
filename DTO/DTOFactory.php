<?php
/**
 * This file is part of the DTO Generator Bundle.
 *
 * (c) HellFirePvP <dev.hellfire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HellFirePvP\Bundle\DTOGeneratorBundle\DTO;

use HellFirePvP\Bundle\DTOGeneratorBundle\DTO\Generator\ClassGenerator;
use HellFirePvP\Bundle\DTOGeneratorBundle\Exception\ClassNotFoundException;
use ReflectionClass;
use ReflectionException;

class DTOFactory
{
    /**
     * The directory the DTOs are saved into.
     *
     * @var string
     */
    protected string $dtoDirectory;

    /**
     * The Namespace DTOs are organized into.
     *
     * @var string
     */
    protected string $dtoNamespace;

    /**
     * Holds ReflectionClass instances for specific classes DTOs are requested for
     *
     * @var array
     */
    private array $refClassCache = [];

    /**
     * The DTO Class generator to generate DTO Classfiles with.
     *
     * @var ClassGenerator
     */
    private ClassGenerator $generator;

    /**
     * @param string $dtoDirectory
     * @param string $dtoNamespace
     */
    public function __construct(string $dtoDirectory, string $dtoNamespace)
    {
        $this->dtoDirectory = $dtoDirectory;
        $this->dtoNamespace = $dtoNamespace;

        $this->generator = new ClassGenerator($this->dtoDirectory, $this->dtoNamespace);
    }

    /**
     * Creates a new DTO for the given class.
     *
     * @param string $class
     *
     * @return DTObject
     */
    public function createDTO(string $class): DTObject
    {
        $refClass = $this->getRefClass($class);
        if (!$this->doesDTOClassExist($class)) {
            $this->generator->generateDTOFile($refClass, $this->generator->getDTOClassFile($refClass));
        }

        $className = $this->generator->getDTOClassName($refClass);
        return new $className();
    }

    /**
     * Tests if the actual DTO class file exists already
     *
     * @param string $class
     *
     * @return bool
     */
    public function doesDTOClassExist(string $class): bool
    {
        $file = $this->generator->getDTOClassFile($this->getRefClass($class));
        return file_exists($file);
    }

    /**
     * Get a potentially cached reflection class of the passed class.
     *
     * @param string $class
     *
     * @return ReflectionClass
     */
    private function getRefClass(string $class): ReflectionClass
    {
        if (isset($this->refClassCache[$class])) {
            $refClass = $this->refClassCache[$class];
        } else {
            try {
                $refClass = new ReflectionClass($class);
            } catch (ReflectionException $e) {
                throw new ClassNotFoundException($e->getMessage(), $e->getCode(), $e);
            }
            $this->refClassCache[$class] = $refClass;
        }
        return $refClass;
    }

    /**
     * Returns the directory the DTOs are saved into.
     *
     * @return string
     */
    public function getDtoDirectory(): string
    {
        return $this->dtoDirectory;
    }

    /**
     * Returns the Namespace DTOs are organized into.
     *
     * @return string
     */
    public function getDtoNamespace(): string
    {
        return $this->dtoNamespace;
    }

    public static function createObject(string $getObjectClass, object $param): object
    {
        return new class() {};
    }
}