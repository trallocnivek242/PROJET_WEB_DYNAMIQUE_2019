@extends('layouts.Form')

@section('contentForm')
                <form id="villeForm" name="villeForm" class="form-horizontal">
								 @csrf
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
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create-ville">Save
                    </button>
                    </div>
                </form>

<script>
    if ($("#villeForm").length > 0) {
      $("#villeForm").validate({
        //j'ai cliqué sur le bouton du form, je le valide, donc je lance les AJAX
        submitHandler: function(form) {
            $('#btn-save').html('Sending..');
            var MyUrl;
            var MyType;

            $.ajax({
                data: $('#villeForm').serialize(),
                url: "{{ route('ville.store') }}",
                type: "post",
                dataType: 'json',
                success: function (data) {
                    DataAdded(data);
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
