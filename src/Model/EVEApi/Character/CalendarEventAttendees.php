<?php

namespace ProjectRena\Model\EVEApi\Character;

use ProjectRena\Lib\PhealLoader;

/**
 * Class CalendarEventAttendees.
 */
class CalendarEventAttendees
{
    /**
     * @var int
     */
    public $accessMask = 4;

    /**
     * @param $apiKey
     * @param $vCode
     * @param $characterID
     * @param array $eventIDs
     *
     * @return mixed
     */
    public function getData($apiKey, $vCode, $characterID, $eventIDs = array())
    {
        $pheal = PhealLoader::loadPheal($apiKey, $vCode);
        $pheal->scope = 'Char';
        $result = $pheal->CalendarEventAttendees(
            array('characterID' => $characterID, 'eventIDs' => implode(',', $eventIDs))
        )->toArray();

        return $result;
    }
}
