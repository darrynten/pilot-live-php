<?php
/**
 * PilotLive Library - Base Model
 *
 * @category Library
 * @package  PilotLive
 * @author   Darryn Ten <darrynten@github.com>
 * @license  MIT <https://github.com/darrynten/pilot-live-php/blob/master/LICENSE>
 * @link     https://github.com/darrynten/pilot-live-php
 * @version  PHP 7+
 */

namespace DarrynTen\PilotLive;

use DarrynTen\PilotLive\Request\RequestHandler;
use DarrynTen\PilotLive\Exception\ModelException;
use DarrynTen\PilotLive\Exception\LibraryException;
use DarrynTen\PilotLive\Validation;
use DarrynTen\PilotLive\Models\ModelCollection;
use DarrynTen\PilotLive\ValidationTrait;

/**
 * This is the base class for all the PilotLive Models.
 *
 * This class covers all/get/save/delete calls for all models that require it.
 *
 * It also handles conversion between our Model objects, and JSON that is
 * compliant with the PilotLive API format.
 *
 * In order to provide ORM type functionality we support re-hydrating any
 * model with its defined JSON fragment.
 */
abstract class BaseModel
{
    use Validation;
    use ValidationTrait;

    /**
     * A request object
     *
     * TODO this should be refactored out
     */
    protected $request;

    /**
     * A models configuration is stored here
     *
     * @var array $config
     */
    protected $config = null;

    /**
     * A models fields are stored here
     *
     * @var array $fieldsData
     */
    protected $fieldsData = [];

    /**
     * Make a new model
     *
     * Setup a request handler and bind the config
     *
     * @param array $config The config for the model
     */
    public function __construct(array $config)
    {
        // TODO can't be spawning a million of these and passing in
        // config the whole time
        $this->request = new RequestHandler($config);
        $this->config = $config;
    }

    /**
     * Ensure attempted sets are valid
     *
     * The key has to be defined in the field map
     * The key needs to be checked if it is read only
     * The key cannot set null if it is not nullable
     * The value for the key must pass validation
     *
     * @var string $key The property
     * @var mixed $value The desired value
     */
    public function __set($key, $value)
    {
        $this->checkDefined($key, $value);
        $this->checkReadOnly($key, $value);
        $this->checkNullable($key, $value);
        $this->checkValidation($key, $value);

        $this->fieldsData[$key] = $value;
    }

    /**
     * __get
     *
     * @param string $key Desired property
     *
     * @thows ModelException
     */
    public function __get($key)
    {
        if (!array_key_exists($key, $this->fields)) {
            $this->throwException(ModelException::GETTING_UNDEFINED_PROPERTY, sprintf('key %s', $key));
        }

        // there is some data loaded so we return it
        if (array_key_exists($key, $this->fieldsData)) {
            return $this->fieldsData[$key];
        }

        // there is some default value
        if (array_key_exists('default', $this->fields[$key])) {
            return $this->fields[$key]['default'];
        }

        // Accessing $obj->key when no default data is set returns null
        // so we return it as default value for any described but not loaded property
        return null;
    }

    /**
     * Returns a JSON representation of the Model
     *
     * Conforms 100% to PilotLive responses and can load into other copies
     *
     * @return string JSON representation of the Model
     */
    public function toJson()
    {
        return json_encode($this->toObject(), JSON_PRESERVE_ZERO_FRACTION);
    }

    /**
     * Returns array representation of the Model
     *
     * @return array
     */
    public function toArray()
    {
        return json_decode($this->toJson(), true);
    }

    /**
     * Switches between our id format and pilot id format
     *
     * PilotLive is PascalCase ours is camelCase
     *
     * @var string $localKey
     *
     * @return string Remote key
     */
    private function getRemoteKey($localKey)
    {
        $remoteKey = ucfirst($localKey);

        return $remoteKey;
    }

    /**
     * Prepare an object row for export
     *
     * @var string $key The objects key
     * @var array $config The configuration for the object field
     *
     * @return mixed
     */
    private function prepareObjectRow($key, $config)
    {
        $value = $this->__get($key);

        // If null and allowed to be null, return null
        if (is_null($value) && $this->fields[$key]['nullable']) {
            return null;
        }

        // If null and can't be null then throw
        if (is_null($value) && !$this->fields[$key]['nullable']) {
            $this->throwException(ModelException::NULL_WITHOUT_NULLABLE, sprintf('key %s', $key));
        }

        // If it's a valid primitive
        if ($this->isValidPrimitive($value, $config['type'])) {
            return $this->$key;
        }

        // If it's a date we return a valid format
        if ($config['type'] === 'DateTime') {
            return $value->format('Y-m-d');
        }

        if (isset($config['collection']) && $config['collection'] === true) {
            return $this->prepareModelCollection($config, $value);
        }

        // At this stage we would be dealing with a related Model
        $class = $this->getModelWithNamespace($config['type']);

        // So if the class doesn't exist, throw
        $this->checkClassExists($class);

        // And finally return an Object representation of the related Model
        return $value->toObject();
    }

    private function checkClassExists($class)
    {
        if (!class_exists($class)) {
            $this->throwException(ModelException::UNEXPECTED_PREPARE_CLASS, sprintf(
                'Received unexpected namespaced class "%s" when preparing an object row',
                $class
            ));
        }
    }

    /**
     * Turns the model collection into an array of models
     *
     * @param array $config The config for the model
     * @param ModelCollection $value Collection which is converted into array
     * @return array
     */
    private function prepareModelCollection(array $config, ModelCollection $value)
    {
        $class = $this->getModelWithNamespace($config['type']);
        if (!class_exists($class)) {
            $this->throwException(ModelException::COLLECTION_WITHOUT_CLASS, sprintf(
                'Class "%s" for collection does not exist',
                $class
            ));
        }
        $rows = [];
        foreach ($value->results as $result) {
            $rows[] = $result->toObject();
        }
        return $rows;
    }

    /**
     * Turns the model into an object for exporting.
     *
     * Loops through valid fields and exports only those, so as to match the
     * PilotLive API responses.
     *
     * @return object
     */
    private function toObject()
    {
        $result = [];
        foreach ($this->fields as $localKey => $config) {
            $remoteKey = $this->getRemoteKey($localKey);
            $result[$remoteKey] = $this->prepareObjectRow($localKey, $config);
        }
        return $result;
    }

    /**
     * Process an item during loading a payload
     *
     * @var $resultItem The item to load
     * @var $config The configuration for the item
     *
     * @return mixed
     */
    private function processResultItem($resultItem, $config)
    {
        if($config['type'] === 'double'){
            $resultItem = (double)$resultItem;
        }
        if ($this->isValidPrimitive($resultItem, $config['type'])) {
            return $resultItem;
        }

        // If it's a date we return a new DateTime object
        if ($config['type'] === \DateTime::class) {
            return new \DateTime($resultItem);
        }

        if (isset($config['collection']) && $config['collection'] === true) {
            $class = $this->getModelWithNamespace($config['type']);
            if (!class_exists($class)) {
                $this->throwException(ModelException::COLLECTION_WITHOUT_CLASS, sprintf(
                    'class "%s"',
                    $class
                ));
            }
            return new ModelCollection($class, $this->config, $resultItem);
        }

        // If it's null and it's allowed to be null
        if (is_null($resultItem) && ($config['nullable'] === true)) {
            return null;
        }

        // At this stage, any type is going to be a model that needs to be loaded
        $class = $this->getModelWithNamespace($config['type']);

        // So if the class doesn't exist, throw
        if (!class_exists($class)) {
            $this->throwException(ModelException::PROPERTY_WITHOUT_CLASS, sprintf(
                'Received namespaced class "%s" when defined type is "%s"',
                $class,
                gettype($resultItem),
                $resultItem
            ));
        }

        // Make a new instance of the class and load the item
        $instance = new $class($this->config);
        $instance->loadResult($resultItem);

        // Return that instance
        return $instance;
    }

    /**
     * Loads up a result from an object
     *
     * The object can be created by json_decode of a PilotLive response
     *
     * Used for restoring and loading related models
     *
     * @var object $result A raw object representation
     */
    public function loadResult(\stdClass $result)
    {
        // We only care about entries that are defined in the model
        foreach ($this->fields as $key => $config) {
            $remoteKey = $this->getRemoteKey($key);

            // If the payload is missing an item
            if (!property_exists($result, $remoteKey)) {
                if (isset($config['optional']) && $config['optional'] === true) {
                    // this field can be omitted in PilotLive response
                    continue;
                }
                $this->throwException(ModelException::INVALID_LOAD_RESULT_PAYLOAD, sprintf(
                    'Defined key "%s" not present in payload',
                    $key
                ));
            }

            $value = $this->processResultItem($result->$remoteKey, $config);

            // This is similar to __set but it can fill read only fields
            $this->checkDefined($key, $value);
            $this->checkNullable($key, $value);
            $this->checkValidation($key, $value);

            $this->fieldsData[$key] = $value;
        }
    }

    /**
     * Properly handles and throws ModelExceptions
     *
     * @var integer $code The exception code
     * @var string $message Any additional information
     *
     * @throws ModelException
     */
    public function throwException($code, $message = '')
    {
        throw new ModelException($this->endpoint, $code, $message);
    }

    /**
     * Used to determine namespace for related models
     *
     * @var string Name of the model
     *
     * @return string The full namespace for a Model
     */
    private function getModelWithNamespace(string $model)
    {
        return sprintf(
            '%s\Models\%s',
            __NAMESPACE__,
            $model
        );
    }
}
