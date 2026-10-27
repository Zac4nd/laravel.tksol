<div class="box-body">
    <img src="{{'/img/user-placeholder.png'}}" height="200" width="200"
         class="img-responsive center-block img-thumbnail img-circle" alt="Immagine Accout">
</div><!-- /.box-body -->
<div class="row">
    @if($consulente->user->azure_id)
        <div class="col-md-12">
            <div class="login-logo" style="font-size:30px; color:#808080">
                {{$consulente->user->email}}
            </div>
        </div>
    @endif
    <div class="col-md-offset-3 col-md-6">
        @if($consulente->user->azure_id)
            <div class="social-auth-links text-center">
                <a href="{{ url('/unlinkAzure') }}" class="btn btn-block btn-social btn-primary btn-flat"
                   style="background-color: #4285F4"><i class="fab fa-windows"></i> Scollega il tuo account Microsoft</a>
            </div>
        @else
            <div class="social-auth-links text-center">
                <a href="{{ url('/linkAzure') }}" class="btn btn-block btn-social btn-primary btn-flat"
                   style="background-color: #4285F4"><i class="fab fa-windows"></i> Accedi con il tuo account Microsoft</a>
            </div>
        @endif
    </div>
</div>

@section('page_scripts')
    <script>
        function shareCalendar(id) {
            var request = $.ajax({
                url: "/ajax/toggleUser",
                type: "post",
                data: {'tipo_utente': 1, 'id': id},
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                    else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                    console.log(data['msg']);
                }
                else if (data['status'] == 'warning') {

                    if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                    else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                    alert(data.msg.replace(/(?:\\r\\n|\\r|\\n)/g, '\n'));
                    console.log(['Warning!', data]);
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    </script>
@endsection