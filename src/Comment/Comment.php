<?php

namespace Oenstrom\Comment;

use \Anax\Database\ActiveRecordModel;
use \Oenstrom\User\User;
use \Anax\TextFilter\TextFilter;

/**
 * A database driven model.
 */
class Comment extends ActiveRecordModelExtender
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "r1_Comment";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $postId;
    public $userId;
    public $content;
    public $created;
    public $updated;
    public $deleted;



    /**
     * Get all comments that belongs the post with the specified id.
     *
     * @param integer $postId The id of the post.
     *
     * @return array as the array of Comment objects.
     */
    public function getComments($postId, $user)
    {
        $comments = $this->findAllWhere("postId = ?", [$postId]);
        foreach ($comments as $comment) {
            $comment->username = $user->find("id", $comment->userId)->username;
        }
        return $comments;
    }



    public function getContent()
    {
        $text = htmlentities($this->content);
        $textfilter = new TextFilter();
        $text = $textfilter->parse($text, ["clickable"])->text;
        return preg_replace("/`(.+?)`/", "<code>$1</code>", $text);
    }



    /**
     * Get all comments as markdown.
     *
     * @param Database $db the database object to use.
     *
     * @return array as the comments.
     */
    public function getAllAsMarkdown($db)
    {
        $comments = $this->findAll();
        foreach ($comments as $comment) {
            $user = new User();
            $user->setDb($db);
            $user->find("id", $comment->userId);
            $comment->content = $this->textfilter->parse($comment->content, ["clickable", "markdown"])->text;
            $comment->username = $user->username;
            $comment->email = $user->email;
        }
        return $comments;
    }
}
