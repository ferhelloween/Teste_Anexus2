<?php 
    $idnode = $_REQUEST['idnode'];


?>


<h1 class="text-primary">Insira os Pontos</h1>

<form>
  <div class="mb-3">
    <input type="hidden" name="idnode" value="<?php echo $idnode;?>">
    <label for="PontosId" class="form-label">Pontos</label>
    <input type="number" class="form-control" id="PontosId" name="pontos">
  </div>
  <button type="submit" class="btn btn-primary" formaction="?page=atuNode">Inserir</button>
</form>