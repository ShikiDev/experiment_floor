<div class="col-md-10">
    @if(count($errors) > 0)
        <div class="col">
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="col">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="name" id="username" class="form-control" placeholder="username" value="{{$user->name or ""}}">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="e@mail.ru" value="{{$user->email or ""}}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password"  value="">
        </div>
        <div class="form-group">
            <label for="password_twice">Password Twice</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_twice" value="">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="confirmed_acc" id="confirmed" @if(!empty($user->confirmed)) checked @endif  class="form-check-input">
                <label for="confirmed" class="form-check-label">Confirmed</label>
            </div>
        </div>
        @if(!empty($user->created_at))
        <span>User created at: <i>{{$user->created_at->format('d.m.Y H:i:s')}}</i></span><br>
        <span>Last modify was <i>{{$user->updated_at->format('d.m.Y H:i:s')}}</i></span><br>
        @endif
        <button type="submit" class="btn btn-primary">@if(!empty($user)) Update @else Create @endif</button>
    </div>
    <div class="col"></div>
</div>