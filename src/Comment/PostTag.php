<?php

namespace Oenstrom\Comment;

// use \Anax\Database\ActiveRecordModel;
use \Oenstrom\Comment\ActiveRecordModelExtender;
// use \Anax\TextFilter\TextFilter;
// use \Oenstrom\User\User;

/**
 * A database driven model.
 */
class PostTag extends ActiveRecordModelExtender
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "r1_PostTag";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $postId;
    public $tagId;


    public function clear($postId, $db)
    {
        $postTags = $this->findAllWhere("postId = ?", [$postId]);
        foreach ($postTags as $tag) {
            $tag->setDb($db);
            $tag->delete();
        }
    }
}
