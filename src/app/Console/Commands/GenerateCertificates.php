<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Enums\ProjectSituation;
use App\Services\CertificateService;
use App\Enums\CertificateStatus;
use App\Enums\CertificateKind;
use App\Models\ProjectCertificate;

class GenerateCertificates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:certificates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando responsável por gerar certificados.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("EXECUTANDO COMANDO DE PROCESSAMENTO DE CERTIFICADOS");
        $certificates = ProjectCertificate::whereIn('status',[CertificateStatus::QUEUE,CertificateStatus::ERROR])->get();

        foreach ($certificates as $key => $certificate) {

            switch($certificate->kind) {
                case CertificateKind::PARTICIPATION:
                    $this->participationCertificate($certificate);
                break;
                case CertificateKind::FINALIST:
                    $this->finalistCertificate($certificate);
                break;
                case CertificateKind::AWARDED:
                    $this->awardedCertificate($certificate);
                break;
                case CertificateKind::HONORABLE:
                    $this->honorCertificate($certificate);
                break;
            }
        }
        \Log::info("FIM COMANDO DE PROCESSAMENTO DE CERTIFICADOS");
    }

    public function honorCertificate($certificate) {
        
        $project = Project::find($certificate->project_id);

        try {

            $url = CertificateService::honorableCertificate($project);
            $certificate->url = $url;
            $certificate->status = CertificateStatus::SUCCESS;
            $certificate->save();

        } catch (\Throwable $th) {
            $certificate->url = null;
            $certificate->status = CertificateStatus::ERROR;
            $certificate->save();
        }

    }

    public function awardedCertificate($certificate) {

        $project = Project::find($certificate->project_id);

        try {

            $url = CertificateService::awardedCertificate($project);
            $certificate->url = $url;
            $certificate->status = CertificateStatus::SUCCESS;
            $certificate->save();

        } catch (\Throwable $th) {
            $certificate->url = null;
            $certificate->status = CertificateStatus::ERROR;
            $certificate->save();
        }
    }

    public function finalistCertificate($certificate) {

        $project = Project::find($certificate->project_id);

        try {

            $url = CertificateService::finalistCertificate($project);
            $certificate->url = $url;
            $certificate->status = CertificateStatus::SUCCESS;
            $certificate->save();

        } catch (\Throwable $th) {
            $certificate->url = null;
            $certificate->status = CertificateStatus::ERROR;
            $certificate->save();
        }
    }

    public function participationCertificate($certificate) {

        $project = Project::find($certificate->project_id);

        try {

            $url = CertificateService::participationCertificate($project);
            $certificate->url = $url;
            $certificate->status = CertificateStatus::SUCCESS;
            $certificate->save();

        } catch (\Throwable $th) {
            $certificate->url = null;
            $certificate->status = CertificateStatus::ERROR;
            $certificate->save();
        }

    }
}
