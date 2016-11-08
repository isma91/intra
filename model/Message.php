<?php
/**
 * Message.php
 *
 * Model of the Message
 *
 * PHP 7.0.8
 *
 * @category Model
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 */
namespace model;
/**
 * Class Message to display the good message, i18n controller
 *
 * @category Class
 * @author   isma91 <ismaydogmus@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
class Message
{
    public $messages = array();

    /**
     * GetMessages
     *
     * Get all messages of the class
     *
     * @return array;
     */
    public function getMessages()
    {
        return $this->messages[$_SESSION["lang"]];
    }

    /**
     * __construct
     *
     * We add all the messages here
     * We create 3 arrays to separate info, error and success messages
     * and we add them in separate languages to add them all in the messages var
     */
    public function __construct()
    {
        /**
         * You need to init all languages you gonna use here
         * don't forget to create folder in the language name in the "view" folder
         * you need to init like this $infoLANGUAGEMessage, $errorLANGUAGEMessage, $successLANGUAGEMessage
         * we have 2 languages by default so we have "en" and "fr" folder in the "view" folder
         */
        $infoFrMessage = array();
        $infoEnMessage = array();
        $errorFrMessage = array();
        $errorEnMessage = array();
        $successFrMessage = array();
        $successEnMessage = array();
        /*
         * Don't forget to add $LANGUAGEMessage here if you add another languages and to add him to messages var
         */
        $frMessage = array("error" => $errorFrMessage, "success" => $successFrMessage, "info" => $infoFrMessage);
        $enMessage = array("error" => $errorEnMessage, "success" => $successEnMessage, "info" => $infoEnMessage);
        $this->messages = array( "fr" => $frMessage, "en" => $enMessage);
    }
}