<?php

namespace Oenstrom\Comment;

// use \Anax\Database\ActiveRecordModel;
use \Oenstrom\Comment\ActiveRecordModelExtender;
// use \Anax\TextFilter\TextFilter;
// use \Oenstrom\User\User;

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



    public function getTags()
    {
        return $this->findAll();
    }



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
     * awd
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
