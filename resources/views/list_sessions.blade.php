<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">@lang('labels.user.profile.name')</th>
            <th scope="col">IP</th>
            <th scope="col">@lang('strings.sessions.user_agent')</th>
            <th scope="col">@lang('menus.pages.login')</th>
            <th scope="col">@lang('menus.logout')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sessions as $session)
            <tr>
                <td width="150">{{ $session->user->full_name }}</td>
                <td>{{ $session->ip }}</td>
                <td width="400">{{ $session->user_agent }}</td>
                <td>{{ $session->created_at }}</td>
                @if($session->created_at == $session->updated_at )
                <td> - </td>
                @else
                <td>{{ $session->updated_at }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
