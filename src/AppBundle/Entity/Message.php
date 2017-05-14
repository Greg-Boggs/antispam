<?php

namespace AppBundle\Entity;

/**
 * Message
 */
class Message
{
    private $name;
    private $email;
    private $text;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Message
     */
    public function setName($name)
    {
        $name = htmlentities(stripslashes($name), ENT_QUOTES, 'UTF-8');
        $this->name = $name;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Message
     */
    public function setEmail($email)
    {
        $email = htmlentities(stripslashes($email), ENT_QUOTES, 'UTF-8');
        $this->email = $email;

        return $this;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Message
     */
    public function setText($text)
    {
        $text = htmlentities(stripslashes($text), ENT_QUOTES, 'UTF-8');
        $this->text = $text;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get full message
     *
     * @return string
     */
    public function getFullMessage()
    {
        return $this->name . $this->email . $this->text;
    }
}

