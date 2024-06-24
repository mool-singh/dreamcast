

<table class="table table-striped">
    <thead>
        <tr>
            <td>S.no</td>
            <td>Image</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Role</td>
            <td>Description</td>
        </tr>
    </thead>
    <tbody>
        @if(!empty($users))
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>  <img src="{{ asset('uploads/' . $user['image']) }}" width="100" alt=""
                        class=" rounded-circle d-block m-auto"></td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['role']['name'] }}</td>
                        <td>{{ $user['description'] }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">No Record Found</td>
            </tr>
        @endif
    </tbody>
    </table>                            
