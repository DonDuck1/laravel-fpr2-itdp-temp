<div id="wrapper">
    <div id="page" class="container">
        <h1>Edit Department</h1>

        <form method="POST" action="{{ route('departments.update', $department->id) }}">
            @csrf

            @method('PUT')
            <div class="field">
                <label class="label" for="name">Department Name</label>
                <div class="control">
                    <input class="input" type="text" name="name" id="name" value="{{ $department->name }}" size="80">
                    @error('name')
                        <p>{{ $errors->first('name') }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label class="label" for="active">Active</label>
                <div class="control">
                    <select id="active" name="active">
                        @if($department->active === 1)
                            <option value="1" selected>True</option>
                            <option value="0">False</option>
                        @elseif($department->active === 0)
                            <option value="1">True</option>
                            <option value="0" selected>False</option>
                        @endif
                    </select>
                    @error('active')
                        <p>{{ $errors->first('active') }}</p>
                    @enderror
                </div>
            </div>

            @can('selectOrganisation', $department)
                <div class="field">
                    <label class="label" for="organisation">Organisation</label>
                    <div class="control">
                        <select id="organisation" name="organisation">
                            <option value="1">Create new</option>
                            @foreach($organisations as $organisation)
                                @if($department->organisation_id === $organisation->id)
                                    <option value="{{ $organisation->name }}" selected>{{ $organisation->name }}</option>
                                @else
                                    <option value="{{ $organisation->name }}">{{ $organisation->name }}</option>
                                @endif
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
                                @if($department->organisation_id === $organisation->id)
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
                    <a class="cancel_button_blogs" href="{{ route('departments.show', $department->id) }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

