<?php

namespace ReportsApp\Shared\Domain\Traits;

/**
 * Trait IsSerializable
 *
 * @package ScholarshipPreApplication\Domain\Common\Traits
 */
trait IsSerializable
{
    /**
     * Return an array representation of the entity
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        $keys = $this->getVariableKeysByObject($this);

        foreach ($keys as $key)
        {
            $value = $this->getValueByKeyAndAccessor($this, $key);

            if (!isset($value))
                continue;

            if (is_iterable($value) && $this->containsOnlyObjects($value)) {

                $data[$this->camelToSnake($key)] = array_map(
                    fn($val) => $val->toArray(),
                    $value
                );

            } else if (is_object($value)) {

                $variableKeys = $this->getVariableKeysByObject($value);

                if(count($variableKeys) > 1) {

                    $data[$this->camelToSnake($key)] = $value->toArray();

                } else {

                    $b = array_pop($variableKeys);

                    $data[$this->camelToSnake($key)] = $b ? $this->getValueByKeyAndAccessor($value, $b) : $b;

                }

            } else {

                $data[$this->camelToSnake($key)] = $value;
            }
        }

        return $data;
    }

    /**
     * @param $object
     * @return array
     */
    protected function getVariableKeysByObject($object): array
    {
        return array_keys(get_object_vars($object));
    }

    /**
     * @param $object
     * @param $key
     * @return mixed
     */
    protected function getValueByKeyAndAccessor($object, $key): mixed
    {
        $getter = $this->getAccessor($object, $key, 'get');

        return !$getter ? $object->$key : $object->$getter();
    }

    /**
     * Get an accessor method if defined
     *
     * @param $object
     * @param string $property
     * @param string $type
     * @return string|null
     */
    protected function getAccessor($object, string $property, string $type) : ?string
    {
        $method = $this->snakeToCamel("{$type}_{$property}");
        return \method_exists($object, $method) ?$method :null;
    }

    /**
     *
     * @param string $key
     * @return string
     */
    private function camelToSnake(string $key) : string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
    }

    /**
     *
     * @param string $key
     * @return string
     */
    protected function snakeToCamel(string $key) : string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
    }

    /**
     * Verify if all array elements are objects
     *
     * @param iterable $elements
     * @return bool
     */
    protected function containsOnlyObjects(iterable $elements) : bool
    {
        foreach ($elements as $element)
            if (!is_object($element)) return false;

        return true;
    }

}

