
<form class="form-horizontal" method="POST" action="{base_url}paciente/cadastro">
<fieldset class="col-md-12 col-xs-12">

<!-- Form Name -->
<legend></legend>

<!-- Text input-->
<div class="row">
<div class="form-group col-md-5 col-xs-12 ">
  <label class="col-md-2 control-label" for="nome">Nome</label>  
  <div class="col-md-10">
  <input id="nome" name="nome" type="text" placeholder="Paciente" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group col-md-4 col-xs-8 ">
  <label class="col-md-2 control-label" for="cpf">CPF</label>  
  <div class="col-md-10">
  <input id="cpf" name="cpf" type="text" placeholder="xxx.xxx.xxx-xx" class="form-control input-md" required="">
    
  </div>
</div>


<div class="form-group  col-md-3 col-xs-4 "> 
  
  <div class="col-md-12">
    <label class="checkbox-inline" for="checkboxes-0">
      <input type="checkbox" name="checkboxes" id="checkboxes-0" value="Sim">
      Marque se for dependente e não tiver CPF
    </label>
  </div>
</div>

</div>
<!-- Text input-->
<div class="row">
<div class="form-group  col-md-5 col-xs-12">
  <label class="col-md-2 control-label" for="email">Email</label>   
  <div class="col-md-10">
  <input id="email" name="email" type="email" placeholder="nome@exemplo.com" class="form-control input-md" required="">
<!--  <span class="help-block">Digite um email valido</span>  -->
  </div>
</div>
<div class="form-group col-md-4 col-xs-6">
  <label class="col-md-3 control-label" for="telefone">Telefone</label>  
  <div class="col-md-9">
  <input id="telefone" name="telefone" type="text" placeholder="(21) 1234-5678" class="form-control input-md">
    
  </div>
</div>
    <div class="form-group col-md-3 col-xs-6">
  <label class="col-md-3 control-label" for="celular">Celular</label>  
  <div class="col-md-9">
  <input id="celular" name="celular" type="text" placeholder="(21) 91234-5678" class="form-control input-md" required="">
    
  </div>
</div>
</div>



<!-- Text input-->
<div class="row">
<div class="form-group col-md-3"> 
  <label class="col-md-4 control-label" for="cep" style=" width: 29%;">Cep</label>  
  <div class="col-md-8">
  <input id="cep" name="cep" type="text" placeholder="xx.xxx-xxx" class="form-control input-md" required="">
    
  </div>
</div>
<!-- Text input-->

<div class="form-group col-md-6 "> 
  <label class="col-lg-2 control-label" for="endereco">Endereço</label>  
  <div class="col-md-10">
  <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>
<div class="form-group col-md-3 col-xs-12" >
  <label class="col-md-3 control-label" for="bairro" style=" /*width: 26%;*/">Bairro</label>  
  <div class="col-md-9 ">
  <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>
</div>
<div class="row"> 
<!-- Text input-->


<div class="form-group col-md-4">
    <label class="col-md-3 control-label" for="estado" style="width: 21%">Estado</label> 
  <div class="col-md-9">
    <select id="estado" name="estado" class="form-control" style="   width: 70%;">
      <option value="RJ">Rio de Janeiro</option>
      <option value="SP">São Paulo</option>
    </select>
  </div>
</div>
<div class="form-group col-md-4">
  <label class="col-md-2 control-label" for="cidade">Cidade</label>  
  <div class="col-md-10">
  <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Select Basic -->

</div>


<!-- Multiple Checkboxes (inline) -->


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="enviar"></label>
  <div class="col-md-4">
    <button id="enviar" name="enviar" class="btn btn-default">Cadastrar</button>
  </div>
</div>

</fieldset>
</form>

