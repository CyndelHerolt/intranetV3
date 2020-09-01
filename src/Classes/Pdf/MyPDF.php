<?php
// Copyright (c) 2020. | David Annebicque | IUT de Troyes  - All Rights Reserved
// @file /Users/davidannebicque/htdocs/intranetV3/src/Classes/Pdf/MyPDF.php
// @author davidannebicque
// @project intranetV3
// @lastUpdate 01/09/2020 17:50

/**
 * Created by PhpStorm.
 * User: davidannebicque
 * Date: 26/07/2018
 * Time: 08:10
 */

namespace App\Classes\Pdf;

use App\Entity\Departement;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MyPDF
{
    /** @var Dompdf */
    protected static $domPdf;

    protected static $options;

    /** @var Environment */
    protected static $templating;

    /**
     * MyPDF constructor.
     *
     * @param Environment $templating
     */
    public function __construct(Environment $templating)
    {
        self::$templating = $templating;
        self::$options = new Options();

        self::$options->set('isRemoteEnabled', true);
        self::$options->set('isPhpEnabled', true);
        self::$options->set('defaultPaperSize', 'A4');
        self::$options->set('defaultPaperSize', 'A4');
    }

    /**
     * @param array $options
     */
    public static function addOptions(array $options):void
    {
    }

    /**
     * @param $template
     * @param $data
     * @param $name
     * @param $departement
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public static function generePdf($template, $data, $name, $departement): void
    {
        self::genereOutputPdf($template, $data, $departement);

        self::$domPdf->stream($name, ['Attachment' => 1]);
    }

    public static function genereAndSavePdf(
        string $template,
        array $data,
        string $name,
        string $dir,
        string $departement
    ): void {
        self::genereOutputPdf($template, $data, $departement);

        $output = self::$domPdf->output();

        file_put_contents($dir . $name . '.pdf', $output);

    }

    /**
     * @param $template
     * @param $data
     * @param $departement
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private static function genereOutputPdf($template, $data, $departement): void
    {
        $html = self::$templating->render($template, $data);

        self::$domPdf = new Dompdf(self::$options);
        self::$domPdf->loadHtml($html);
        self::$domPdf->render();

        $date = new DateTime('now');
        $canvas = self::$domPdf->getCanvas();
        $canvas->page_text(500, 800, 'Page {PAGE_NUM} sur {PAGE_COUNT}', 'Arial', 10, [0, 0, 0]);
        $canvas->page_text(43, 800, $departement . ' | ' . $date->format('d/m/Y') . '. Généré depuis l\'intranet',
            'Arial', 10, [0, 0, 0]);
    }
}
