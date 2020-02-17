<?php 
    require_once INCLUDES.'header.php';
?>

<div class="container mt-5 mb-5">
    <h1 class="h1">
        <?php echo sprintf('Hola %s Bienvenido a la página de test', $d->name);?>
    </h1>
</div>

<?php require_once INCLUDES.'footer.php';?>