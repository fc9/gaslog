<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Enums\ProjectSituation;
use App\Models\Project;
use App\Models\ProjectMail;
use App\Models\ProjectCertificate;
use App\Notifications\ProjectFeedback;
use App\Notifications\ProjectParticipation;
use App\Enums\ProjectMailsKindEnum;
use App\Enums\MailStatusEnum;
use App\Services\MailsService;
use App\Enums\CertificateKind;
use App\Models\Feedback;

use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Services\CertificateService;
use App\Enums\CertificateStatus;

use App\Notifications\ProjectAwarded;
use App\Notifications\ProjectHonorable;
use App\Notifications\ProjectFinalist;

use Exception;
class ProjectsMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:mails {type} {year?} {kind?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando responsável por processar e-mails para projetos.';

    public $log;

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
        \Log::info("EXECUTANDO COMANDO DE DISPARO DE E-MAILS");
        $type = $this->argument('type');

        switch ($type) {
            case 'queue':
                $this->queue();
            break;
            case 'send':
                $this->send();
            break;            
            default:
                $this->info("Comando não reconhecido!");
            break;
        }
        \Log::info("FIM COMANDO DE DISPARO DE E-MAILS");
    }

    // Enfileira projetos para disparo
    public function queue() {

        $year = $this->argument('year');
        $kind = $this->argument('kind');

        if($year) {
            $this->error("O ano é obrigatório para o comando 'queue'!");
            return false;
        }

        switch ($kind) {
            case ProjectMailsKindEnum::FEEDBACK:
                MailsService::enqueuedProjectsFeedbacks($year);
            break;
            case ProjectMailsKindEnum::TOP_PROJECTS:
                MailsService::enqueuedTopProjects($year);
            break;
            case ProjectMailsKindEnum::PARTICIPATION:
                MailsService::enqueuedParticipationProjects($year);
            break;
            default:
                //
            break;
        }
    }

    // Captura projetos enfileirados
    public function send($year = null) {

        $limit = env("LIMIT_EMAILS",20);

        $mails = ProjectMail::whereIn("status",[MailStatusEnum::ENQUEUED,MailStatusEnum::ERROR])->limit($limit)->get();

        foreach ($mails as $key => $mail) {

            try {

                $this->log = null;
                
                $project = Project::findOrFail($mail->project_id);

                $this->setLog("Iniciando processo de disparo");

                $this->notifyProjects($project,$mail->kind);

                $this->setLog("E-mail encaminhado com sucesso");
                $mail->log = $this->log;
                $mail->status = MailStatusEnum::SUCCESS;
                $mail->sended_at = Carbon::now();
                $mail->save();

            } catch (\Throwable $th) {

                $this->setLog("Falha ao disparar e-mail: " . $th->getMessage());

                $mail->status = MailStatusEnum::ERROR;
                $mail->log = $this->log;
                $mail->save();

            }
        }
    }

    public function getDateTime() {

        return Carbon::now()->format('d/m/Y - H:i:s');
    }

    public function setLog( $message ) {

        $this->log .= "[". $this->getDateTime() . "] {$message}\r\n";
    }

    public function getCertificate($project) {

        $this->setLog("Localizando certificado");

        // default
        $kind = CertificateKind::PARTICIPATION;

        if($project->situation == ProjectSituation::FINALIST) {
            $kind = CertificateKind::FINALIST;
        } elseif($project->situation == ProjectSituation::AWARDED) {
            $kind = CertificateKind::AWARDED;
        } elseif($project->situation == ProjectSituation::HONORABLE_MENTION) {
            $kind = CertificateKind::HONORABLE;
        }

        $certificate = ProjectCertificate::where('project_id',$project->id)->where('kind',$kind)->first() ?? $this->forceCertificate($project,$kind);

        return $certificate;
    }

    public function forceCertificate($project, $kind) {

        $this->setLog("Certificado não localizado");
        $this->setLog("Gerando certificado '" . CertificateKind::getDescription($kind) . "' automaticamente");

        if($kind == CertificateKind::FINALIST) {
            $this->info("FORCANDO CERTIFICADO FINALISTA");
            $url = CertificateService::finalistCertificate($project);
            $this->info($url);
        } elseif($kind == CertificateKind::AWARDED) {
            $this->info("FORCANDO CERTIFICADO PREMIADO");
            $url = CertificateService::awardedCertificate($project);
        } elseif($kind == CertificateKind::HONORABLE) {
            $this->info("FORCANDO CERTIFICADO MENCAO HONROSA");
            $url = CertificateService::honorableCertificate($project);
        } elseif($kind == CertificateKind::PARTICIPATION) {
            $this->info("FORCANDO CERTIFICADO PARTICIPACAO");
            $url = CertificateService::participationCertificate($project);
        }

        $certificate = new ProjectCertificate;
        $certificate->project_id = $project->id;
        $certificate->kind = $kind;
        $certificate->status = CertificateStatus::SUCCESS;
        $certificate->url = $url;

        $certificate->save();

        return $certificate;

    }

    public function notifyProjects($project,$mailKind) {

        $this->setLog("Disparando e-mail");

        if( $mailKind == ProjectMailsKindEnum::FEEDBACK ) {
            $this->notifyProjectFeedback($project);
        } else {

            $certificate = $this->getCertificate($project);

            if( $mailKind == ProjectMailsKindEnum::PARTICIPATION ) {
                $project->user->notify(new ProjectParticipation($project,$certificate));
            }
            elseif( $mailKind == ProjectMailsKindEnum::TOP_PROJECTS ) {
    
                if( in_array($project->situation,[ProjectSituation::FINALIST]) ) {
                    $this->info("ENVIANDO FINALISTA");
                    $project->user->notify(new ProjectFinalist($project,$certificate));
                }
                elseif( in_array($project->situation,[ProjectSituation::AWARDED]) ) {
                    $this->info("ENVIANDO PREMIADO");
                    $project->user->notify(new ProjectAwarded($project,$certificate));
                }
                elseif( in_array($project->situation,[ProjectSituation::HONORABLE_MENTION]) ) {
                    $this->info("ENVIANDO HONROSA");
                    $project->user->notify(new ProjectHonorable($project,$certificate));
                }
                else {
                    throw new Exception("Nenhuma notificação encontrada para status final do projeto");
                }
            }
            else {
                throw new Exception("Nenhum tipo de e-mail localizado para este projeto");
            }
        }
    }

    public function notifyProjectFeedback($project) {

        $feedbacks = \DB::table('appraisers_review_feedback')->select('feedback_id')
        ->whereExists(function ($query) use ($project) {
            $query->select(DB::raw(1))->from('appraisers_review')
            ->whereRaw('appraisers_review_feedback.review_id = appraisers_review.id')
            ->where('appraisers_review.project_id',$project->id);
        })->distinct()->get()->pluck('feedback_id')->toArray();
    
        $feedbacks = Feedback::whereIn('id',$feedbacks)->get();

        $project->user->notify(new ProjectFeedback($project,$feedbacks));
    }

}
