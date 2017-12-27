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

/**
 * This is an interface to work with Bulkload.
 *
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
interface BulkLoadInterface
{
    /**
     * Get the bulkLoad template name.
     * @return string
     */
    public function getBulkLoadTemplateName();

    /**
     * Get excel cell range.
     * @return string
     */
    public function getExcelRange();

    /**
     * Get reques field name.
     * @return string
     */
    public function getFieldName();

    /**
     * Get reques field name.
     * @return string
     */
    public function createItem(array $item);
}
