<form action="{{ $user->id ? route('users.update', $user) : route('users.store', $user) }}"
    method="post">
    @csrf()
    @if($user->id)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="first_name">@lang('validation.attributes.first_name') *</label>

        <input id="first_name" type="text"
        class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
        name="first_name" value="{{ old('first_name') ?? $user->first_name }}" >

        @if ($errors->has('first_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="last_name"> @lang('validation.attributes.last_name')</label>

        <input id="last_name" type="text"
        class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
        name="last_name" value="{{ old('last_name') ?? $user->last_name }}">

        @if ($errors->has('last_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="email">@lang('validation.attributes.email') *</label>

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
               value="{{ old('email') ?? $user->email }}">

        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    {{-- TODO Não permitir o envio do formuário quando a senha for considerada insegura   --}}
   <form-group-password label="@lang('validation.attributes.password')" id="password" name="password" {{ $user->id ? '' : 'required'}}></form-group-password>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $user->id ? __('buttons.general.crud.update') : __('buttons.general.crud.create') }}</button>
    </div>
</form>
