<div id="wrapper">
    <div id="page" class="container">
        <h1>New Organisation</h1>
            <form method="POST" action="{{ route('organisations.store') }}">
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

            <div class="field is-grouped">
                <div class="control">
                    <button class="submit_button_blogs" type="submit">Submit</button>
                </div>

                <div class="control">
                    <button class="reset_button_blogs" type="reset">Reset</button>
                </div>

                <div class="control">
                    <a class="cancel_button_blogs" href="{{ route('organisations.index') }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
