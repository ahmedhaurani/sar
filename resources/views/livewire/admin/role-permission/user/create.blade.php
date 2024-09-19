<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Create User
                        <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('users') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="roles">Roles</label>
                            <select name="roles[]" class="form-control" multiple>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- New Departments Field -->
                        <div class="mb-3">
                            <label for="departments">Departments</label>
                            <select name="departments[]" class="form-control" multiple>
                                @foreach ($departments as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
