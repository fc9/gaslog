<?php

namespace App\Http\Controllers\Stage;

use App\Models\{
    City,
    Contributor,
    Disability,
    Group,
    ProjectTakenAction,
    SchoolReligiousType,
    SubjectTheme,
    TakenAction,
    TrafficSource
};
use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Throwable;

class GroupController extends Controller
{
    protected GroupRepository $repo;

    public function __construct(GroupRepository $repository)
    {
        $this->repo = $repository;
    }

    public function index()
    {
        $params = [
            'title' => 'Grupo de Pesquisa',
            'groups' => $this->repo->find(auth()->user()->id),
            'missions' => \App\Enums\MissionEnum::class
        ];

        return view('stage.group-index')
            ->with($params);
    }

    public function create()
    {
        $params = $this->repo->create();
        $params['title'] = 'Criar grupo';
        $params['action'] = 'create';

        return view('stage.group-form')
            ->with($params);
    }

    public function store(Request $request)
    {
        try {
            //return response(['data' => $this->repo->store($request->all())]);
            $group = $this->repo->store($request->all());
            return response(['success' => true, 'group_id' => $group->id]);
        } catch (Throwable $th) {
            \DB::rollBack();
            if ($th instanceof AuthorizationException) {
                throw $th;
            }
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        $params = $this->repo->edit($id);
        $params['title'] = 'Editar grupo';
        $params['action'] = 'edit';

        if (empty($params['group'])) {
            return redirect()
                ->route('stage.group.index')
                ->with('error', 'Grupo não encontrado!');
        }

        return view('stage.group-form')
            ->with($params);
    }

    public function update(int $id, Request $request)
    {
        try {
            $this->repo->update($id, $request->all());
            return response(['success' => true]);
        } catch (Throwable $th) {
            \DB::rollBack();
            if ($th instanceof AuthorizationException) {
                throw $th;
            }
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->repo->destroy($id);
            return response()->json(['success' => true], 204);
        } catch (Throwable $th) {
            if ($th instanceof AuthorizationException) {
                throw $th;
            }
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
