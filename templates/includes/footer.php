<footer class="footer">
  <div class="content has-text-centered">
  <p>© 2017 - <?php echo date('Y'); ?> <?php echo SITE_NAME ?> · <a href="#">Aviso de Privacidad</a> · <a href="#">Contacto</a></p>
  </div>
</footer>

<float-social 
twitter="https://twitter.com/" 
facebook="https://facebook.com/" 
instagram="https://instagram.com/" 
mensaje="Hola estoy interesado en sus servicios" 
telefono="0000000000">
</float-social>

</div><!--/End App--> 

<script src="<?php echo JS; ?>app.min.js<?=get_version(); ?>" async></script>


<script>
    window.onload = function() {
        document.getElementById('ginger-loader').style.display = "none";
    };
</script>
</body>
</html>
<?php ob_end_flush(); ?>