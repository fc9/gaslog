<?php

namespace App\Services;


use Exception;
use App\Models\Project;
use App\Models\ProjectMail;
use App\Models\Feedback;
use App\Enums\ProjectMailsKindEnum;
use App\Enums\MailStatusEnum;
use App\Enums\ProjectSituation;

use \Carbon\Carbon;

class MailsService
{

    public static function enqueuedMails( $kind, $year = null ) {

        if(!$kind) {
            throw new Exception("Tipo de disparo obrigatório");
        }

        switch ($kind) {
            case ProjectMailsKindEnum::FEEDBACK:
                self::enqueuedProjectsFeedbacks($year);
            break;
            case ProjectMailsKindEnum::TOP_PROJECTS:
                self::enqueuedTopProjects($year);
            break;
            case ProjectMailsKindEnum::PARTICIPATION:
                self::enqueuedParticipationProjects($year);
            break;
            default:
                //
            break;
        }
    }

    public static function enqueuedProjectsFeedbacks($year = null) {

        $projects = Project::when($year, function ($query, $year ) {
            return $query->whereYear('created_at',$year);
        })->where('status','PUBLISHED')->whereIn("situation",[
            ProjectSituation::DISAPPROVED,
            ProjectSituation::WORRISOME,
        ])->get();

        foreach ($projects as $key => $project) {

            $datetime = Carbon::now()->format('d/m/Y - H:i:s');
            $log = "[{$datetime}] Enfileirado\r\n";

            ProjectMail::updateOrCreate(
                ['project_id' => $project->id, 'kind' => ProjectMailsKindEnum::FEEDBACK],
                ['status' => MailStatusEnum::ENQUEUED, 'sended_at' => null, 'to' => $project->user->email, 'log' => $log]
            );
        }
    }

    public static function enqueuedTopProjects($year) {

        $projects = Project::when($year, function ($query, $year ) {
            return $query->whereYear('created_at',$year);
        })->where('status','PUBLISHED')
        ->whereIn("situation",[
            ProjectSituation::FINALIST,
            ProjectSituation::HONORABLE_MENTION,
            ProjectSituation::AWARDED,
        ])->get();

        foreach ($projects as $key => $project) {

            $datetime = Carbon::now()->format('d/m/Y - H:i:s');
            $log = "[{$datetime}] Enfileirado\r\n";

            ProjectMail::updateOrCreate(
                ['project_id' => $project->id, 'kind' => ProjectMailsKindEnum::TOP_PROJECTS],
                ['status' => MailStatusEnum::ENQUEUED, 'sended_at' => null, 'to' => $project->user->email, 'log' => $log]
            );
        }

    }

    public static function enqueuedParticipationProjects($year = null) {

        $projects = Project::when($year, function ($query, $year ) {
            return $query->whereYear('created_at',$year);
        })->where('status','PUBLISHED')->get();

        foreach ($projects as $key => $project) {

            $datetime = Carbon::now()->format('d/m/Y - H:i:s');
            $log = "[{$datetime}] Enfileirado\r\n";

            ProjectMail::updateOrCreate(
                ['project_id' => $project->id, 'kind' => ProjectMailsKindEnum::PARTICIPATION],
                ['status' => MailStatusEnum::ENQUEUED, 'sended_at' => null, 'to' => $project->user->email, 'log' => $log]
            );
        }
    }

}
