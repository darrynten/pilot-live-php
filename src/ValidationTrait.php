<?php

namespace DarrynTen\PilotLive;

use DarrynTen\PilotLive\Exception\ModelException;

/**`
 * Model Validation Helper
 *
 * @category Validation
 * @package  PilotLivePHP
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 */
trait ValidationTrait
{
    /**
     * Ensure the field is defined
     *
     * @var string $key
     * @var string|integer $value
     * @thows ModelException
     */
    private function checkDefined($key, $value)
    {
        if (!array_key_exists($key, $this->fields)) {
            $this->throwException(ModelException::SETTING_UNDEFINED_PROPERTY, sprintf('key %s value %s', $key, $value));
        }
    }

    /**
     * Check if the field is read only
     *
     * @var string $key
     * @var string|integer $value
     * @thows ModelException
     */
    private function checkReadOnly($key, $value)
    {
        if ($this->fields[$key]['readonly']) {
            $this->throwException(ModelException::SETTING_READ_ONLY_PROPERTY, sprintf('key %s value %s', $key, $value));
        }
    }

    /**
     * Check if the field can be set to null
     *
     * @var string $key
     * @var string|integer $value
     * @thows ModelException
     */
    private function checkNullable($key, $value)
    {
        if (!$this->fields[$key]['nullable'] && is_null($value)) {
            $this->throwException(ModelException::NULL_WITHOUT_NULLABLE, sprintf('attempting to nullify key %s', $key));
        }
    }

    /**
     * Check min-max and regex validation
     *
     * @var string $key
     * @var string|integer $value
     * @thows ModelException
     */
    private function checkValidation($key, $value)
    {
        // If it is and can be null
        if (is_null($value) && ($this->fields[$key]['nullable'] === true)) {
            return;
        }

        // If values have a defined min/max then validate
        if ((array_key_exists('min', $this->fields[$key])) && (array_key_exists('max', $this->fields[$key]))) {
            $this->validateRange($value, $this->fields[$key]['min'], $this->fields[$key]['max']);
        }

        // If values should be from an enumarable list
        if (array_key_exists('enum', $this->fields[$key])) {
            $this->validateEnum($value, $this->{$this->fields[$key]['enum']});
        }

        // If values have a defined regex then validate
        if (array_key_exists('regex', $this->fields[$key])) {
            $this->validateRegex($value, $this->fields[$key]['regex']);
        }

        if (array_key_exists('validate', $this->fields[$key])) {
            $this->validateFilterVar($value, $this->fields[$key]['validate']);
        }
    }
}
