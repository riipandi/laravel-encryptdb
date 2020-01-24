<?php

namespace Riipandi\LaravelEncryptDb\Traits;

use Exception;
use Illuminate\Support\Facades\Crypt;

trait HasEncryptable
{
    /**
     * Decrypt the column value if it is in the encrypted array.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptedFields ?? [])) {
            $value = self::decryptValue($value);
        }

        return $value;
    }

    /**
     * Set the value, encrypting it if it is in the encrypted array.
     *
     * @param $key
     * @param $value
     *
     * @return
     */
    public function setAttribute($key, $value)
    {
        if ($value !== null && in_array($key, $this->encryptedFields ?? [])) {
            $value = self::encryptValue($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Retrieves all values and decrypts them if needed.
     *
     * @return mixed
     */
    public function attributesToArray(): array
    {
        $attributes = parent::attributesToArray();

        if (empty($attributes)) {
            return $attributes;
        }

        foreach ($attributes as $key => $value) {
            if (! in_array($key, $this->encryptedFields) || is_null($value) || $value === '') {
                continue;
            }

            $attributes[$key] = self::decryptValue($value);
        }

        return $attributes;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    private function encryptValue($value): string
    {
        try {
            $value = Crypt::encrypt($value);
        } catch (Exception $e) {
            //
        }

        return $value;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    private function decryptValue($value): string
    {
        try {
            $value = Crypt::decrypt($value);
        } catch (Exception $e) {
            //
        }

        return $value;
    }
}
