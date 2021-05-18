<?php


namespace backend\controllers;


use yii\web\Controller;
use backend\models\Conversation;
use backend\models\Message;
use bubasuma\simplechat\controllers\ControllerTrait;


class MessageController extends Controller
{
    use ControllerTrait;

    /**
     * @return string
     */
    public function getMessageClass()
    {
        return Message::className();
    }

    /**
     * @return string
     */
    public function getConversationClass()
    {
        return Conversation::className();
    }
}