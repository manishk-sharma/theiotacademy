<?php if($this->session->userdata("logged_in")){ ?>
 <footer id="footersection">
               
</footer>
</div>
</div>

<script type="text/javascript" src="<?php echo asset_url();?>admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>admin/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>admin/js/fontawesome-all.min.js"></script>
 <!-- Menu Toggle Script -->
 <script type="text/javascript"> 
    $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    });
</script>

</body>
</html>
<?php 
}else{
   redirect(base_url()."login") ; 
}
?> 