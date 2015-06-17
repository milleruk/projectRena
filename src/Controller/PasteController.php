<?php
namespace ProjectRena\Controller;

use ProjectRena\RenaApp;

class PasteController
{
    public function pastePage($app)
    {
        $app->render('/paste/paste.twig');
    }

    public function postPaste($app)
    {
        $postData = $app->request->post("paste");
        $timeout = $app->request->post("timeout");
        if (isset($_SESSION["characterName"]))
        {
            $user = $app->users->getUserByName($_SESSION["characterName"]);
            $userID = $user["id"];
            $hash = md5(time() . $_SESSION["characterName"] . $_SESSION["characterID"]);
            $app->paste->createPaste($hash, $userID, $postData, $timeout);
            $app->redirect("/paste/{$hash}/");
        }
        else
        {
            $app->render("/paste/paste.twig", array("error" => "Error, you need to be logged in to post data"));
        }
    }

    public function showPaste($app, $hash)
    {
        $data = $app->paste->getPasteData($hash);
        $pasteData = $data["data"];
        $pasteCreated = $data["created"];
        $app->render("/paste/pasteShow.twig", array("pasteData" => $pasteData, "pasteCreated" => $pasteCreated));
    }
}