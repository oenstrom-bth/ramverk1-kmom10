<?php

namespace Oenstrom\Comment;

use \Oenstrom\Comment\ActiveRecordModelExtender;

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
    public $id;
    public $postId;
    public $tagId;



    /**
     * Get the most popluar tags.
     *
     * @param Integer $limit the number of tags
     *
     * @return Array as array of tags
     */
    public function getPopularTags($limit)
    {
        $this->checkDb();
        $tagsIds = $this->db->connect()
                        ->select("tagId, COUNT(tagId) AS count")
                        ->from($this->tableName)
                        ->groupBy("tagId")
                        ->orderBy("count DESC")
                        ->limit($limit)
                        ->execute()
                        ->fetchAllClass(get_class($this));

        $tags = array_map(function ($obj) {
            $tag = new Tag($this->db);
            $tag->find("id", $obj->tagId);
            $tag->count = $obj->count;
            return $tag;
        }, $tagsIds);
        return $tags;
    }


    public function clear($postId, $db)
    {
        $postTags = $this->findAllWhere("postId = ?", [$postId]);
        foreach ($postTags as $tag) {
            $tag->setDb($db);
            $tag->delete();
        }
    }
}
