<?php

namespace Rental\Services\User\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

class GenericUserAccount implements Authenticatable
{
    /**
     * All of the user's attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new generic user object.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get the name of the unique identifier for the user account.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    /**
     * Get the unique identifier for the user account.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $name = $this->getAuthIdentifierName();
        return \Arr::get($this->attributes, $name);
    }

    /**
     * Get the password for the user account.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return \Arr::get($this->attributes, 'password');
    }

    /**
     * Get the "remember me" token value.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return '';
    }

    /**
     * Set the "remember me" token value.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // empty
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }

    public function getUserId()
    {
        return \Arr::get($this->attributes, 'user_id');
    }

    public function getName()
    {
        return \Arr::get($this->attributes, 'name');
    }

    public function getPassword()
    {
        return \Arr::get($this->attributes, 'password');
    }

    public function getAddress()
    {
        return \Arr::get($this->attributes, 'address');
    }

    public function getDivisionId()
    {
        return \Arr::get($this->attributes, 'division_id');
    }

    public function getGroupId()
    {
        return \Arr::get($this->attributes, 'group_id');
    }
}
