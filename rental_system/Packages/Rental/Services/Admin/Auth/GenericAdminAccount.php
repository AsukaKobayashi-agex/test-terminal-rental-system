<?php

namespace Rental\Services\Admin\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

class GenericAdminAccount implements Authenticatable
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
        return 'admin_account_id';
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

    public function getAccountId()
    {
        return \Arr::get($this->attributes, 'admin_account_id');
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
}
