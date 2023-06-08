<div id="wrapper">
    <div id="page" class="container">
        <h1>New Organisation</h1>
            <form method="POST" action="{{ route('departments.store') }}">
            @csrf

            <div class="field">
                <label class="label" for="name">Organisation name</label>
                <div class="control">
                    <input class="input" type="text" name="name" id="name" size="80" value="{{ old('name') }}">
                    @error('name')
                        <p>{{ $errors->first('name') }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label class="label" for="active">Active</label>
                <div class="control">
                    <select id="active" name="active">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                    @error('active')
                        <p>{{ $errors->first('active') }}</p>
                    @enderror
                </div>
            </div>

            @can('selectOrganisation', \App\Models\Department::class)
                <div class="field">
                    <label class="label" for="organisation">Organisation</label>
                    <div class="control">
                        <select id="organisation" name="organisation">
                            <option value="" selected disabled hidden>-- Choose an organisation --</option>
                            @foreach($organisations as $organisation)
                                <option value="{{ $organisation->name }}">{{ $organisation->name }}</option>
                            @endforeach
                        </select>
                        @error('active')
                            <p>{{ $errors->first('organisation') }}</p>
                        @enderror
                    </div>
                </div>
            @else
                <div class="field">
                    <label class="label" for="organisation">Organisation</label>
                    <div class="control">
                        <select id="organisation" name="organisation">
                            @foreach($organisations as $organisation)
                                @if(auth()->user()->organisation_id === $organisation->id)
                                    <option value="{{ $organisation->name }}" selected>{{ $organisation->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('active')
                            <p>{{ $errors->first('organisation') }}</p>
                        @enderror
                    </div>
                </div>
            @endcan


            <div class="field is-grouped">
                <div class="control">
                    <button class="submit_button_blogs" type="submit">Submit</button>
                </div>

                <div class="control">
                    <button class="reset_button_blogs" type="reset">Reset</button>
                </div>

                <div class="control">
                    @can('viewAny', \App\Models\Department::class)
                        <a class="cancel_button_blogs" href="{{ route('departments.index') }}">Cancel</a>
                    @else
                        <a class="cancel_button_blogs" href="{{ route('organisations.show', auth()->user()->organisation_id) }}">Cancel</a>
                    @endcan
                </div>
            </div>
        </form>
    </div>
</div>
