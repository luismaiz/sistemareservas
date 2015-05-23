<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
<?php } ?>
</div><!--/fluid-row-->
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">�?</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; Sistema Reservas
                <?php echo date('Y') ?></p>
        
    </footer>
<?php } ?>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="Utilidades/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="Utilidades/js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='Utilidades/bower_components/moment/min/moment.min.js'></script>
<script src='Utilidades/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<script src='Utilidades/bower_components/fullcalendar/dist/lang/es.js'></script>
<!-- data table plugin -->
<script src='Utilidades/js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="Utilidades/bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="Utilidades/bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="Utilidades/js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="Utilidades/bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="Utilidades/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="Utilidades/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="Utilidades/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="Utilidades/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="Utilidades/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="Utilidades/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="Utilidades/js/charisma.js"></script>

<script src="Utilidades/js/angular-footable.js" type="text/javascript"></script>

</body>
</html>