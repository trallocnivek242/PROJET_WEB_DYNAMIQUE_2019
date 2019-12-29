<div id="load" style="position: relative;">
    <table class="table table-bordered" id="laravel_crud">
        <thead>
           <tr>
              <th>Id</th>
              <th>Nom</th>
              <th>Code postal</th>
              <td colspan="2">Action</td>
           </tr>
        </thead>
        <tbody id="villes-crud">
           @foreach($villes as $ville)
           <tr id="ville_id_{{ $ville->id }}">
              <td>{{ $ville->id  }}</td>
              <td>{{ $ville->ville }}</td>
              <td>{{ $ville->CP }}</td>
              <td><a href="javascript:void(0)" id="edit-ville" data-id="{{ $ville->id }}" class="btn btn-info">Edit</a></td>
              <td>
               <a href="javascript:void(0)" id="delete-ville" data-id="{{ $ville->id }}" class="btn btn-danger delete-ville">Delete</a></td>
           </tr>
           @endforeach
        </tbody>
    </table>
    {{ $villes->links() }}
</div>
