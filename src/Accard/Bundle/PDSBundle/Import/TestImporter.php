<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\PDSBundle\Import;

use DateTime;
use Accard\Bundle\ImportBundle\Import\Importer;
use Accard\Bundle\ImportBundle\Import\ImportBuilderInterface;
use Accard\Bundle\ImportBundle\Model\ImportInterface;
use Accard\Bundle\CoreBundle\Import\PatientImporterInterface;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query;

/**
 * Test importer.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class TestImporter extends Importer implements PatientImporterInterface
{
    /**
     * PDS connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * Tests.
     *
     * @var array
     */
    private $tests;

    /**
     * Default start date.
     *
     * @var DateTime
     */
    private $defaultStartDate;

    /**
     * Constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection, array $tests, DateTime $defaultStartDate = null)
    {
        $this->connection = $connection;
        $this->tests = $tests;
        $this->defaultStartDate = $defaultStartDate ?: new DateTime('1 month ago');
    }

    /**
     * {@inheritdoc}
     */
    public function run(ImportBuilderInterface $builder)
    {
        $criteria = $this->builder->getImport()->getCriteria();
        $stmt = $this->connection->prepare($this->getSQL());
        $stmt->execute(array(
            'mds' => $criteria['start_date']->format('m/d/Y'),
            'mde' => $criteria['end_date']->format('m/d/Y'),
        ));
        $results = $stmt->fetchAll();
        $stmt->closeCursor();

        foreach ($results as $key => $result) {
            $result = array_change_key_case($result, CASE_LOWER);
            $result['tests'] = array();
            $result['tests'][] = sprintf('%s test on %s.', $result['result'], $result['result_date']);

            unset($result['result'], $result['result_date']);
            $builder->addRecord($this, $result);
            unset($results[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createNewCriteria(ImportInterface $lastImport = null)
    {
        if ($lastImport) {
            $criteria = $lastImport->getCriteria();
        } else {
            return null;
        }

        return array(
            'start_date' => $criteria['end_date'],
            'end_date' => new DateTime(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultCriteria()
    {
        return array(
            'start_date' => $this->defaultStartDate,
            'end_date' => new DateTime(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pds_test';
    }

    /**
     * {@inheritdoc}
     */
    public function getRecordViewClass()
    {
        return 'Accard\Bundle\CoreBundle\Import\PatientRecordView';
    }

    private function getSQL()
    {
        $tests = implode(', ', $this->tests);

        return "SELECT
                MRN,
                RESULT,
                RESULT_DATE,
                FIRST_NAME,
                LAST_NAME,
                GENDER,
                RACE,
                DATE_OF_BIRTH,
                DATE_OF_DEATH
            FROM(
                SELECT
                    LPAD(MP.HUP_MRN,9,0) AS MRN,
                    RT.RESULT_ITEM_CODE AS RESULT,
                    TO_CHAR(O.ORDER_DATE, 'mm/dd/yyyy') AS RESULT_DATE,
                    MP.PATIENT_FNAME AS FIRST_NAME,
                    MP.PATIENT_LNAME AS LAST_NAME,
                    MP.GENDER_CODE AS GENDER,
                    MP.RACE_CODE AS RACE,
                    TO_CHAR(MP.BIRTH_DATE, 'mm/dd/yyyy') AS DATE_OF_BIRTH,
                    TO_CHAR(MP.DECEASED_DATE, 'mm/dd/yyyy') AS DATE_OF_DEATH
                FROM PDS_ODS_ORDERS O
                     INNER JOIN PDS_ODS_ENCOUNTER E ON E.PK_ENCOUNTER_ID = O.FK_ENCOUNTER_ID
                     INNER JOIN PDS_ODS_PATIENT P ON P.PK_PATIENT_ID = E.FK_PATIENT_ID
                     INNER JOIN PDS_MDM_PATIENT MP ON MP.PK_PATIENT_ID = P.MDM_PATIENT_ID
                     INNER JOIN PDS_ODS_ORDER_RESULT RE ON RE.FK_ORDER_ID = O.PK_ORDER_ID
                     INNER JOIN PDS_ODS_R_RESULT_ITEM RT ON RT.PK_RESULT_ITEM_ID = RE.FK_RESULT_ITEM_ID
                AND O.ORDER_DATE > TO_DATE(:mds, 'mm/dd/yyyy')
                AND RE.RESULT_DATE > TO_DATE(:mds, 'mm/dd/yyyy')
                AND O.ORDER_DATE < TO_DATE(:mde, 'mm/dd/yyyy')
                AND RE.RESULT_DATE < TO_DATE(:mde, 'mm/dd/yyyy')
                AND RT.PK_RESULT_ITEM_ID IN ({$tests})
                AND MP.HUP_MRN IS NOT NULL
            )
            GROUP BY MRN, RESULT, RESULT_DATE, FIRST_NAME, LAST_NAME, GENDER, RACE, DATE_OF_BIRTH, DATE_OF_DEATH
            ORDER BY MRN, RESULT_DATE";
    }
}
