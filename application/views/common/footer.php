
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php foreach ($js as $script_name) { ?>
    <script src=<?php echo "\"".base_url("public/js/".$script_name.".js")."\""; ?>></script>
    <?php } ?>
  </body>
</html>