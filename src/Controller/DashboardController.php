<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();

        $porMes = $conn->executeQuery("
            SELECT MONTH(fecha) AS mes, COUNT(*) AS total 
            FROM siniestro 
            GROUP BY MONTH(fecha)
            ORDER BY mes
        ")->fetchAllAssociative();

        $porClima = $conn->executeQuery("
            SELECT c.descripcion AS clima, COUNT(s.id) AS total
            FROM siniestro s
            LEFT JOIN clima c ON s.clima_id = c.id
            GROUP BY c.descripcion
        ")->fetchAllAssociative();

        return $this->render('dashboard/index.html.twig', [
            'porMes' => $porMes,
            'porClima' => $porClima,
        ]);
    }

    // EXPORTAR PDF
    #[Route('/export/pdf', name: 'dashboard_export_pdf')]
    public function exportPdf(EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();
        $data = $conn->executeQuery("
            SELECT s.id, s.fecha, s.hora, c.descripcion AS clima, s.obs
            FROM siniestro s
            LEFT JOIN clima c ON s.clima_id = c.id
            ORDER BY s.fecha DESC
        ")->fetchAllAssociative();

        $html = $this->renderView('dashboard/export_pdf.html.twig', [
            'siniestros' => $data,
        ]);

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="reporte_siniestros.pdf"',
        ]);
    }
}
