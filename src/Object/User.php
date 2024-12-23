<?php

namespace MadeITBelgium\WordPress\Object;

/**
 * WordPress PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class User
{
    protected $wordpress;

    /**
     * Construct WordPress.
     *
     * @param $wordpressSdk
     */
    public function __construct($wordPressSdk)
    {
        $this->wordpress = $wordPressSdk;
    }

    public function setWordPressInstance($wordPressSdk)
    {
        $this->wordpress = $wordPressSdk;
    }

    public function getWordPressInstance()
    {
        return $this->wordpress;
    }

    /**
     * Get all users.
     *
     * @return mixed
     */
    public function list()
    {
        $result = $this->wordpress->getCall('/wp/v2/users');

        return $result;
    }

    /**
     * Create user.
     *
     * @return mixed
     */
    public function create($data)
    {
        $result = $this->wordpress->postCall('/wp/v2/users', $data);

        return $result;
    }

    /**
     * Get user.
     *
     * @return mixed
     */
    public function get($id)
    {
        $result = $this->wordpress->getCall('/wp/v2/users/'.$id);

        return $result;
    }

    /**
     * Update user.
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $result = $this->wordpress->postCall('/wp/v2/users/'.$id, $data);

        return $result;
    }

    /**
     * Delete user.
     *
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->wordpress->deleteCall('/wp/v2/users/'.$id);

        return $result;
    }
}
