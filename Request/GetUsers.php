<?php
namespace Christiaan\ZohoCRMClient\Request;

/**
 * GetRecords API Call
 *
 * You can use the getRecords method to fetch all users data specified in the API request.
 *
 * @see https://www.zoho.com/crm/help/api/getrecords.html
 */
class GetUsers extends AbstractRequest
{
    protected function configureRequest()
    {
        $this->request
            ->setMethod('getUsers')
            ->setParam('selectColumns', 'All');
    }

    /**
     * @param string $type
     * @return GetUsers
     */
    public function type($type)
    {
        $this->request->setParam('type', $type);

        return $this;
    }
}
