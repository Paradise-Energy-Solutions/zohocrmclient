<?php
namespace Christiaan\ZohoCRMClient\Request;

use Christiaan\ZohoCRMClient\Response\MutationResult;

/**
 * Zoho creator InsertRecords API Call
 *
 * @see https://www.zoho.com/creator/help/api/rest-api/rest-api-add-records.html
 */
class CreatorAddRecords extends AbstractRequest
{
    /** @var array */
    private $records = array();

    protected function configureRequest()
    {
        $this->request
            ->setMethod('record/add');
    }

    /**
     * @param array $record Record as a simple associative array
     * @return InsertRecords
     */
    public function addRecord(array $record)
    {
        $this->records[] = $record;
        return $this;
    }

    /**
     * @param array $records array containing records otherwise added by addRecord()
     * @return InsertRecords
     */
    public function setRecords(array $records)
    {
        $this->records = $records;
        return $this;
    }

    /**
     * @return InsertRecords
     */
    public function triggerWorkflow()
    {
        $this->request->setParam('wfTrigger', 'true');
        return $this;
    }

    /**
     * @return InsertRecords
     */
    public function onDuplicateUpdate()
    {
        $this->request->setParam('duplicateCheck', 2);
        return $this;
    }

    /**
     * @return InsertRecords
     */
    public function onDuplicateError()
    {
        $this->request->setParam('duplicateCheck', 1);
        return $this;
    }

    /**
     * @return InsertRecords
     */
    public function requireApproval()
    {
        $this->request->setParam('isApproval', 'true');
        return $this;
    }

    /**
     * @return MutationResult[]
     */
    public function request()
    {
        return $this->request
            ->setParam('xmlData', $this->records)
            ->request();
    }
}
