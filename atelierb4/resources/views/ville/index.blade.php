@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Laravel 6 view villes</h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-ville">Add ville</a>
          @if (count($villes) > 0)
          <section class="LoadVilles"><!--villes22 -->
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
                <h4 class="modal-title" id="villeCrudModal">Ajouter une ville</h4>
            </div>
            <div class="modal-body">
                <section id="FormView">
                </section>
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
        $('body').on('click', '#villes-head a', function(e) {
            var url = "{{ url('ville')}}?sortBy=" +$(this).attr('value');
            getVilles(url);
            window.history.pushState("", "", url);
           /* e.preventDefault();

            //$('#load a').css('color', '#dfecf6');
           // $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

            var url = $(this).attr('href');
            getVilles(url);
            window.history.pushState("", "", url);*/
        });

        //fonction qui appelle l'index du controller et demande la view load avec les villes.
        //elle va alors placer ces infos dans la zone LoadVilles de la page web
        function getVilles(url) {
            $.ajax({
                url : url,
                type: "get",
                //data:  "order=id",
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
				//ajoute le csrf pour le delete
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      //place un listener de click sur le bouton d'ajout
      $('#create-new-ville').click(function (e) {
          //si on clique je met les vlauers dans la boite de dialoue et l'affiche
          e.preventDefault();
					 $.get('{{ url('ville')}}'+'/create', function (data) {
            $('#FormView').html(data);
            $('#ajax-crud-modal').modal('show');
        })

      });

       //place un listener de click sur le bouton d'édition
      $('body').on('click', '#edit-ville', function (e) {
          //si on clique je met les vlauers dans la boite de dialoue et l'affiche
        e.preventDefault();
        var ville_id = $(this).data('id');

		$.ajax({
            url: "{{ url('ville')}}"+'/'+ville_id+"/edit",
            type: "get",
        }).done(function (data) {
            $('#FormView').html(data);

				$('#ajax-crud-modal').modal('show');
        }).fail(function () {
            alert('Villes could not be loaded.');
        });

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

    function DataAdded(data){
        $('#villes-crud').prepend(MakeLine(data));
    }


    function DataModified(data){
        $("#ville_id_" + data.id).replaceWith(MakeLine(data));
    }


    function MakeLine(data)
        {
        var ville = '<tr id="ville_id_' + data.id + '"><td>' + data.ville + '</td><td>' + data.CP + '</td>';
            ville += '<td><a href="javascript:void(0)" id="edit-ville" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
            ville += '<td><a href="javascript:void(0)" id="delete-ville" data-id="' + data.id + '" class="btn btn-danger delete-ville">Delete</a></td></tr>';
            $('#ajax-crud-modal').modal('hide');
            //on vide le form car celui-ci est juste mis en hidden
            $('#villeForm').trigger("reset");

            return ville;
        };

  </script>
@endsection


