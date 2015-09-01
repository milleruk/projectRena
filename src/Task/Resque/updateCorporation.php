<?php

namespace ProjectRena\Task\Resque;

/**
 * Class updateCharacter
 *
 * @package ProjectRena\Task\Resque
 */
class updateCorporation
{
    /**
     * @var
     */
    protected $app;

    /**
     *
     */
    public function setUp()
    {
        $this->app = \ProjectRena\RenaApp::getInstance();
    }

    /**
     *
     */
    public function perform()
    {
        if($this->app->Storage->get("Api904") >= date("Y-m-d H:i:s")) return;

        $this->app->StatsD->increment("ccpRequests");
        $this->app->StatsD->increment("corporationsUpdated");
        $corporationID = $this->args["corporationID"];

        // Just exit if the corporationID is 0
        if($corporationID == 0)
            exit;

        // Get the character affiliate data
        $data = $this->app->EVECorporationCorporationSheet->getData(null, null, $corporationID);
        $this->app->corporations->updateCorporationDetails($corporationID, $data["result"]["allianceID"], $data["result"]["corporationName"], $data["result"]["ceoID"], $data["result"]["ticker"], $data["result"]["memberCount"], json_encode($data["result"]));
        $this->app->corporations->setLastUpdated($corporationID, date("Y-m-d H:i:s"));
    }

    /**
     *
     */
    public function tearDown()
    {
        $this->app = null;
    }
}
