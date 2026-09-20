<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

if (!function_exists('validate')) {
    /**
     * Validate a Request or array of data and automatically return JSON response if fails.
     *
     * @param Request|array $data
     * @param array $rules
     * @param array $messages
     * @param string $mode Either 'create' or 'update'
     * @param array $protectedKeys Extra keys that should be blocked on update
     * @param Model|null $model The existing model for update comparison
     * @return array
     */
    function validate(
        Request|array $data,
        array         $rules,
        array         $messages = [],
        string        $mode = 'create',
        array         $protectedKeys = [],
        ?Model        $model = null
    ): array
    {
        // Normalize data
        $input = $data instanceof Request ? $data->all() : $data;

        // 1️. Reject empty body
        if (empty($input)) {
            throw new HttpResponseException(response()->json([
                'error' => [
                    'code' => 422,
                    'name' => 'EMPTY_REQUEST',
                    'message' => 'Request body cannot be empty.',
                ],
            ], 422));
        }

        // 2️. Reject unknown keys
        $extraKeys = array_diff(array_keys($input), array_keys($rules));
        if (!empty($extraKeys)) {
            throw new HttpResponseException(response()->json([
                'error' => [
                    'code' => 422,
                    'name' => 'INVALID_KEYS',
                    'message' => 'Request contains unexpected parameters.',
                    'details' => $extraKeys,
                ],
            ], 422));
        }

        // 3️. Disallow protected keys on update
        if ($mode === 'update') {
            $defaultProtected = ['id', 'created_at', 'updated_at'];
            $blocked = array_merge($defaultProtected, $protectedKeys);
            $violatingKeys = array_intersect(array_keys($input), $blocked);

            if (!empty($violatingKeys)) {
                throw new HttpResponseException(response()->json([
                    'error' => [
                        'code' => 422,
                        'name' => 'PROTECTED_FIELDS',
                        'message' => 'These fields cannot be updated.',
                        'details' => $violatingKeys,
                    ],
                ], 422));
            }
        }

        // 4️. Validate normally
        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator, response()->json([
                'error' => [
                    'code' => 422,
                    'name' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed.',
                    'details' => $validator->errors(),
                ],
            ], 422));
        }

        $validated = $validator->validated();

        return $validated;
    }
}
