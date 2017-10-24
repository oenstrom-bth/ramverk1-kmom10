<?php

namespace Oenstrom\Comment;

use \Oenstrom\Comment\ActiveRecordModelExtender;

/**
 * A database driven model.
 */
class Tag extends ActiveRecordModelExtender
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "r1_Tag";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $tag;
    public $description;
    public $created;
    public $deleted;



    /**
     * Get all tags.
     *
     * @return Array as the array with Tag objects
     */
    public function getTags()
    {
        return $this->findAll();
    }



    /**
     * Get only the names of the tags.
     *
     * @return Array as array with tag names
     */
    public function getTagNames()
    {
        $tags = $this->getTags();
        $returnTags = [];
        foreach ($tags as $tag) {
            array_push($returnTags, $tag->tag);
        }
        return $returnTags;
    }



    /**
     * Get tags connected to a post.
     *
     * @param Integer $postId the id of the post
     *
     * @return Array as the array of tags.
     */
    public function getPostTags($postId)
    {
        $joinTable = "r1_PostTag";
        $tags = $this->findAllJoinWhere(
            $joinTable,
            $this->tableName . ".id = " . $joinTable . ".tagId",
            "r1_PostTag.postId = ?",
            [$postId]
        );
        return $tags;
    }
}
