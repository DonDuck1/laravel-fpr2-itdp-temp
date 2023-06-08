<div id="wrapper">
    <div id="page" class="container">
        <h1>Edit Organisation</h1>

        <form method="POST" action="{{ route('organisations.update', $organisation->id) }}">
            @csrf

            @method('PUT')
            <div class="field">
                <label class="label" for="name">Organisation Name</label>
                <div class="control">
                    <input class="input" type="text" name="name" id="name" value="{{ $organisation->name }}" size="80">
                    @error('name')
                        <p>{{ $errors->first('name') }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label class="label" for="active">Active</label>
                <div class="control">
                    <select id="active" name="active">
                        @if($organisation->active === 1)
                            <option value="1" selected>True</option>
                            <option value="0">False</option>
                        @elseif($organisation->active === 0)
                            <option value="1">True</option>
                            <option value="0" selected>False</option>
                        @endif
                    </select>
                    @error('active')
                        <p>{{ $errors->first('active') }}</p>
                    @enderror
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="submit_button_blogs" type="submit">Submit</button>
                </div>

                <div class="control">
                    <button class="reset_button_blogs" type="reset">Reset</button>
                </div>

                <div class="control">
                    <a class="cancel_button_blogs" href="{{ route('organisations.show', $organisation->id) }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

