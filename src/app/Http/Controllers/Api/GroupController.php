<?php

namespace App\Http\Controllers\Api;

use App\Models\Mission;
use App\Models\User;
use App\Repositories\GroupRepository;
use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\City;
use Auth;

class GroupController extends Controller
{
    protected GroupRepository $repo;

    public function __construct(GroupRepository $repository)
    {
        $this->repo = $repository;
    }

    public function select(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return response()->json(
                [
                    'status' => false,
                    'feedback' => 'object.not.found',
                    'feedback_code' => 1,
                    'data' => [],
                ], 404
            );
        }

        return response()->json(
            [
                'status' => true,
                'message' => 'success',
                'message_code' => 0,
                'data' => Group::where('user_id', $user->id)->orderBy('name')->pluck('name', 'id')
            ]
        );
    }

    public function export(Request $request)
    {

        $participants = [];
        $responses = [];

        $user = User::where('email', $request->email)->first();
        $group = Group::where('id', $request->group_id)->where('user_id', $user->id)->orderBy('name')->with('members', 'missions')->first();

        if (empty($user) || empty($group)) {
            return response()->json(
                [
                    'status' => false,
                    'feedback' => 'object.not.found',
                    'feedback_code' => 1,
                    'data' => [],
                ], 404
            );
        }

        foreach ($group->members as $member) {
            $type = $member->user_type == 'educador' ? 'educators' : 'students';
            $participants[$type][] = [
                'name' => $member->user_name,
                'email' => $member->user_email,
                'age' => $member->user_age,
                'phone' => $member->user_phone,
                'mobile' => $member->user_mobile,
                'current_course_year' => $member->user_school_name,
            ];
        }

        foreach ($group->missions as $mission) {
            if ($mission->title == key(Mission::mission2) || $mission->title == key(Mission::mission3) || $mission->title == key(Mission::mission4) || $mission->title == key(Mission::mission5)) {
                $responses[$mission->title] = [
                    'field_0' => $mission->description,
                    'field_1' => $mission->text_field_1,
                    'field_2' => $mission->text_field_2,
                ];
            }
        }

        return response()->json(
            [
                'status' => true,
                'feedback' => 'success',
                'feedback_code' => 0,
                'data' => [
                    'group' => [
                        'name' => $group->name,
                        'city' => $group->group_address_city,
                        'state' => $group->group_address_state,
                        'school_name' => $group->group_organization,
                        'school_type' => $group->group_type,
                    ],
                    'participants' => $participants,
                    'responses' => $responses
                ]
            ]
        );

    }
}
