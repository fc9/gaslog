@if($group->missionAccomplished($mission->value))
    <a href="{{route('stage.mission.show', [$mission->value, $group->id])}}" class="groups-view">
        Visualizar
    </a>
{{--    <form action="#" method="post"--}}
{{--          enctype="multipart/form-data" target="_blank">--}}
{{--        <input type="hidden" name="token"--}}
{{--               value="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWUsImp0aSI6ImEwMWRlN2E1LTBhN2ItNGY0ZC1hMGYyLWJhMjMxZTA2OGI1NSIsImlhdCI6MTU5OTE3MDk1OSwiZXhwIjoxNTk5MTc0NTU5fQ.ofB6ZysBFIj2NPln_yKN9EqgVfzwE1FJKp2C2H_gf0k">--}}
{{--        <input type="hidden" name="group" value="{{$group->name}}">--}}
{{--        <input type="hidden" name="mission" value="{{$mission->value}}">--}}
{{--        <button type="submit" class="groups-card">Criar Cartão</button>--}}
{{--    </form>--}}
@elseif($mission->value == 1 || $group->missionAccomplished($mission->value - 1))
    <a href="{{route('stage.mission.show', [$mission->value, $group->id])}}" class="groups-participate">
        Participar
    </a>
@elseif($mission->value > 1)
    <a href="{{route('stage.mission.show', [$mission->value])}}" class="groups-spy">
        @include('layouts.icons.espiar') Espiar
    </a>
@endif