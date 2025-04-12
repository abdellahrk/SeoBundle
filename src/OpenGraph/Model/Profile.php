<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\SeoBundle\OpenGraph\Model;

class Profile
{
    protected string $firstName = '';

    protected string $lastName = '';

    protected string $userName = '';

    protected string $gender = '';

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Profile
     */
    public function setFirstName(string $firstName): Profile
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Profile
     */
    public function setLastName(string $lastName): Profile
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return Profile
     */
    public function setUserName(string $userName): Profile
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Profile
     */
    public function setGender(string $gender): Profile
    {
        $this->gender = $gender;
        return $this;
    }
}