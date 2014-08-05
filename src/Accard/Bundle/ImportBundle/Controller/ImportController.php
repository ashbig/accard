<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\ImportBundle\Controller;

use Accard\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Import controller.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportController extends ResourceController
{
    /**
     * Dashboard action.
     *
     * @param Request $request
     * @return Response
     */
    public function dashboardAction(Request $request)
    {
        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('dashboard.html'))
            ->setData(array(
                'importers' => $this->getImportRegistry()->getImporters(),
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * List importers action.
     *
     * @param Request $request
     * @return Response
     */
    public function listImportersAction(Request $request)
    {
        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('listImporters.html'))
            ->setData(array(
                'importers' => $this->getImportRegistry()->getImporters(),
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * List records action.
     *
     * @param Request $request
     * @return Response
     */
    public function listRecordsAction(Request $request)
    {
        $criteria = $this->config->getCriteria();
        $sorting = $this->config->getSorting();
        $repository = $this->getRecordRepository();

        $records = $repository->createPaginator($criteria, $sorting);
        $records->setCurrentPage($request->get('page', 1), true, true);
        $records->setMaxPerPage($this->config->getPaginationMaxPerPage());

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('listRecords.html'))
            ->setData(array(
                'records' => $records
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * List records my importer action.
     *
     * @param Request $request
     * @param string $importer
     * @return Response
     */
    public function listRecordsByImporterAction(Request $request, $importer)
    {
        $importer = $this->getImporter($importer);
        $criteria = $this->config->getCriteria();
        $sorting = $this->config->getSorting();
        $repository = $this->getRecordRepository();

        $records = $repository->getPaginatorForImporter($importer, $criteria, $sorting);
        $records->setCurrentPage($request->get('page', 1), true, true);
        $records->setMaxPerPage($this->config->getPaginationMaxPerPage());

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('listRecords.html'))
            ->setData(array(
                'importer' => $importer,
                'records' => $records
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Show importer action.
     *
     * @param Request $request
     * @param string $importer
     * @return Response
     */
    public function showImporterAction(Request $request, $importer)
    {
        $importer = $this->getImporter($importer);

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('showImporter.html'))
            ->setData(array(
                'importer' => $importer,
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Show record action.
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function showRecordAction(Request $request, $id)
    {
        if (!$record = $this->getRecord($id)) {
            return $this->createNotFoundException('Import record not found.');
        }

        if ($request->isXMLHttpRequest()) {
            return new JsonResponse($record);
        }

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('showRecord.html'))
            ->setData(array(
                'record' => $record
            ))
        ;

        return $this->handleView($view);
    }

    /**
     * Accept record action.
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function acceptRecordAction(Request $request, $id)
    {
        if (!$record = $this->getRecord($id)) {
            return $this->createNotFoundException('Import record not found.');
        }

        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array(
                'result' => 'success'
            ));
        }

        return $this->redirectHandler->redirectToReferer();
    }

    /**
     * Decline record action.
     *
     * @param Request $request
     * @param integer $id
     * @param Response
     */
    public function declineRecordAction(Request $request, $id)
    {
        if (!$record = $this->getRecord($id)) {
            return $this->createNotFoundException('Import record not found.');
        }

        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array(
                'result' => 'success'
            ));
        }

        return $this->redirectHandler->redirectToReferer();
    }

    /**
     * Get record.
     *
     * @return RecordInterface|null
     */
    private function getRecord($id)
    {
        return $this->getRecordRepository()->find($id);
    }

    /**
     * Get record repository.
     *
     * @return RecordRepositoryInterface
     */
    private function getRecordRepository()
    {
        return $this->get('accard.repository.record');
    }

    /**
     * Get import repository.
     *
     * @return ImportRepositoryInterface
     */
    private function getImportRepository()
    {
        return $this->get('accard.repository.import');
    }

    /**
     * Get importer analyzer.
     *
     * @return ImporterAnalyzer
     */
    private function getImporterAnalyzer()
    {
        return $this->get('accard.import.analyzer');
    }

    /**
     * Get importer.
     *
     * @param string $importer
     * @return ImporterInterface
     */
    private function getImporter($importer)
    {
        return $this->get('accard.import.importer_registry')->getImporter($importer);
    }

    /**
     * Get import manager.
     *
     * @return ImportManagerInterface
     */
    private function getImportManager()
    {
        return $this->get('accard.import.manager');
    }

    /**
     * Get import registry.
     *
     * @return ImportRegistryInterface
     */
    private function getImportRegistry()
    {
        return $this->get('accard.import.importer_registry');
    }
}
