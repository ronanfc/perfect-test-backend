{{csrf_field()}}
<div class="form-group">
    <label for="name">Nome</label>
    <input class="form-control" id="name" name="name" value="{{old('name',$client->name)}}" required>
</div>

<div class="form-group">
    <label for="email">E-mail</label>
    <input class="form-control" id="email" name="email" type="email" value="{{old('email',$client->email)}}" required>
</div>

<div class="form-group">
    <label for="cpf">CPF</label>
    <input class="form-control" id="cpf" name="cpf" type="number" minlength="11" maxlength="11" size="11"
           value="{{old('cpf',$client->cpf)}}" placeholder="Somente números" required>
</div>
