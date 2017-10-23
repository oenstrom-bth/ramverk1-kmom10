<?php

namespace Oenstrom\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
// use \Oenstrom\Comment\User;
use \Oenstrom\Comment\HTMLForm\QuestionForm;
use \Oenstrom\Comment\HTMLForm\AnswerForm;

/**
 * A controller class.
 */
class PostController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * Show all comments and comment form.
     *
     * @return void
     */
    public function getQuestions()
    {
        $title       = "Questions";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        $post        = new Post($this->di->get("db"));
        $user        = new User($this->di->get("db"));
        $tag         = $this->di->get("tag");

        $questions = $post->getQuestions();
        foreach ($questions as $question) {
            $question->tags = $tag->getPostTags($question->id);
            $question->user = $user->findAllWhere("id = ?", [$question->userId])[0];//$user->find("id", $question->userId);
        }

        $pag = $this->getPagination($questions);
        $view->add("comment/question-list", [
            "questions" => array_slice($questions, $pag["offset"], $pag["length"], true),
            "pag" => $pag,
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }



    public function getTaggedQuestions($tagName)
    {
        $title       = "Questions tagged with $tagName";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        $post        = new Post($this->di->get("db"));
        $user        = new User($this->di->get("db"));
        $tag         = $this->di->get("tag");

        $questions = $post->getTaggedQuestions($tagName);
        foreach ($questions as $question) {
            $question->tags = $tag->getPostTags($question->id);
            $question->user = $user->findAllWhere("id = ?", [$question->userId])[0];//$user->find("id", $question->userId);
        }

        $pag = $this->getPagination($questions);
        $view->add("comment/question-list", [
            "questions" => array_slice($questions, $pag["offset"], $pag["length"], true),
            "pag" => $pag,
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Get a post of the type "question"
     *
     * @param integer $id the id of the question
     *
     * @return Post the post object
     */
    public function getOneQuestion($id)
    {
        $title       = "Questions";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        $post        = new Post($this->di->get("db"));
        $user        = new User($this->di->get("db"));
        $comment     = $this->di->get("comment");
        $tag         = $this->di->get("tag");

        $question = $post->getOne($id);
        if ($question->type === "answer") {
            $this->di->get("response")->redirect("questions/{$question->parent}");
        }
        $question->tags = $tag->getPostTags($question->id);
        $question->user = $user->find("id", $question->userId);
        $question->comments = $comment->getComments($question->id, new User($this->di->get("db")));
        $answers = $post->getAnswers($question->id, new User($this->di->get("db")), $comment);

        $view->add("comment/question", [
            "question" => $question,
            "answers" => $answers,
        ]);
        return $pageRender->renderPage(["title" => $question->title]);
    }

    public function getPagination($questions)
    {
        $req = $this->di->get("request");
        $page = intval($req->getGet("p", 1));
        $length = intval($req->getGet("l", 0)) ?: 5;
        $last = intval(ceil(count($questions) / $length));
        $start = $page <= 1 ? 1 : $page - 1;
        $end = $page >= $last ? $last : $page + 1;

        return [
            "page" => $page,
            "offset" => ($page - 1) * $length,
            "length" => $length,
            "last" => $last,
            "start" => $start,
            "end" => $end,
        ];
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostCreateQuestion()
    {
        $title      = "Ask Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = $this->di->get("authHelper")->getLoggedInUser();

        if (!$user) {
            $this->di->get("response")->redirect("user/login");
        }

        $form = new QuestionForm($this->di);
        $form->check();
        $view->add("comment/question-form", ["form" => $form->getHTML(["use_buttonbar" => false])]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostEditQuestion($questionId)
    {
        $title      = "Edit Question";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = $this->di->get("authHelper")->getLoggedInUser();
        $post       = new Post($this->di->get("db"));
        $post->find("id", $questionId);

        if (!$user) {
            $this->di->get("response")->redirect("user/login");
        }

        if ($post->userId !== $user->id && $user->role !== "admin") {
            $this->di->get("response")->redirect("questions/$questionId");
        }

        $form = new QuestionForm($this->di, $post);
        $form->check();
        $view->add("comment/question-form", ["form" => $form->getHTML(["use_buttonbar" => false])]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostCreateAnswer($questionId)
    {
        $title      = "Your Answer";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = $this->di->get("authHelper")->getLoggedInUser();
        $question   = new Post($this->di->get("db"));
        $question   = $question->find("id", $questionId);

        if (!$user) {
            $this->di->get("response")->redirect("user/login");
        }

        $form = new AnswerForm($this->di, $questionId);
        $form->check();
        $view->add("comment/answer-form", [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "question" => ["title" => $question->title, "content" => $question->getContentAsMarkdown()],
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostEditAnswer($questionId, $answerId)
    {
        $title      = "Your Answer";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user       = $this->di->get("authHelper")->getLoggedInUser();
        $question   = new Post($this->di->get("db"));
        $answer     = new Post($this->di->get("db"));

        $question->find("id", $questionId);
        $answer->find("id", $answerId);

        if (!$user) {
            $this->di->get("response")->redirect("user/login");
        }

        if ($answer->userId !== $user->id && $user->role !== "admin") {
            $this->di->get("response")->redirect("questions/$questionId");
        }

        $form = new AnswerForm($this->di, $questionId, $answer);
        $form->check();
        $view->add("comment/answer-form", [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "question" => ["title" => $question->title, "content" => $question->getContentAsMarkdown()],
        ]);
        return $pageRender->renderPage(["title" => $title]);
    }
}
