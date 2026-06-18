<?php namespace XFRM\Controller;
defined('_XFRM_API') or exit('No direct script access allowed here.');

use XFRM\Object\Author as Author;
use XFRM\Util\RequestUtil as Req;

class AuthorController
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAuthor()
    {
        Req::checkIdParam();

        $author = $this->database->getUser(Req::id());
        if (!is_null($author) && $author !== false) {
            return new Author($author);
        }

        return NULL;
    }

    public function findAuthor()
    {
        Req::checkNameParam();

        $author = $this->database->findUser(Req::name());
        if (!is_null($author) && $author !== false) {
            return new Author($author);
        }

        return NULL;
    }
}
