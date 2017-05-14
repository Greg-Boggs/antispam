<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Message;
use B8\B8;

class MessageController extends FOSRestController
{
    /**
     * @Rest\Get("/")
     */
    public function indexAction(Request $request)
    {
        $config_b8 = [
          'storage' => 'mysqli'
        ];
        $config_storage = [
          'database'   => 'b8',
          'table_name' => 'b8_wordlist',
          'host'       => 'localhost',
          'user'       => 'root',
          'pass'       => 'root'
        ];
        $config_lexer = [
          'old_get_html' => FALSE,
          'get_html'     => TRUE
        ];

        $config_degen = [
          'multibyte' => TRUE
        ];

        $b8 = new B8($config_b8, $config_storage, $config_lexer, $config_degen);

        $view = $this->view(['hello' => 'world'], Response::HTTP_OK);
        return $view;
    }

    /**
    * @Rest\Post("/message/")
    */
    public function postMessageAction(Request $request)
    {
        $message = new Message;
        $name = $request->get('name');
        $email = $request->get('email');
        $text = $request->get('text');

        if(empty($text))
        {

            return new View("Empty messages are not allowed", Response::HTTP_NOT_ACCEPTABLE);
        }
        if (isset($name)) {
            $message->setName($name);
        }
        $message->setEmail($email);
        $message->setText($text);

        $config_b8 = [
          'storage' => 'mysqli'
        ];
        $config_storage = [
          'database'   => 'b8',
          'table_name' => 'b8_wordlist',
          'host'       => 'localhost',
          'user'       => 'root',
          'pass'       => 'root'
        ];
        $config_lexer = [
          'old_get_html' => FALSE,
          'get_html'     => TRUE
        ];

        $config_degen = [
          'multibyte' => TRUE
        ];

        $b8 = new B8($config_b8, $config_storage, $config_lexer, $config_degen);
        return new View($b8->classify($message->getFullMessage()), Response::HTTP_OK);
    }
    /**
     * @Rest\Put("/spam/update")
     */
    public function postSpamUpdateAction(Request $request)
    {
        $message = new Message;
        $name = $request->get('name');
        $email = $request->get('email');
        $text = $request->get('text');

        if(empty($text))
        {

            return new View("Empty messages are not allowed", Response::HTTP_NOT_ACCEPTABLE);
        }
        if (isset($name)) {
            $message->setName($name);
        }
        $message->setEmail($email);
        $message->setText($text);

        $config_b8 = [
          'storage' => 'mysqli'
        ];
        $config_storage = [
          'database'   => 'b8',
          'table_name' => 'b8_wordlist',
          'host'       => 'localhost',
          'user'       => 'root',
          'pass'       => 'root'
        ];
        $config_lexer = [
          'old_get_html' => FALSE,
          'get_html'     => TRUE
        ];

        $config_degen = [
          'multibyte' => TRUE
        ];

        $b8 = new B8($config_b8, $config_storage, $config_lexer, $config_degen);
        $b8->learn($message->getFullMessage(), B8::SPAM);

        return new View('Spam Reported.', Response::HTTP_OK);
    }
    /**
     * @Rest\Put("/ham/update")
     */
    public function postHamUpdateAction(Request $request)
    {
        $message = new Message;
        $name = $request->get('name');
        $email = $request->get('email');
        $text = $request->get('text');

        if(empty($text))
        {

            return new View("Empty messages are not allowed", Response::HTTP_NOT_ACCEPTABLE);
        }
        if (isset($name)) {
            $message->setName($name);
        }
        $message->setEmail($email);
        $message->setText($text);

        $config_b8 = [
          'storage' => 'mysqli'
        ];
        $config_storage = [
          'database'   => 'b8',
          'table_name' => 'b8_wordlist',
          'host'       => 'localhost',
          'user'       => 'root',
          'pass'       => 'root'
        ];
        $config_lexer = [
          'old_get_html' => FALSE,
          'get_html'     => TRUE
        ];

        $config_degen = [
          'multibyte' => TRUE
        ];

        $b8 = new B8($config_b8, $config_storage, $config_lexer, $config_degen);
        $b8->learn($message->getFullMessage(), B8::HAM);

        return new View('Ham Reported.', Response::HTTP_OK);
    }
}
