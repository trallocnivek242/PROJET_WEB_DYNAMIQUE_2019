<div id="load" style="position: relative;">
    <table class="table table-bordered" id="laravel_crud">
        <thead>
           <tr>
              <th>Id</th>
              <th>Nom</th>
              <th>email</th>
              <th>profil</th>
              <td colspan="2">Action</td>
           </tr>
        </thead>
        <tbody id="users-crud">
           @foreach($users as $user)
           <tr id="user_id_{{ $user->id }}">
              <td>{{ $user->id  }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->profil->nom }}</td>
              <td><a href="javascript:void(0)" id="edit-user" data-id="{{ $user->id }}" class="btn btn-info">Edit</a></td>
              <td>
               <a href="javascript:void(0)" id="delete-user" data-id="{{ $user->id }}" class="btn btn-danger delete-user">Delete</a></td>
           </tr>
           @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
