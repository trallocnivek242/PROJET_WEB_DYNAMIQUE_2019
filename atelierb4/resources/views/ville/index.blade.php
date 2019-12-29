@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Laravel 6 view villes</h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-ville">Add ville</a>
          @if (count($villes) > 0)
          <section class="LoadVilles">
              @include('ville.load')
          </section>
          @endif
       </div>
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="villeCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="villeForm" name="villeForm" class="form-horizontal">
           <input type="hidden" name="ville_id" id="ville_id" value="0">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">ville</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="ville" name="ville" value="" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Code Postal</label>
                <div class="col-sm-12">
                    <input class="form-control" id="CP" name="CP" value="" required="">
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
            getVilles(url);
            window.history.pushState("", "", url);
        });

        //fonction qui appelle l'index du controller et demande la view load avec les villes.
        //elle va alors placer ces infos dans la zone LoadVilles de la page web
        function getVilles(url) {
            $.ajax({
                url : url
            }).done(function (data) {
                $('.LoadVilles').html(data);
            }).fail(function () {
                alert('Villes could not be loaded.');
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
      $('#create-new-ville').click(function (e) {
          //si on clique je met les vlauers dans la boite de dialoue et l'affiche
          e.preventDefault();
          $('#btn-save').val("create-ville");
          $('#ville_id').val(0);
          $('#villeForm').trigger("reset");
          $('#villeCrudModal').html("Ajouter une ville");
          $('#ajax-crud-modal').modal('show');
      });

       //place un listener de click sur le bouton d'édition
      $('body').on('click', '#edit-ville', function (e) {
          //si on clique je met les vlauers dans la boite de dialoue et l'affiche
        e.preventDefault();
        var ville_id = $(this).data('id');
        //je lis les données dans le php via l'url/id/edit
        $.get('ville/'+ville_id+'/edit', function (data) {
            $('#btn-save').val("edit-ville");
            $('#ville_id').val(data.id);
            $('#ville').val(data.ville);
            $('#CP').val(data.CP);
            $('#villeCrudModal').html("Editer une ville");
            $('#ajax-crud-modal').modal('show');
        })
     });

      //place un listener de click sur le bouton delete
      $('body').on('click', '.delete-ville', function (e) {
          e.preventDefault();
          var ville_id = $(this).data("id");
          confirm("Are You sure want to delete !");
          $.ajax({
              type: "DELETE",
              url: "{{ url('ville')}}"+'/'+ville_id,
              success: function (data) {
                  $("#ville_id_" + ville_id).remove();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });
    });

   if ($("#villeForm").length > 0) {
        $("#villeForm").validate({
            //j'ai cliqué sur le bouton du form, je le valide, donc je lance les AJAX
       submitHandler: function(form) {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Sending..');
        $.ajax({
            data: $('#villeForm').serialize(),
            url: "{{ route('ville.store') }}",
            type: "post",
            dataType: 'json',
            success: function (data) {
                var ville = '<tr id="ville_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.ville + '</td><td>' + data.CP + '</td>';
                ville += '<td><a href="javascript:void(0)" id="edit-ville" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                ville += '<td><a href="javascript:void(0)" id="delete-ville" data-id="' + data.id + '" class="btn btn-danger delete-ville">Delete</a></td></tr>';


                if (actionType == "create-ville") {
                    $('#villes-crud').prepend(ville);
                } else {
                    $("#ville_id_" + data.id).replaceWith(ville);
                }

                $('#ville_id').val(0);
                $('#villeForm').trigger("reset");
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


