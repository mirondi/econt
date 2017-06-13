<?php

namespace VM5\Econt\Parser;

use VM5\Econt\Model\Office;
use VM5\Econt\Model\Street;
use VM5\Econt\Response\OfficesResponse;

class OfficeResponseParser implements Parser
{

    public function parse(\SimpleXMLElement $xml)
    {
        $response = new OfficesResponse();

        foreach ($xml->offices->e as $row) {
            $office = new Office();
            $office->setId((int)$row->id);
            $office->setName($row->name);
            $office->setNameEnglish($row->name_en);
            $office->setOfficeCode($row->office_code);
            $office->setIsMachine((boolean)$row->is_machine);
            $office->setCountryCode($row->country_code);
            $office->setCityId((int)$row->id_city);
            $office->setPostCode($row->post_code);
            $office->setCityName($row->city_name);
            $office->setCityNameEnglish($row->city_name_en);
            $office->setAddress($row->address);
            $office->setAddressEnglish($row->address_en);
            $office->setQuarterId((int)$row->address_details->id_quarter);
            $office->setQuarterName($row->address_details->quarter_name);
            $office->setQuarterNameEnglish($row->address_details->quarter_name_en);
            $office->setStreetId((int)$row->address_details->id_street);


            $street = new Street();
            $street->setName($row->address_details->street_name);
            $street->setNumber($row->address_details->num);
            $street->setBlock($row->address_details->bl);
            $street->setEntrance($row->address_details->vh);
            $street->setFloor($row->address_details->et);
            $street->setApartment($row->address_details->ap);
            $street->setOther($row->address_details->other);


            $office->setEmail($row->email);
            $office->setPhoneNumber($row->phone);
            $office->setWorkBegin(new \DateTime($row->work_begin));
            $office->setWorkEnd(new \DateTime($row->work_end));
            $office->setWorkBeginSaturday(new \DateTime($row->work_begin_saturday));
            $office->setWorkEndSaturday(new \DateTime($row->work_end_saturday));
            $office->setUpdatedOn(new \DateTime($row->updated_time));
            $office->setHubCode($row->hub_code);
            $office->setHubName($row->hub_name);
            $office->setHubNameEnglish($row->hub_name_en);

            $response->addOffice($office);
        }

        return $response;
    }
}