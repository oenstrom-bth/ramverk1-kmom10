<?php

namespace Anax\Book;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class Book extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Book";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $title;
    public $author;
    public $isbn;
    public $link;
}
