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
class CustomPost
{
    protected $wordpress;
    protected $postType;

    /**
     * Construct WordPress.
     *
     * @param $wordpressSdk
     */
    public function __construct($wordPressSdk, $postType = 'posts')
    {
        $this->wordpress = $wordPressSdk;
        $this->postType = $postType;
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
     * Get all posts.
     *
     * @return mixed
     */
    public function list()
    {
        $result = $this->wordpress->getCall('/wp-json/wp/v2/'.$this->postType);

        return $result;
    }

    /**
     * Create post.
     *
     * @return mixed
     */
    public function create($data)
    {
        $result = $this->wordpress->postCall('/wp-json/wp/v2/'.$this->postType, $data);

        return $result;
    }

    /**
     * Get post.
     *
     * @return mixed
     */
    public function get($id)
    {
        $result = $this->wordpress->getCall('/wp-json/wp/v2/'.$this->postType.'/'.$id);

        return $result;
    }

    /**
     * Update post.
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $result = $this->wordpress->postCall('/wp-json/wp/v2/'.$this->postType.'/'.$id, $data);

        return $result;
    }

    /**
     * Delete post.
     *
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->wordpress->deleteCall('/wp-json/wp/v2/'.$this->postType.'/'.$id);

        return $result;
    }
}
