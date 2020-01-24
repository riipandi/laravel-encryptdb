<?php

namespace Riipandi\LaravelEncryptDb\Traits;

use Exception;
use Illuminate\Support\Facades\Crypt;

trait HasEncryptable
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute(string $key)
    {
        $value = parent::getAttribute($key);

        if (! in_array($key, $this->encryptable) || is_null($value) || $value === '') {
            return $value;
        }

        return self::decryptValue($value);
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function setAttribute(string $key, $value)
    {
        if (! in_array($key, $this->encryptable)) {
            return parent::setAttribute($key, $value);
        }

        $value = self::encryptValue($value);

        return parent::setAttribute($key, $value);
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        $attributes = parent::attributesToArray();

        if (empty($attributes)) {
            return $attributes;
        }

        foreach ($attributes as $key => $value) {
            if (! in_array($key, $this->encryptable) || is_null($value) || $value === '') {
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
