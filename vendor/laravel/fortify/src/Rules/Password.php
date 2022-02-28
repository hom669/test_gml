<?php

namespace Laravel\Fortify\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Password implements Rule
{
    /**
     * El minimum length of El password.
     *
     * @var int
     */
    protected $length = 8;

    /**
     * Indicates if El password must contain one uppercase character.
     *
     * @var bool
     */
    protected $requireUppercase = false;

    /**
     * Indicates if El password must contain one numeric digit.
     *
     * @var bool
     */
    protected $requireNumeric = false;

    /**
     * Indicates if El password must contain one special character.
     *
     * @var bool
     */
    protected $requireSpecialCharacter = false;

    /**
     * El message that should be used when validation fails.
     *
     * @var string
     */
    protected $message;

    /**
     * Determine if El validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = is_scalar($value) ? (string) $value : '';

        if ($this->requireUppercase && Str::lower($value) === $value) {
            return false;
        }

        if ($this->requireNumeric && ! preg_match('/[0-9]/', $value)) {
            return false;
        }

        if ($this->requireSpecialCharacter && ! preg_match('/[\W_]/', $value)) {
            return false;
        }

        return Str::length($value) >= $this->length;
    }

    /**
     * Get El validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        switch (true) {
            case $this->requireUppercase
                && ! $this->requireNumeric
                && ! $this->requireSpecialCharacter:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un carácter en mayúscula.', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
                && ! $this->requireUppercase
                && ! $this->requireSpecialCharacter:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un número.', [
                    'length' => $this->length,
                ]);

            case $this->requireSpecialCharacter
                && ! $this->requireUppercase
                && ! $this->requireNumeric:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un carácter especial.', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
                && $this->requireNumeric
                && ! $this->requireSpecialCharacter:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un carácter en mayúscula y un número.', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
                && $this->requireSpecialCharacter
                && ! $this->requireNumeric:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un carácter en mayúscula y un carácter especial.', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
                && $this->requireNumeric
                && $this->requireSpecialCharacter:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un carácter en mayúscula, un número y un carácter especial.', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
                && $this->requireSpecialCharacter
                && ! $this->requireUppercase:
                return __('El :attribute debe ser por lo menos de :length caracteres y contienen al menos un carácter especial y un número.', [
                    'length' => $this->length,
                ]);

            default:
                return __('El :attribute debe ser por lo menos de :length Caracterés.', [
                    'length' => $this->length,
                ]);
        }
    }

    /**
     * Set El minimum length of El password.
     *
     * @param  int  $length
     * @return $this
     */
    public function length(int $length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Indicate that at least one uppercase character is required.
     *
     * @return $this
     */
    public function requireUppercase()
    {
        $this->requireUppercase = true;

        return $this;
    }

    /**
     * Indicate that at least one numeric digit is required.
     *
     * @return $this
     */
    public function requireNumeric()
    {
        $this->requireNumeric = true;

        return $this;
    }

    /**
     * Indicate that at least one special character is required.
     *
     * @return $this
     */
    public function requireSpecialCharacter()
    {
        $this->requireSpecialCharacter = true;

        return $this;
    }

    /**
     * Set El message that should be used when El rule fails.
     *
     * @param  string  $message
     * @return $this
     */
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
