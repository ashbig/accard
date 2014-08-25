<?php

namespace Accard\Bundle\ResourceBundle\Doctrine;

use Doctrine\ORM\Mapping\ClassMetadata as BaseClassMetadata;

class ClassMetadata extends BaseClassMetadata implements ClassMetadataInfo
{
	public function addDiscriminatorMapClass($name, $className)
    {
        $className = $this->fullyQualifiedClassName($className);
        $className = ltrim($className, '\\');
        $this->discriminatorMap[$name] = $className;

        if ($this->name == $className) {
            $this->discriminatorValue = $name;
        } else {
            if ( ! class_exists($className) && ! interface_exists($className)) {
                throw MappingException::invalidClassInDiscriminatorMap($className, $this->name);
            }
            if (is_subclass_of($className, $this->name) && ! in_array($className, $this->subClasses)) {
                $this->subClasses[] = $className;
            }
        }
    }
}
