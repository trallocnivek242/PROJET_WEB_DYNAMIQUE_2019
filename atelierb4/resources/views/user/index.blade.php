@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Laravel 6 view users</h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add user</a>
          @if (count($users) > 0)
          <section class="LoadUsers">
              @include('user.load')
          </section>
          @endif
       </div>
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="userCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="userForm" name="userForm" class="form-horizontal">
           <input type="hidden" name="user_id" id="user_id" value="0">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">nom</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" value="" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">email</label>
                <div class="col-sm-12">
                    <input class="form-control" id="email" name="email" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">mot de passe</label>
                <div class="col-sm-12">
                    <input class="form-control" id="password" name="password" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">profil</label>
                <div class="col-sm-12">
                    <select name="profil" class="form-control @error('password') is-invalid @enderror" name="profil" id="profil" placeholder="Le profil" value="{{ old('profil') }}">
                        @foreach ($profils as $aProfil)
                    <option value='{{ $aProfil->id }}'>{{ $aProfil->nom }}</option>
                        @endforeach

                      </select>
                    <!--input class="form-control" id="profil" name="profil" value="" required=""-->
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">

    </div>
</div>
</div>
</div>
@endsection

@section('customScriptEndBody')

<script type="text/javascript">
    //script de gestion de pagination en mode AJAX
    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            //$('#load a').css('color', '#dfecf6');
           // $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            var url = $(this).attr('href');
            getUsers(url);
            window.history.pushState("", "", url);
        });

        //fonction qui appelle l'index du controller et demande la view load avec les users.
        //elle va alors placer ces infos dans la zone LoadUsers de la page web
        function getUsers(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('.LoadUsers').html(data);
            }).fail(function () {
                alert('Users could not be loaded.');
            });
        }
    });
</script>

<script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      //place un listener de click sur le bouton d'ajout
      $('#create-new-user').click(function (e) {
          console.log('new');
          //si on clique je met les vlauers dans la boite de dialoue et l'affiche
          e.preventDefault();
          $('#btn-save').val("create-user");
          $('#user_id').val(0);
          $('#userForm').trigger("reset");
          $('#userCrudModal').html("Ajouter une user");
          $('#ajax-crud-modal').modal('show');
      });

       //place un listener de click sur le bouton d'édition
      $('body').on('click', '#edit-user', function (e) {
          //si on clique je met les vlauers dans la boite de dialoue et l'affiche
        e.preventDefault();
        var user_id = $(this).data('id');
        //je lis les données dans le php via l'url/id/edit
        $.get('user/'+user_id+'/edit', function (data) {
            $('#btn-save').val("edit-user");
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#profil').val(data.profil_id);
            $('#userCrudModal').html("Editer une user");
            $('#ajax-crud-modal').modal('show');
        })
     });

      //place un listener de click sur le bouton delete
      $('body').on('click', '.delete-user', function (e) {
          e.preventDefault();
          var user_id = $(this).data("id");
          confirm("Are You sure want to delete !");
          $.ajax({
              type: "DELETE",
              url: "{{ url('user')}}"+'/'+user_id,
              success: function (data) {
                  $("#user_id_" + user_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });
    });

   if ($("#userForm").length > 0) {
        $("#userForm").validate({
            //j'ai cliqué sur le bouton du form, je le valide, donc je lance les AJAX
       submitHandler: function(form) {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');
        $.ajax({
            data: $('#userForm').serialize(),
            url: "{{ route('user.store') }}",
            type: "post",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var user = '<tr id="user_id_' + data.user.id + '"><td>' + data.user.id + '</td><td>' + data.user.name + '</td><td>' + data.user.email + '</td><td>' + data.profil.nom + '</td>';
                user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.user.id + '" class="btn btn-info">Edit</a></td>';
                user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.user.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';


                if (actionType == "create-user") {
                    $('#users-crud').prepend(user);
                } else {
                    $("#user_id_" + data.user.id).replaceWith(user);
                }

                $('#user_id').val(0);
                $('#userForm').trigger("reset");
                $('#ajax-crud-modal').modal('hide');
                $('#btn-save').html('Save Changes');

            },
            error: function (data) {
                console.log('Error:', data);
                $('#btn-save').html('Save Changes');
            }
        });
      }
    })
  }
  </script>
@endsection


