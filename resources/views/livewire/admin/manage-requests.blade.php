<div class="container">
    <h2>Manage Requests</h2>

    @if ($requests->isEmpty())
        <p>No requests found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->department->name }}</td>
                        <td>{{ ucfirst($request->status) }}</td>
                        <td>{{ $request->note }}</td>
                        <td>
                            <!-- Action buttons for editing or viewing -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
