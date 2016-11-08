<?php
namespace model;
/**
 * Class SiteInfo
 * @package model
 */
class SiteInfo
{
    /**
     * @var
     */
    private $_title = "";
    /**
     * @var
     */
    private $_description = "";

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /*
     * SetTitle
     *
     * Change the title of the site
     *
     * @param string; $title the new title of the site
     *
     * @return boolean;
     */
    public function setTitle($title)
    {
        $bdd = new Bdd();
        $lan = $_SESSION["lang"] . "Content";
        $updateTitle = $bdd->update("site", array($lan => $title), "field = 'title'");
        if ($updateTitle) {
            $this->_title = $title;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /*
     * SetDescription
     *
     * Change the description of the site
     *
     * @param string; $description the new description of the site
     *
     * @return boolean;
     */
    public function setDescription($description)
    {
        $bdd = new Bdd();
        $lan = $_SESSION["lang"] . "Content";
        $updateDescription = $bdd->update("site", array($lan => $description), "field = 'description'");
        if ($updateDescription) {
            $this->_description = $description;
            return true;
        } else {
            return false;
        }
    }

    /*
     * __construct
     *
     * We get the title and the descirption of the site in the database
     */
    public function __construct()
    {
        $bdd = new Bdd();
        $lan = $_SESSION["lang"] . "Content";
        $site = $bdd->select("site", array("field", $lan), "field = 'title' OR field = 'description'");
        if (!empty($site)) {
            foreach ($site as $array) {
                $field = "_" . $array["field"];
                $this->$field = $array[$lan];
            }
        }
    }
}