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

use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Entity\Team;
use AppBundle\Library\Item\PlayerItem;

/**
 * This class is an implementation of Bulkload of Players.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class PlayerBulkLoad extends BulkLoad implements BulkLoadInterface
{
    public function importProcess(Team $team)
    {
        foreach ($this->data as $item) {
            try {
                $this->userManager->createOrUpdatePlayer(
                    $team,
                    $item,
                    $this->getPositions($item->positions)
                );
            } catch (\Exception $e) {
                $this->logger->critical("[Player BulkLoad] ".$e->getMessage(), [
                    'Team name' => $team->getName(),
                    'Player Item' => $item
                ]);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getExcelRange()
    {
        return 'A3:I103';
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkLoadTemplateName()
    {
        return "team-bulkload.xls";
    }

    /**
     * {@inheritDoc}
     */
    public function getFieldName()
    {
        return 'playersfile';
    }

    /**
     * {@inheritDoc}
     */
    public function createItem(array $item)
    {
        return new PlayerItem($item);
    }

    private function getPositions(array $positions)
    {
        $repo = $this->getRepo('PlayerPosition');
        return array_filter(array_map(function($acronym) use ($repo) {
            return $repo->findOneBy(['acronym' => $acronym, 'status' => 1]);
        }, $positions));
    }
}
