<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;

/**
 * Class Validator
 * @package App\Validation
 */
class Validator
{
    /** @var  array */
    protected $errors;

    /**
     * @param $request
     * @param $rules
     * @return Validator
     */
    public function validate(Request $request, array $rules): Validator
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            } catch (\InvalidArgumentException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;
        return $this;
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return !empty($this->errors);
    }
}