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
 * Diagnosis importer.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DiagnosisImporter extends Importer implements PatientImporterInterface
{
    /**
     * PDS connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * Diagnosis codes.
     *
     * @var string
     */
    private $codes;

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
     * @param array $code
     * @param DateTime|null $defaultStartDate
     */
    public function __construct(Connection $connection, array $codes, DateTime $defaultStartDate = null)
    {
        $this->connection = $connection;
        $this->codes = $codes;
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
            $result['diagnoses'] = array();
            $result['diagnoses'][] = sprintf('%s diagnosis on %s.', $result['diagnosis'], $result['diagnosis_date']);

            unset($result['diagnosis'], $result['diagnosis_date']);
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
        return 'pds_diagnosis';
    }

    /**
     * {@inheritdoc}
     */
    public function getRecordViewClass()
    {
        return 'Accard\Bundle\CoreBundle\Import\PatientRecordView';
    }

    /**
     * Get SQL statement.
     *
     * @return string
     */
    private function getSQL()
    {
        $codes = "'".implode("', '", $this->codes)."'";

        return "SELECT
                MRN,
                TO_CHAR(DIAGNOSIS_DATE, 'mm/dd/yyyy') AS DIAGNOSIS_DATE,
                DIAGNOSIS,
                FIRST_NAME,
                LAST_NAME,
                GENDER,
                RACE,
                TO_CHAR(DATE_OF_BIRTH, 'mm/dd/yyyy') AS DATE_OF_BIRTH,
                TO_CHAR(DATE_OF_DEATH, 'mm/dd/yyyy') AS DATE_OF_DEATH
            FROM (SELECT
                    LPAD(MP.HUP_MRN, 9, 0) AS MRN,
                    DX.CODING_DATE AS DIAGNOSIS_DATE,
                    CD.CODE AS DIAGNOSIS,
                    MP.PATIENT_FNAME AS FIRST_NAME,
                    MP.PATIENT_LNAME AS LAST_NAME,
                    MP.GENDER_CODE AS GENDER,
                    MP.RACE_CODE AS RACE,
                    MP.BIRTH_DATE AS DATE_OF_BIRTH,
                    MP.DECEASED_DATE AS DATE_OF_DEATH,
                    ROW_NUMBER() OVER (PARTITION BY MP.HUP_MRN ORDER BY DX.CODING_DATE) AS ROW_NUM
                FROM PDS_ODS_DIAGNOSIS DX
                INNER JOIN PDS_ODS_ENCOUNTER E ON E.PK_ENCOUNTER_ID = DX.FK_ENCOUNTER_ID
                INNER JOIN PDS_ODS_R_CODES_DIAGNOSIS CD on CD.PK_DX_CODE_ID = DX.FK_DX_CODE_ID
                INNER JOIN PDS_ODS_PATIENT P  on P.PK_PATIENT_ID = E.FK_PATIENT_ID
                INNER JOIN PDS_MDM_PATIENT mp on MP.PK_PATIENT_ID = P.MDM_PATIENT_ID
                WHERE CD.CODE IN ({$codes})
                  AND DX.CODING_DATE > TO_DATE(:mds, 'mm/dd/yyyy')
                  AND E.ENC_DATE > TO_DATE(:mds, 'mm/dd/yyyy')
                  AND DX.CODING_DATE < TO_DATE(:mde, 'mm/dd/yyyy')
                  AND E.ENC_DATE < TO_DATE(:mde, 'mm/dd/yyyy')
                  AND MP.HUP_MRN IS NOT NULL
                  AND E.SOURCE_CODE IN ('HDMHUP', 'HDMPMC', 'CLINTRAC', 'EPIC')
            )
            WHERE ROW_NUM = 1
            ORDER BY MRN, DIAGNOSIS_DATE";
    }
}
