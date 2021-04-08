<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use PDF;
use \Carbon\Carbon;

class CertificateService {

    public static $options = [
        "margin-top" => '35mm',
        "margin-bottom" => '55mm',
        "margin-left" => '0mm',
        "margin-right" => '0mm',
        "images" => true,
    ];

    // Gera certificado de participação
    public static function participationCertificate( $project ) {

        $header = \View::make('pdf.certificate.templates.participation.partials.header')->render();
        $footer = \View::make('pdf.certificate.templates.participation.partials.footer')->render();

        $students  = self::getStudents($project);    
        $educators = self::getTeachers($project);
        $schools   = self::getSchools($project);
    
        // Gera primera página
        $pages[] = \View::make('pdf.certificate.templates.participation.front', [
            'project' => $project,
            'schools' => $schools
        ]);
        
        // Gera segunda página
        $pages[] = \View::make('pdf.certificate.templates.participation.back', [
            'students' => $students,
            'educators' => $educators
        ]);

        $file = self::generatePDF($pages,$header,$footer);

        return self::saveFile($project,$file);

    }

    // Gera certificado de finalista
    public static function finalistCertificate( $project ) {

        $header = \View::make('pdf.certificate.templates.finalist.partials.header')->render();
        $footer = \View::make('pdf.certificate.templates.finalist.partials.footer')->render();

        $students  = self::getStudents($project);    
        $educators = self::getTeachers($project);
        $schools   = self::getSchools($project);
    
        // Gera primera página
        $pages[] = \View::make('pdf.certificate.templates.finalist.front', [
            'project' => $project,
            'schools' => $schools
        ]);
        
        // Gera segunda página
        $pages[] = \View::make('pdf.certificate.templates.finalist.back', [
            'students' => $students,
            'educators' => $educators
        ]);

        $file = self::generatePDF($pages,$header,$footer);

        return self::saveFile($project,$file);

    }

    // Gera certificado de premiado
    public static function awardedCertificate( $project ) {

        $header = \View::make('pdf.certificate.templates.awarded.partials.header')->render();
        $footer = \View::make('pdf.certificate.templates.awarded.partials.footer')->render();

        $students  = self::getStudents($project);    
        $educators = self::getTeachers($project);
        $schools   = self::getSchools($project);
    
        // Gera primera página
        $pages[] = \View::make('pdf.certificate.templates.awarded.front', [
            'project' => $project,
            'schools' => $schools
        ]);
        
        // Gera segunda página
        $pages[] = \View::make('pdf.certificate.templates.awarded.back', [
            'students' => $students,
            'educators' => $educators
        ]);

        $file = self::generatePDF($pages,$header,$footer);

        return self::saveFile($project,$file);

    }

    // Gera certificado de premiado
    public static function honorableCertificate( $project ) {

        $header = \View::make('pdf.certificate.templates.honorable.partials.header')->render();
        $footer = \View::make('pdf.certificate.templates.honorable.partials.footer')->render();

        $students  = self::getStudents($project);    
        $educators = self::getTeachers($project);
        $schools   = self::getSchools($project);
    
        // Gera primera página
        $pages[] = \View::make('pdf.certificate.templates.honorable.front', [
            'project' => $project,
            'schools' => $schools
        ]);
        
        // Gera segunda página
        $pages[] = \View::make('pdf.certificate.templates.honorable.back', [
            'students' => $students,
            'educators' => $educators
        ]);

        $file = self::generatePDF($pages,$header,$footer);

        return self::saveFile($project,$file);

    }

    public static function getStudents( $project ) {

        $students = $project->students()->get()->pluck('full_name')->toArray();
        sort($students);

        return implode(', ',$students);

    }

    public static function getTeachers( $project ) {
        $educators = $project->educators()->get()->pluck('full_name')->toArray();
        sort($educators);

        return implode(', ',$educators);
    }

    public static function getSchools( $project ) {
        return implode(', ',$project->schools()->get()->pluck('name')->toArray());
    }

    public static function generatePDF( $pages, $header, $footer ) {

        // Gera PDF
        $pdf = PDF::loadView('pdf.certificate.index', ['pages' => $pages])
        ->setPaper('a4')
        ->setOrientation('landscape')
        ->setOptions(self::$options)
        ->setOption('header-html', $header)
        ->setOption('footer-html', $footer);

        return $pdf;
    }

    public static function saveFile($project,$file) {

        $timestamp = Carbon::now()->format('Y_m_d_u');

        // Caminho para certificado
        $path = "projects/{$project->uid}/certificates/{$timestamp}_{$project->uid}.pdf";

        // Salva certificado
        Storage::disk('public')->put($path, $file->output());

        // Retorna URL
        return Storage::disk('public')->url($path);
    }
}