<?php require 'pages/header.php'; ?>
<?php
if (empty($_SESSION['cLogin'])) {
    ?>

    <script type="text/javascript">window.location.href = "login.php";</script>

    <?php
    exit;
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
    $titulo = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado = addslashes($_POST['estado']);
    
/* @var $_GET type */
    $a->editAnuncio($titulo,$categoria,$valor,$descricao,$estado,$_GET['id']);
    
    ?>
    
    <div class="alert alert-success">
        Produto editado com sucesso!
    </div>
    
    <?php
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    
    $info = $a->getAnuncio($_GET['id']);
    
} else {
    ?>
    
    <script type="text/javascript">window.location.href="meus_anuncios.php";</script>
    
    <?php 
    exit;
    
}

?>
    
<div class="container">
    <h1>Meus anúncios - Editar anúncio</h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria</label>            
            <select name="categoria" id="categoria" class="form-control">
                <?php
                require 'classes/categoria.class.php';
                $c = new Categorias();
                $cats = $c->getLista();
                foreach($cats as $cat) {                    
                
                ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo ($info['id_categoria'] == $cat['id'])?'selected="selected"':''; ?>><?php echo utf8_encode($cat['nome']); ?></option>
                <?php
                }
                ?>
                <?php //endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>" />
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo $info['valor']; ?>" />
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea type="textarea" name="descricao" id="descricao" class="form-control" ><?php echo $info['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="estado">Estado de conservação</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0" <?php echo ($info['estado'] == '0')?'selected="selected"':''; ?>>Ruim</option>
                <option value="1" <?php echo ($info['estado'] == '1')?'selected="selected"':''; ?>>Bom</option>
                <option value="2" <?php echo ($info['estado'] == '2')?'selected="selected"':''; ?>>Ótimo</option>
            </select>
            <br />
            <input type="submit" value="Salvar" class="btn btn-default">
        </div>
    </form>    
</div>
<?php require 'pages/footer.php'; ?>