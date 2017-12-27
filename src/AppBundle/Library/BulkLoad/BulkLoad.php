<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Library\BulkLoad;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\ExcelReaderService;
use BackendBundle\Entity\Team;
use BackendBundle\Entity\PlayerPosition;
use AppBundle\Manager\UserManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Monolog\Logger;

/**
 * This class represent the bulkload process of entity.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
abstract class BulkLoad
{
    /**
     * @var \AppBundle\Manager\UserManager
     */
    protected $userManager;

    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    protected $file;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var \Symfony\Bridge\Monolog\Logger
     */
    protected $logger;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $manager;

    /**
     * @var \AppBundle\Service\ExcelReaderService
     */
    private $excelReader;

    /**
     * @var \Doctrine\ORM\EntityManager[]
     */
    private $repos;

    public function __construct(
        RequestStack $requestStack,
        UserManager $userManager,
        EntityManager $entityManager,
        ExcelReaderService $excelReaderService,
        Logger $logger,
        $blockPrefix
    ) {
        if (!is_a($this, 'AppBundle\Library\BulkLoad\BulkLoadInterface')) {
            throw new RuntimeException(sprintf(
                'This class must be an implement of %',
                'AppBundle\Library\BulkLoad\BulkLoadInterface'
            ));
        }
        $request = $requestStack->getCurrentRequest();
        $this->rootDir = $request->server->get('DOCUMENT_ROOT');
        $this->manager = $entityManager;
        $this->userManager = $userManager;
        $this->excelReader = $excelReaderService;
        $this->logger = $logger;
        $this->setFile($request, $blockPrefix)->processFile()->loadRepositoties();
    }

    public function getBulkLoadTemplate()
    {
        return sprintf(
            "%s/bundles/app/templates/%s",
            $this->rootDir,
            $this->getBulkLoadTemplateName()
        );
    }

    /**
     * Get yhe EntityRepository of entity
     * @param  string $entityname
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepo($entityname)
    {
        return $this->repos[$entityname];
    }

    private function setFile(Request $request, $blockPrefix)
    {
        if ($blockPrefix) {
            $this->file = $request->files->get($blockPrefix)[$this->getFieldName()];
        } else {
            $this->file = $request->files->get($this->getFieldName());
        }

        return $this;
    }

    /**
     * Process upload excel file.
     * @return self
     */
    private function processFile()
    {
        if (is_a($this->file, 'Symfony\Component\HttpFoundation\File\UploadedFile')) {
            $data = $this->excelReader->excelToArray(
                $this->file,
                $this->getExcelRange()
            );
            foreach ($data as $item) {
                $this->data[] = $this->createItem($item);
            }
        }
        return $this;
    }

    /**
     * Load repositories.
     * @return static
     */
    private function loadRepositoties()
    {
        foreach ($this->getEntities() as $entity) {
            $namespace = explode("\\", $entity);
            $this->repos[end($namespace)] = $this->manager->getRepository($entity);
        }
        return $this;
    }

    /**
     * Get entities repositories.
     * @return array
     */
    private function getEntities()
    {
        return [
            Team::class,
            PlayerPosition::class,
        ];
    }
}
