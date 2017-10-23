<?php

namespace Oenstrom\Comment;

// use \Anax\Database\ActiveRecordModel;
use \Oenstrom\Comment\ActiveRecordModelExtender;
use \Anax\TextFilter\TextFilter;
// use \Oenstrom\User\User;

/**
 * A database driven model.
 */
class Post extends ActiveRecordModelExtender
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "r1_Post";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userId;
    public $type;
    public $parent;
    public $content;
    public $created;
    public $updated;
    public $deleted;



    /**
     * Get a post with the specified id.
     *
     * @param Integer $id as the Post id.
     *
     * @return Post the Post object.
     */
    public function getOne($id)
    {
        return $this->find("id", $id);
    }



    /**
     * Get all posts of the type "question".
     *
     * @return Array as the array of Post objects
     */
    public function getQuestions($where = "type = ?", $params = ["question"])
    {
        $questions = $this->findAllWhereOrderBy($where, $params, "created DESC");
        return $questions;
    }



    /**
     * Get all posts of the type "question" tagged with the specified tag.
     *
     * @return Array as the array of Post objects
     */
    public function getTaggedQuestions($tagName)
    {
        $this->checkDb();
        $questions = $this->db->connect()
                              ->select("r1_Post.*")
                              ->from($this->tableName)
                              ->join("r1_PostTag", "r1_Post.id = r1_PostTag.postId")
                              ->join("r1_Tag", "r1_PostTag.tagId = r1_Tag.id")
                              ->where("r1_Tag.tag = ?")
                              ->orderBy("r1_Post.created DESC")
                              ->execute([$tagName])
                              ->fetchAllClass(get_class($this));
        // $questions = $this->findAllWhereOrderBy("type = ?", ["question"], "created DESC");
        return $questions;
    }



    /**
     * Get the content parsed as markdown.
     *
     * @return String as the content parsed as markdown
     */
    public function getContentAsMarkdown($filter = ["markdown"])
    {
        $filter = is_array($filter) ? $filter : [$filter];
        $textFilter = new TextFilter();
        return $textFilter->parse($this->content, $filter)->text;
    }



    /**
     * Get all answers for a question.
     *
     * @param Integer $questionId the id of the question
     * @param User the User object
     * @param Comment the Comment object
     *
     * @return Array as the array of answers
     */
    public function getAnswers($questionId, $user, $comment)
    {
        $answers = $this->findAllWhere("type = ? AND parent = ?", ["answer", $questionId]);
        foreach ($answers as $answer) {
            $answer->user = $user->findAllWhere("id = ?", [$answer->userId])[0];
            $answer->comments = $comment->getComments($answer->id, $user);
        }
        return $answers;
    }



    // /**
    //  * Set textfilter.
    //  *
    //  * @param TextFilter $textfilter as the textfilter object.
    //  */
    // public function setTextfilter($textfilter)
    // {
    //     $this->textfilter = $textfilter;
    // }
    //
    //
    //
    // /**
    //  * Get all comments as markdown.
    //  *
    //  * @param Database $db the database object to use.
    //  *
    //  * @return array as the comments.
    //  */
    // public function getAllAsMarkdown($db)
    // {
    //     $comments = $this->findAll();
    //     foreach ($comments as $comment) {
    //         $user = new User();
    //         $user->setDb($db);
    //         $user->find("id", $comment->userId);
    //         $comment->content = $this->textfilter->parse($comment->content, ["clickable", "markdown"])->text;
    //         $comment->username = $user->username;
    //         $comment->email = $user->email;
    //     }
    //     return $comments;
    // }
}
