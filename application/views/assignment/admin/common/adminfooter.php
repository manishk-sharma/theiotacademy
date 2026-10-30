 <footer id="footersection">
               
</footer>
</div>
</div>

<script type="text/javascript" src="<?php echo asset_url();?>admin/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>admin/js/fontawesome-all.min.js"></script>
 <!-- Menu Toggle Script -->
 <script type="text/javascript"> 
    $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    });

    function removeTags(str) {
        if ((str === null) || (str === ''))
            return false;
        else
            str = str.toString();
        return str.replace(/(<([^>]+)>)/ig, '');
    }

</script>


</body>
</html>
