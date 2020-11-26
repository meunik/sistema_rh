@extends('layout')

@section('content')
<div class="container">
    <div class="white-box">
        <div class="white-box m-b-20 m-t-20">
            <form autocomplete="off">
                <div class="col-xs-12 p-0">
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label txt-label-form">Senha:</label>
                        <div class="col-sm-5">
                            <input type="password" maxlength="16" required class="form-control" autocomplete="off"  name="password" id="password" placeholder="Senha">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 p-0">
                    <div class="form-group">
                        <label for="password_confirm" class="col-sm-3 control-label txt-label-form">Confirmação da Senha:</label>
                        <div class="col-sm-5">
                            <input type="password" maxlength="16" required class="form-control"  autocomplete="off" name="password_confirm" id="password_confirm" placeholder="Senha">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 m-t-20">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Alterar Senha</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("form").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: "PUT",
            url: "/password",
            data: $("form").serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                window.location.href = "/";
            },
            error: function(error) {
                var errors = error.responseJSON.errors;
                for (var i in errors) {
                    toastr.error(errors[i])
                    break;
                }
            }
        });
    });
</script>

@endsection
