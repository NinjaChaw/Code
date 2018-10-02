<?php

namespace App\Models\Fields;

trait Enum
{
    /**
     * Get values of specific Enum field
     *
     * @param $fieldName - should correspond to the name of the interface
     * @return array
     */
    public static function getEnumValues($fieldName) {
        $modelClass = new \ReflectionClass(get_called_class());
        $implementedInterfaces = $modelClass->getInterfaces();
        $enumInterfaceName = __NAMESPACE__ . '\\Enum' . $fieldName;

        return isset($implementedInterfaces[$enumInterfaceName])
            ? array_values($implementedInterfaces[$enumInterfaceName]->getConstants())
            : [];
    }
}