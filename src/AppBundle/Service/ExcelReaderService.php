<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * This class read an xls, xlsx and ods file an convert in array.
 *
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class ExcelReaderService
{
    public function excelToArray(UploadedFile $file, $range)
    {
        $data = [];
        if ($reader = $this->getReader($file)) {
            $excel = $reader->load($file->getPathname());
            foreach ($excel->getWorksheetIterator() as $worksheet) {
                $rows = $worksheet->rangeToArray($range, '', true, true, false);
                foreach ($rows as $value) {
                    if (!empty($value[0])) {
                        $data[] = $value;
                    }
                }
            }
        }
        return $data;
    }

    private function getReader(UploadedFile $file)
    {
        $reader = null;
        $support = ['xls' => 'Excel5', 'xlsx' => 'Excel2007', 'ods' => 'OOCalc'];
        $fileExtension = $file->getClientOriginalExtension();
        if (isset($support[$fileExtension])) {
            $reader = \PHPExcel_IOFactory::createReader($support[$fileExtension]);
        }
        return $reader;
    }
}
