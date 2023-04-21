<div class="card-body">

    <h4 class="card-title">Has Permission Manage</h4>
    <form action="{{route('admin.assingPermission')}}" method="Post">
        @csrf
        <input type="hidden" name='roleid' value="{{ $selectroles->id }}">
        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Permissions Name</th>
                    <th>Menu</th>
                    <th>Create</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Read</th>
                </tr>
            </thead>
            <tbody>
                @if (!isset($haspermissionname))
                <tr>
                    <td colspan="7">No permission assigned</td>
                </tr>
                @else
                @foreach ($haspermissionname as $pname)
                <tr>
                    <th>
                        {{ $pname->name }}
                    </th>
                    @foreach ($pname->permissions as $permission)
                    <td>
                        <input type="checkbox" class="form-check" value="{{ $permission->name }}"
                            name='rolepermissions[]'
                            {{ $selectroles->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    </td>
                    @endforeach
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>


        <div>
            <button type="submit" class="btn btn-primary w-md">Update Permission</button>
        </div>

    </form>
</div>